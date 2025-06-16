@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800">Instancias de Actividades</h2>

        <a href="{{ route('instancias.create') }}" class="bg-[#009ee3] text-white py-2 px-4 rounded mt-4 inline-block">Crear instancia de Actividad</a>

        <br>

        @if (session('success'))
        <div class="bg-green-500 text-white p-2 rounded mt-4">
            {{ session('success') }}
        </div>
        @endif

        <br>
        <br>

        <!-- Tabla de tipos de instancias -->
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Titulo</th>
                        <th class="px-4 py-2">Descripcion</th>
                        <th class="px-4 py-2">Precio</th>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Hora Inicio</th>
                        <th class="px-4 py-2">Hora Fin</th>
                        <th class="px-4 py-2">Duracion</th>
                        <th class="px-4 py-2">Direccion</th>
                        <th class="px-4 py-2">Imagen 1</th>
                        <th class="px-4 py-2">Imagen 2</th>
                        <th class="px-4 py-2">Imagen 3</th>
                        <th class="px-4 py-2">Transacciones</th>
                        <th class="px-4 py-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instancias as $instancia)
                    <tr class="border-b">
                        <td class="px-4 py-2" style="background-color: lightyellow;">{{ $instancia->id }}</td>
                        <td class="px-4 py-2">{{ Str::limit($instancia->actividad->titulo, 30) }}</td>
                        <td class="px-4 py-2">{!! Str::limit($instancia->actividad->descripcion, 30) !!}</td>
                        <td class="px-4 py-2" style="background-color: lightyellow;">{{ $instancia->precio }}</td>
                        <td class="px-4 py-2" style="background-color: lightyellow;">{{Carbon\Carbon::parse($instancia->fecha)->format('d/m/Y')}}</td>
                        <td class="px-4 py-2" style="background-color: lightyellow;">{{Carbon\Carbon::parse($instancia->hora_inicio)->format('H:i')}}</td>
                        <td class="px-4 py-2" style="background-color: lightyellow;">{{Carbon\Carbon::parse($instancia->hora_fin)->format('H:i')}}</td>
                        <td class="px-4 py-2" style="background-color: lightyellow;">
                        @php
                            $inicio = \Carbon\Carbon::parse($instancia->hora_inicio);
                            $fin = \Carbon\Carbon::parse($instancia->hora_fin);

                            $diff = $inicio->diff($fin);

                            $horas = $diff->h;
                            $minutos = $diff->i;

                            $partes = [];

                            if ($horas > 0) {
                                $partes[] = $horas . ' ' . ($horas === 1 ? 'hora' : 'horas');
                            }

                            if ($minutos > 0) {
                                $partes[] = $minutos . ' ' . ($minutos === 1 ? 'minuto' : 'minutos');
                            }

                            echo count($partes) > 0 ? implode(' ', $partes) : '0 minutos';
                        @endphp
                        </td>
                        <td class="px-4 py-2" style="background-color: lightyellow;">{{ $instancia->direccion }}</td>
                        <td class="px-4 py-2"><img width="100" src="{{ asset('storage/' . $instancia->actividad->image1) }}" /></td>
                        <td class="px-4 py-2">@if($instancia->actividad->image2 != null) <img width="100" src="{{ asset('storage/' . $instancia->actividad->image2) }}" />@endif</td>
                        <td class="px-4 py-2">@if($instancia->actividad->image3 != null) <img width="100" src="{{ asset('storage/' . $instancia->actividad->image3) }}" />@endif</td>
                        <td class="px-4 py-2"><a href="{{route('get_payments', $instancia->id)}}">{{$instancia->cant_transactions()->count()}}</a></td>
                        <td class="px-4 py-2 text-right">
                            <div class="flex justify-end space-x-4">
                                <a href="{{ route('instancias.edit', $instancia->id) }}" class="text-blue-500 hover:text-blue-700">Editar</a>

                                <form action="{{ route('instancias.destroy', $instancia->id) }}" method="POST" class="inline">
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
        {{ $instancias->links() }}
    </div>
</div>
@endsection