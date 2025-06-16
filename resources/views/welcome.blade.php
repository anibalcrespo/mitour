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
    <title>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Visitas Guiadas', session('locale', 'en'))}}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
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
    <header class="bg-[#009ee3] text-white p-6 z-50">
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

    <!-- Banner -->
    <div class="bg-gradient-to-r from-[#009ee3] to-[#9e00e3] text-white py-6 px-4 sm:px-12">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-sm sm:text-lg mb-6">
                {{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('En MiTour, no solo ofrecemos visitas guiadas, creamos experiencias inolvidables. Desde recorrer los pasos de leyendas como Diego Maradona hasta saborear el auténtico asado argentino, cada tour está diseñado para conectar con el alma en la cultura.', session('locale', 'en')) }}
            </p>
            <p class="text-sm sm:text-lg mb-6">
                {{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('¿Qué nos hace diferentes? Nuestra pasión por mostrarte lo mejor. Somos expertos en transformar cada recorrido en una aventura única. Con guías apasionados y rutas cuidadosamente seleccionadas, garantizamos que cada momento sea especial.', session('locale', 'en')) }}
            </p>
            <p class="text-sm sm:text-lg mb-6">
                {{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Ya sea que quieras explorar la historia, el arte urbano o los sabores tradicionales, en MiTour sabemos cómo hacerlo. Unite a nosotros y descubrí por qué somos los mejores en lo que hacemos.', session('locale', 'en')) }}
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto flex-1">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
            @foreach ($instancias as $instancia)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105">
                <!-- Imagen -->
                <div class="h-48 bg-cover bg-center"
                    style="text-align: right; background-image: url('{{ asset('storage/' . $instancia->actividad->image1) }}');">
                    <span class="bg-[{{$instancia->actividad->tipo_actividad->color}}] p-1"><strong>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans($instancia->actividad->tipo_actividad->descripcion, session('locale', 'en')) }}</strong></span>
                </div>

                <!-- Contenido -->
                <div class="p-5">

                    <h2 style="font-size: 23px;" class="text-xl font-semibold text-gray-800">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans($instancia->actividad->titulo, session('locale', 'en'))}}</h2>

                    <p class="mt-2 text-gray-600">{!! Str::limit(\Stichoza\GoogleTranslate\GoogleTranslate::trans($instancia->actividad->descripcion, session('locale', 'en')), 80) !!} <a href="{{route('instancia.show', $instancia->id)}}" class="text-indigo-600">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Ver más', session('locale', 'en'))}}</a></p>

                    <div class="mt-4 flex justify-between text-gray-700 text-sm">
                        <span style="font-size: 18px;"><strong>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Fecha:', session('locale', 'en'))}}</strong><br> {{\Stichoza\GoogleTranslate\GoogleTranslate::trans(Carbon\Carbon::parse($instancia->fecha)->format('d/m/Y'), session('locale', 'en'))}}</span>
                        <span style="font-size: 18px;"><strong>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Hora Inicio:', session('locale', 'en'))}}</strong><br> {{\Stichoza\GoogleTranslate\GoogleTranslate::trans(Carbon\Carbon::parse($instancia->hora_inicio)->format('H:i'), session('locale', 'en'))}}</span>
                        <span style="font-size: 18px;"><strong>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Hora Fin:', session('locale', 'en'))}}</strong><br> {{\Stichoza\GoogleTranslate\GoogleTranslate::trans(Carbon\Carbon::parse($instancia->hora_fin)->format('H:i'), session('locale', 'en'))}}</span>
                    </div>
                    <br>

                    <span style="font-size: 18px;"><strong>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Direccion:', session('locale', 'en'))}}</strong><br> {{$instancia->direccion}}</span>

                    <div class="mt-4 flex justify-between text-gray-700 text-sm">
                        <span style="font-size: 18px;"><strong>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Duracion:', session('locale', 'en'))}}</strong><br>
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
                        </span>
                    </div>

                    <br>
                    <p class="text-black text-2xl font-bold px-4 py-2 rounded-lg text-center"><strong>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Precio:', session('locale', 'en'))}}</strong> 💰 ${{$instancia->precio}} UDS</p>

                    <p class="px-4 py-2 rounded-lg text-center">
                        <a href="{{route('instancia.show', $instancia->id)}}" id="checkout-button" class="max-w-[150px] min-w-[150px] bg-[#009ee3] text-white py-2 px-4 rounded-full hover:bg-[009ee3] transition ">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Comprar', session('locale', 'en'))}}</a>
                    </p>
                </div>
            </div>
            @endforeach
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-[#009ee3] text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('&copy; 2025 MiTour. Todos los derechos reservados.', session('locale', 'en'))}} <a href="#" class="text-white hover:text-gray-200">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Terminos y Condiciones', session('locale', 'en'))}}</a></p>
        </div>
    </footer>

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

        document.getElementById("checkout-button").addEventListener("click", async () => {
            const response = await fetch("/payment");
            const data = await response.json();

            const checkout = mp.checkout({
                preference: {
                    id: data.id
                },
                autoOpen: true, // Se abre automáticamente el checkout
            });
        });
    </script>

</body>

</html>