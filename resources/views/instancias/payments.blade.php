@extends('layouts.app')

@section('content')
<div class="w-full bg-white p-6 shadow-lg rounded-lg flex flex-col h-full">
    <h2 class="text-2xl font-semibold text-gray-800">Pagos de la instancia</h2>
    <br>

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
                </tr>
            </thead>
            <tbody>
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
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <!-- Tabla de tipos de instancias -->
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Monto</th>
                    <th class="px-4 py-2">Email del cliente</th>
                    <th class="px-4 py-2">DNI del cliente</th>
                    <th class="px-4 py-2">Fecha de Creado</th>
                    <th class="px-4 py-2">Fecha de Aprobados</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paginatedItems as $payment)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $payment['results'][0]['id'] }}</td>
                    <td class="px-4 py-2">{{ $payment['results'][0]['status'] }}</td>
                    <td class="px-4 py-2">{{ $payment['results'][0]['transaction_amount'] }}</td>
                    <td class="px-4 py-2">{{ $payment['results'][0]['payer']['email'] }}</td>
                    <td class="px-4 py-2">{{ $payment['results'][0]['payer']['identification']['number'] }}</td>
                    <td class="px-4 py-2">{{ $payment['results'][0]['date_created'] }}</td>
                    <td class="px-4 py-2">{{ $payment['results'][0]['date_approved'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    {{ $paginatedItems->links() }}
</div>
@endsection