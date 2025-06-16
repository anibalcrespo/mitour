<?php

namespace App\Http\Controllers;

use App\Models\TipoActividad;
use Illuminate\Http\Request;

class TipoActividadController extends Controller
{
    public function index()
    {
        $tipoActividades = TipoActividad::paginate(50); // Obtener todos los registros
        return view('tipo_actividades.index', compact('tipoActividades'));
    }

    public function create()
    {
        return view('tipo_actividades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255|unique:tipo_actividades,descripcion,',
            'color' => 'required|string|max:7|min:7|unique:tipo_actividades,color,'
        ]);

        TipoActividad::create($request->all()); // Guardar en la base de datos
        return redirect()->route('tipo_actividades.index')->with('success', 'Tipo de actividad creada con éxito');
    }

    public function edit(TipoActividad $tipo_actividade)
    {
        return view('tipo_actividades.edit', compact('tipo_actividade'));
    }

    public function update(Request $request, TipoActividad $tipo_actividade)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255|unique:tipo_actividades,descripcion,' . $tipo_actividade->id,
            'color' => 'required|string|max:7|min:7|unique:tipo_actividades,color,' . $tipo_actividade->id
        ]);

        $tipo_actividade->update($request->all()); // Actualizar el registro
        return redirect()->route('tipo_actividades.index')->with('success', 'Tipo de actividad actualizada con éxito');
    }

    public function destroy(TipoActividad $tipo_actividade)
    {
        try {
            $tipo_actividade->delete(); // Eliminar el registro
            $message = " Tipo de actividad eliminada con éxito";
            $status = "success";
        } catch (\Exception $e) {
            $message = " Tipo de actividad no se pude eliminar";
            $status = "danger";
        }
        
        return redirect()->route('tipo_actividades.index')->with($status, $message);
    }
}
