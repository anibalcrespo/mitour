@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800">Actividades</h2>

        <a href="{{ route('actividades.create') }}" class="bg-[#009ee3] text-white py-2 px-4 rounded mt-4 inline-block">Crear Actividad</a>

        <br>
        
        @if (session('success'))
            <div class="bg-green-500 text-white p-2 rounded mt-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('danger'))
            <div class="bg-red-500 text-white p-2 rounded mt-4">
                {{ session('danger') }}
            </div>
        @endif

        <br>
        <br>
        
        <!-- Tabla de tipos de actividades -->
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Titulo</th>
                        <th class="px-4 py-2">Descripcion</th>
                        <th class="px-4 py-2">Imagen 1</th>
                        <th class="px-4 py-2">Imagen 2</th>
                        <th class="px-4 py-2">Imagen 3</th>
                        <th class="px-4 py-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actividades as $actividad)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $actividad->id }}</td>
                        <td class="px-4 py-2">{{ Str::limit($actividad->titulo, 30) }}</td>
                        <td class="px-4 py-2">{!! Str::limit($actividad->descripcion, 30) !!}</td>
                        <td class="px-4 py-2"><img width="100" src="{{ asset('storage/' . $actividad->image1) }}"/></td>
                        <td class="px-4 py-2">@if($actividad->image2 != null) <img width="100" src="{{ asset('storage/' . $actividad->image2) }}"/>@endif</td>
                        <td class="px-4 py-2">@if($actividad->image3 != null) <img width="100" src="{{ asset('storage/' . $actividad->image3) }}"/>@endif</td>
                        <td class="px-4 py-2 text-right">
                            <div class="flex justify-end space-x-4">
                                <a href="{{ route('actividades.edit', $actividad->id) }}" class="text-blue-500 hover:text-blue-700">Editar</a>

                                <form action="{{ route('actividades.destroy', $actividad->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        {{ $actividades->links() }}
    </div>
</div>
@endsection
