@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-semibold text-gray-800">Crear Nuevo Tipo de Actividad</h1>

        <form action="{{ route('tipo_actividades.store') }}" method="POST" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="w-full px-4 py-2 border rounded" value="{{ old('descripcion') }}" required>
                @error('descripcion')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="color" class="block text-gray-700">Color</label>
                <input type="text" name="color" id="color" class="w-full px-4 py-2 border rounded" value="{{ old('color') }}" required>
                @error('color')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-[#009ee3] text-white py-2 px-4 rounded">Guardar</button>
        </form>
    </div>
@endsection
