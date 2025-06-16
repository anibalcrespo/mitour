<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\TipoActividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    public function index()
    {
        $actividades = Actividad::paginate(50); // Obtener todos los registros
        return view('actividades.index', compact('actividades'));
    }

    public function create()
    {
        $tipo_actividades = TipoActividad::all();
        return view('actividades.create', compact('tipo_actividades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_actividad_id' => 'required',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image1Path = $request->file('image1')->store('public/images'); // Guarda la imagen en 'storage/app/public/images'
        $image2Path = $request->hasFile('image2') ? $request->file('image2')->store('public/images') : null;
        $image3Path = $request->hasFile('image3') ? $request->file('image3')->store('public/images') : null;

        Actividad::create([
            'tipo_actividad_id' => $request->tipo_actividad_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'image1' => $image1Path,
            'image2' => $image2Path,
            'image3' => $image3Path
        ]); // Guardar en la base de datos

        return redirect()->route('actividades.index')->with('success', ' de actividad creada con éxito');
    }

    public function edit(Actividad $actividade)
    {
        $tipo_actividades = TipoActividad::all();
        return view('actividades.edit', compact('actividade', 'tipo_actividades'));
    }

    public function update(Request $request, Actividad $actividade)
    {
        $request->validate([
            'tipo_actividad_id' => 'required',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image1Path = $request->file('image1')->store('public/images'); // Guarda la imagen en 'storage/app/public/images'
        $image2Path = $request->hasFile('image2') ? $request->file('image2')->store('public/images') : $actividade->image2;
        $image3Path = $request->hasFile('image3') ? $request->file('image3')->store('public/images') : $actividade->image3;

        $actividade->update([
            'tipo_actividad_id' => $request->tipo_actividad_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'image1' => $image1Path,
            'image2' => $image2Path,
            'image3' => $image3Path
        ]); // Actualizar el registro
        
        return redirect()->route('actividades.index')->with('success', ' de actividad actualizada con éxito');
    }

    public function destroy(Actividad $actividade)
    {
        try {
            $actividade->delete(); // Eliminar el registro
            $message = " Actividad eliminada con éxito";
            $status = "success";
        } catch (\Exception $e) {
            $message = " Actividad no se pude eliminar";
            $status = "danger";
        }
        
        return redirect()->route('actividades.index')->with($status, $message);
    }
}
