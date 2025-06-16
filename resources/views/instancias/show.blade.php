<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/public/images/' . 'previa.jpg') }}" type="image/x-icon" />
    <meta property="og:title" content="Bienvenido a Mi Tour .Com.Ar" />
    <meta property="og:description" content="Venta de Visitas Guiadas" />
    <meta property="og:image" content="{{ asset('storage/public/images/' . 'previa.jpg') }}" />
    <meta property="og:url" content="https://mitour.com.ar" />
    <meta property="og:type" content="website" />
    <title>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Visitas Guiadas', session('locale', 'en')) }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kodchasan:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Función para mostrar/ocultar el menú móvil
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>

<body class="bg-blue-50 font-[Open_Sans] antialiased flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-[#009ee3] text-white p-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-semibold font-[Kodchasan]"><a href="{{route('welcome')}}" class="text-white">MiTour</a></h1> <!-- Botón del menú hamburguesa -->
            <button onclick="toggleMenu()" class="lg:hidden text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <!-- Menú de escritorio -->
            <nav class="hidden lg:flex space-x-6">
                <a href="{{ url('/set-language/es') }}"> 🇪🇸 </a>
                <a href="{{ url('/set-language/en') }}"> 🇺🇸 </a>
                <a href="{{ url('/set-language/fr') }}"> 🇫🇷 </a>
                <a href="{{ url('/set-language/pt') }}"> 🇵🇹 </a>
                <a href="{{ url('/set-language/de') }}"> 🇩🇪 </a>
                <a href="{{ url('/set-language/it') }}"> 🇮🇹 </a>
                <a href="{{ url('/set-language/ru') }}"> 🇷🇺 </a>

                <a href="{{route('welcome')}}" class="text-white hover:text-gray-200">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Actividades', session('locale', 'en')) }}</a>
                <a href="#" class="text-white hover:text-gray-200">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Terminos y Condiciones', session('locale', 'en')) }}</a>
                @auth
                <a href="{{route('actividades.index')}}" class="text-white hover:text-gray-200">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Administrar', session('locale', 'en')) }}</a>
                @else
                @endauth
            </nav>
        </div>
        <!-- Menú móvil -->
        <div id="mobile-menu" class="lg:hidden hidden bg-[#009ee3] text-white space-y-4 p-6 absolute top-16 left-0 w-full">
            <a href="{{ url('/set-language/es') }}"> 🇪🇸 </a>
            <a href="{{ url('/set-language/en') }}"> 🇺🇸 </a>
            <a href="{{ url('/set-language/fr') }}"> 🇫🇷 </a>
            <a href="{{ url('/set-language/pt') }}"> 🇵🇹 </a>
            <a href="{{ url('/set-language/de') }}"> 🇩🇪 </a>
            <a href="{{ url('/set-language/it') }}"> 🇮🇹 </a>
            <a href="{{ url('/set-language/ru') }}"> 🇷🇺 </a>

            <a href="{{route('welcome')}}" class="block">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Actividades', session('locale', 'en')) }}</a>
            <a href="#" class="block">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Terminos y Condiciones', session('locale', 'en')) }}</a>
            @auth
            <a href="{{route('actividades.index')}}" class="text-white hover:text-gray-200">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Administrar', session('locale', 'en')) }}</a>
            @else
            @endauth
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow w-full w-full overflow-auto bg-blue-50 p-4">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Título y Descripción debajo de la imagen -->
            <div class="p-6 bg-white">
                <h2 class="text-3xl font-semibold text-gray-800">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans($instancia->actividad->titulo, session('locale', 'en')) }}</h2>
                <p class="mt-4 text-gray-600 text-justify">{!! \Stichoza\GoogleTranslate\GoogleTranslate::trans($instancia->actividad->descripcion, session('locale', 'en')) !!}</p>
            </div>



            <!-- Imágenes en columnas -->
            <div class="p-6 bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Primer columna con las imágenes -->
                    <div class="flex flex-col space-y-4">
                        <div class="w-full">
                            <img src="{{ asset('storage/' . $instancia->actividad->image1) }}" alt="Imagen Principal" class="w-full h-64 object-cover rounded-lg">
                        </div>
                        @if($instancia->actividad->image2)
                        <div class="w-full">
                            <img src="{{ asset('storage/' . $instancia->actividad->image2) }}" alt="Imagen 2" class="w-full h-64 object-cover rounded-lg">
                        </div>
                        @endif
                        @if($instancia->actividad->image3)
                        <div class="w-full">
                            <img src="{{ asset('storage/' . $instancia->actividad->image3) }}" alt="Imagen 3" class="w-full h-64 object-cover rounded-lg">
                        </div>
                        @endif

                        <!-- Resto de los detalles (Fecha, Hora, Dirección y Precio) -->
                        <div class="p-6 bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="text-gray-700">
                                    <p><strong>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Tipo de Actividad:', session('locale', 'en')) }}</strong><br> {{\Stichoza\GoogleTranslate\GoogleTranslate::trans($instancia->actividad->tipo_actividad->descripcion, session('locale', 'en')) }}</p>
                                    <br>
                                    <p><strong>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Fecha:', session('locale', 'en')) }}</strong><br> {{\Stichoza\GoogleTranslate\GoogleTranslate::trans(Carbon\Carbon::parse($instancia->fecha)->format('d/m/Y'), session('locale', 'en')) }}</p>
                                    <br>
                                    <p><strong>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Hora Inicio:', session('locale', 'en')) }}</strong><br> {{\Stichoza\GoogleTranslate\GoogleTranslate::trans(Carbon\Carbon::parse($instancia->hora_inicio)->format('H:i'), session('locale', 'en')) }}</p>
                                    <br>
                                    <p><strong>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Hora Fin', session('locale', 'en')) }}</strong><br> {{\Stichoza\GoogleTranslate\GoogleTranslate::trans(Carbon\Carbon::parse($instancia->hora_fin)->format('H:i'), session('locale', 'en')) }}</p>
                                    <br>
                                    <p><strong>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Duracion:', session('locale', 'en')) }}</strong><br>
                                        @php
                                        $inicio = \Carbon\Carbon::parse($instancia->hora_inicio);
                                        $fin = \Carbon\Carbon::parse($instancia->hora_fin);

                                        $diff = $inicio->diff($fin);

                                        $horas = $diff->h;
                                        $minutos = $diff->i;

                                        $partes = [];

                                        if ($horas > 0) {
                                        $partes[] = $horas . ' ' . ($horas === 1 ? \Stichoza\GoogleTranslate\GoogleTranslate::trans('hora', session('locale', 'en')) : \Stichoza\GoogleTranslate\GoogleTranslate::trans('horas', session('locale', 'en')));
                                        }

                                        if ($minutos > 0) {
                                        $partes[] = $minutos . ' ' . ($minutos === 1 ? \Stichoza\GoogleTranslate\GoogleTranslate::trans('minuto', session('locale', 'en')) : \Stichoza\GoogleTranslate\GoogleTranslate::trans('minutos', session('locale', 'en')));
                                        }

                                        echo count($partes) > 0 ? implode(' ', $partes) : \Stichoza\GoogleTranslate\GoogleTranslate::trans('0 minutos', session('locale', 'en'));
                                        @endphp
                                    </p>
                                    <br>
                                    <p><strong>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Dirección:', session('locale', 'en')) }}</strong><br> {{ $instancia->direccion }}</p>
                                </div>
                                <div>
                                    <p class="text-black text-[18px] font-bold px-4 py-2 rounded-lg text-center"><strong>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Precio:', session('locale', 'en')) }}</strong> 💰 ${{$instancia->precio}} UDS</p>
                                    <br>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Segunda columna con el formulario de MercadoPago -->
                    <div class="w-full">
                        <div id="payment-status" style="display: none; padding: 10px; margin-top: 10px; border-radius: 5px; font-weight: bold;"></div>

                        <div id="cardPaymentBrick_container"></div>

                        @php
                            $localeMap = [
                            'en' => 'en-US',
                            'es' => 'es-AR',
                            'pt' => 'pt-BR',
                            'fr' => 'fr-FR',
                            'de' => 'de-DE',
                            'it' => 'it-IT',
                            'ru' => 'ru-RU',
                            ];
                        $mp_locale = $localeMap[session('locale', 'en')] ?? 'en-US';
                        @endphp

                        <script>
                            const mp = new MercadoPago("{{ config('services.mercadopago.public_key') }}", {
                                locale: "{{$mp_locale}}"
                            });

                            const bricksBuilder = mp.bricks();

                            const renderCardPaymentBrick = async (bricksBuilder) => {
                                const settings = {
                                    initialization: {
                                        amount: '{{$instancia->precio}}', // Monto a ser pagado
                                        payer: {
                                            email: "",
                                        },
                                    },
                                    customization: {
                                        visual: {
                                            style: {
                                                theme: 'default',
                                                customVariables: {

                                                }
                                            }
                                        },
                                        paymentMethods: {
                                            maxInstallments: 1,
                                        }
                                    },
                                    callbacks: {
                                        onReady: () => {
                                            // Callback cuando el Brick está listo
                                        },
                                        onSubmit: (cardFormData) => {
                                            return new Promise((resolve, reject) => {
                                                cardFormData.instancia_id = '{{$instancia->id}}';
                                                fetch("/process_payment", {
                                                        method: "POST",
                                                        headers: {
                                                            "Content-Type": "application/json",
                                                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                                        },
                                                        body: JSON.stringify(cardFormData)
                                                    })
                                                    .then(response => response.json()) // Convertimos la respuesta a JSON
                                                    .then(data => {
                                                        const statusDiv = document.getElementById("payment-status");

                                                        if (data.status === "approved") {
                                                            statusDiv.innerHTML = "✅ <strong>Pago aprobado</strong>";
                                                            statusDiv.style.backgroundColor = "#d4edda";
                                                            statusDiv.style.color = "#155724";
                                                            statusDiv.style.border = "1px solid #c3e6cb";
                                                        } else if (data.status === "rejected") {
                                                            statusDiv.innerHTML = "❌ <strong>Pago rechazado:</strong> " + data.status_detail;
                                                            statusDiv.style.backgroundColor = "#f8d7da";
                                                            statusDiv.style.color = "#721c24";
                                                            statusDiv.style.border = "1px solid #f5c6cb";
                                                        } else {
                                                            statusDiv.innerHTML = "⚠️ <strong>Estado del pago:</strong> " + data.status;
                                                            statusDiv.style.backgroundColor = "#fff3cd";
                                                            statusDiv.style.color = "#856404";
                                                            statusDiv.style.border = "1px solid #ffeeba";
                                                        }

                                                        statusDiv.style.display = "block"; // Mostrar el mensaje
                                                        resolve();
                                                    })
                                                    .catch(error => {
                                                        console.error("Error en el pago:", error);
                                                        const statusDiv = document.getElementById("payment-status");
                                                        statusDiv.innerHTML = "⚠️ <strong>Error al procesar el pago. Inténtalo nuevamente.</strong>";
                                                        statusDiv.style.backgroundColor = "#f8d7da";
                                                        statusDiv.style.color = "#721c24";
                                                        statusDiv.style.border = "1px solid #f5c6cb";
                                                        statusDiv.style.display = "block"; // Mostrar el mensaje
                                                        reject();
                                                    });
                                            });
                                        },
                                        onError: (error) => {
                                            console.error("Error en el Brick:", error);
                                            const statusDiv = document.getElementById("payment-status");
                                            statusDiv.innerHTML = "⚠️ <strong>Ha ocurrido un error al intentar realizar el pago.</strong>";
                                            statusDiv.style.backgroundColor = "#f8d7da";
                                            statusDiv.style.color = "#721c24";
                                            statusDiv.style.border = "1px solid #f5c6cb";
                                            statusDiv.style.display = "block"; // Mostrar el mensaje
                                        },
                                    },
                                };

                                window.cardPaymentBrickController = await bricksBuilder.create('cardPayment', 'cardPaymentBrick_container', settings);
                            };

                            renderCardPaymentBrick(bricksBuilder);
                        </script>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-[#009ee3] text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('&copy; 2025 MiTour. Todos los derechos reservados.', session('locale', 'en')) }} <a href="#" class="text-white hover:text-gray-200">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Terminos y Condiciones', session('locale', 'en')) }}</a></p>
        </div>
    </footer>

</body>

</html>