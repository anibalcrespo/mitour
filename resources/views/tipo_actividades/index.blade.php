@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800">Tipos de Actividades</h2>

        <a href="{{ route('tipo_actividades.create') }}" class="bg-[#009ee3] text-white py-2 px-4 rounded mt-4 inline-block">Crear Nuevo Tipo de Actividad</a>
        
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
                        <th class="px-4 py-2">Descripción</th>
                        <th class="px-4 py-2">Color</th>
                        <th class="px-4 py-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tipoActividades as $tipo)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $tipo->id }}</td>
                        <td class="px-4 py-2">{{ $tipo->descripcion }}</td>
                        <td class="text-[{{$tipo->color}}] px-4 py-2">{{ $tipo->color }}</td>
                        <td class="px-4 py-2 text-right">
                            <div class="flex justify-end space-x-4">
                                <a href="{{ route('tipo_actividades.edit', $tipo->id) }}" class="text-blue-500 hover:text-blue-700">Editar</a>

                                <form action="{{ route('tipo_actividades.destroy', $tipo->id) }}" method="POST" class="inline">
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
        {{ $tipoActividades->links() }}
    </div>
</div>
@endsection
