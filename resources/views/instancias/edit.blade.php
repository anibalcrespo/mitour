@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-semibold text-gray-800">Ediar Instancia de Actividad</h1>

        <form action="{{ route('instancias.update', $instancia->id) }}" method="POST" class="mt-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="actividad_id" class="block text-gray-700">Instancia de Actividad</label>
                <select name="actividad_id" id="actividad_id" class="w-full px-4 py-2 border rounded" required>
                    @foreach($actividades as $actividad)
                    <option @if($actividad->id == $instancia->actividad->id) selected @endif value="{{$actividad->id}}">{{$actividad->titulo}}</option>
                    @endforeach
                </select>    
                @error('actividad_id')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="precio" class="block text-gray-700">Precio</label>
                <input type="numeric" name="precio" id="precio" class="w-full px-4 py-2 border rounded" value="{{ $instancia->precio }}" required>
                @error('precio')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="fecha" class="block text-gray-700">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="w-full px-4 py-2 border rounded" value="{{ $instancia->fecha }}" required>
                @error('fecha')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="hora_inicio" class="block text-gray-700">Hora Inicio</label>
                <input type="time" name="hora_inicio" id="hora_inicio" class="w-full px-4 py-2 border rounded" value="{{ $instancia->hora_inicio }}" required>
                @error('hora_inicio')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="hora_fin" class="block text-gray-700">Hora Fin</label>
                <input type="time" name="hora_fin" id="hora_fin" class="w-full px-4 py-2 border rounded" value="{{ $instancia->hora_fin }}" required>
                @error('hora_fin')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="direccion" class="block text-gray-700">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="w-full px-4 py-2 border rounded" value="{{ $instancia->direccion }}" required>
                @error('direccion')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-[#009ee3] text-white py-2 px-4 rounded">Guardar</button>
        </form>
    </div>
@endsection
