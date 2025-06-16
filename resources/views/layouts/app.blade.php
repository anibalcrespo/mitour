<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Administrador') }}</title>

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
</head>

<body class="bg-blue-50 font-[Open_Sans] antialiased flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-[#009ee3] text-white p-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-semibold font-[Kodchasan]"><a href="{{route('welcome')}}" class="text-white">MiTour</a></h1>
            <!-- Botón del menú hamburguesa -->
            <button onclick="toggleMenu()" class="lg:hidden text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <!-- Menú de escritorio -->
            <nav class="hidden lg:flex space-x-6">
            @auth
                <a href="{{route('tipo_actividades.index')}}" class="text-white hover:text-gray-200">Tipo Actividades</a>
                <a href="{{route('actividades.index')}}" class="text-white hover:text-gray-200">Actividades</a>
                <a href="{{route('instancias.index')}}" class="text-white hover:text-gray-200">Instancias</a>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form1').submit();"
                    class="text-white hover:text-gray-200">Salir</a>
                <form id="logout-form1" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth
            </nav>
        </div>
        <!-- Menú móvil -->
        <div id="mobile-menu" class="lg:hidden hidden bg-[#009ee3] text-white space-y-4 p-6 absolute top-16 left-0 w-full">
            @auth
            <a href="{{route('tipo_actividades.index')}}" class="block">Tipo Actividades</a>
            <a href="{{route('actividades.index')}}" class="block">Actividades</a>
            <a href="{{route('instancias.index')}}" class="block">Instancias</a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form2').submit();"
                class="block">Salir</a>
            <form id="logout-form2" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            @endauth
        </div>
    </header>

    <main class="flex-grow w-full w-full overflow-auto bg-blue-50 p-4">
        <!-- Aquí va tu contenido, si es largo, activará el scroll -->
        <p class="mt-4">
            @yield('content')
        </p>
    </main>

    <!-- Footer pegado abajo -->
    <footer class="bg-[#009ee3] text-white p-4 text-center w-full">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 MiTour. Todos los derechos reservados. <a href="#" class="text-white hover:text-gray-200">Terminos y Condiciones</a></p>
        </div>
    </footer>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    @yield('script')
</body>

</html>