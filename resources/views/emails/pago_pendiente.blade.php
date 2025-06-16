<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Pendiente</title>
    <style>
        /* Estilos de Tailwind CSS pueden ser agregados aquí, si tienes Tailwind configurado en tu proyecto */
    </style>
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-12">
        <div class="bg-indigo-600 p-6">
            <h1 class="text-2xl text-white font-bold">¡Pago Pendiente!</h1>
        </div>

        <div class="p-6">
            <p class="text-lg mb-4">Hola, <strong>{{ $payment['results'][0]['card']['cardholder']['name'] }}</strong></p>
            <p class="text-base mb-6">Recibimos tu solicitud para el tour, pero el pago aún no ha sido confirmado por la entidad bancaria.</p>

            <div class="bg-indigo-50 p-4 rounded-lg shadow-sm mb-6">
                <ul class="space-y-3">
                    <li class="text-gray-700 font-semibold">Actividad: <span class="font-normal">{{ $instancia->actividad->tipo_actividad->descripcion }}</span></li>
                    <li class="text-gray-700 font-semibold">Título: <span class="font-normal">{{ $instancia->actividad->titulo }}</span></li>
                    <li class="text-gray-700 font-semibold">Fecha: <span class="font-normal">{{ $instancia->fecha }}</span></li>
                    <li class="text-gray-700 font-semibold">Hora Inicio: <span class="font-normal">{{ $instancia->hora_inicio }}</span></li>
                    <li class="text-gray-700 font-semibold">Hora Fin: <span class="font-normal">{{ $instancia->hora_fin }}</span></li>
                    <li class="text-gray-700 font-semibold">Hora Fin: 
                        <span class="font-normal">
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
                        </span>
                    </li>
                    <li class="text-gray-700 font-semibold">Dirección: <span class="font-normal">{{ $instancia->direccion }}</span></li>
                    <li class="text-gray-700 font-semibold">Precio Abonado: <span class="font-normal">{{ $payment['results'][0]['transaction_amount'] }}</span></li>
                </ul>
            </div>

            <div class="bg-indigo-50 p-4 rounded-lg shadow-sm mb-6">
            <strong>Estado actual:</strong> Pendiente de confirmación<br>
            <br>
            <p>Te notificaremos apenas tengamos novedades. Si no ves movimiento en 24 horas, escribinos a soport@mitour.com.ar</p>
            </div>

        </div>

        <div class="bg-indigo-600 p-4 text-center">
            <p class="text-white">Saludos, <br><strong>El equipo de MiTour</strong></p>
        </div>
    </div>
</body>
</html>