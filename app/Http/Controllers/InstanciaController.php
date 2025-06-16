<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Instancia;
use App\Models\TipoActividad;
use Illuminate\Http\Request;

class InstanciaController extends Controller
{
    public function index()
    {
        $instancias = Instancia::with(['cant_transactions'])->paginate(50); // Obtener todos los registros
        return view('instancias.index', compact('instancias'));
    }

    public function create()
    {
        $actividades = Actividad::all();
        return view('instancias.create', compact('actividades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'actividad_id' => 'required',
            'precio' => 'required|numeric|min:35',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'direccion' => 'required|string|max:255',
        ]);

        Instancia::create([
            'actividad_id' => $request->actividad_id,
            'precio' => $request->precio,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'direccion' => $request->direccion,
        ]); // Guardar en la base de datos

        return redirect()->route('instancias.index')->with('success', ' de instancia creada con éxito');
    }

    public function edit(Instancia $instancia)
    {
        $actividades = Actividad::all();
        return view('instancias.edit', compact('instancia', 'actividades'));
    }

    public function update(Request $request, Instancia $instancia)
    {
        $request->validate([
            'actividad_id' => 'required',
            'precio' => 'required|numeric|min:35',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'direccion' => 'required|string|max:255',
        ]);

        $instancia->update([
            'actividad_id' => $request->actividad_id,
            'precio' => $request->precio,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'direccion' => $request->direccion,
        ]); // Actualizar el registro
        
        return redirect()->route('instancias.index')->with('success', ' de instancia actualizada con éxito');
    }

    public function destroy(Instancia $instancia)
    {
        $instancia->delete(); // Eliminar el registro
        return redirect()->route('instancias.index')->with('success', ' de instancia eliminada con éxito');
    }

    public function show($id)
    {
        // Buscar la instancia por su ID
        $instancia = Instancia::findOrFail($id);

        // Retornar la vista con la instancia
        return view('instancias.show', compact('instancia'));
    }
}
