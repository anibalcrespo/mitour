@extends('layouts.app')

@section('content')
<div class="min-h-10 flex items-center justify-center bg-gray-100">
    <div class="max-w[300px] mx-auto bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ __('Iniciar Sesión') }}</h2>

        {{-- Mensajes de error --}}
        @if ($errors->any())
            <div class="mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#009ee3] focus:border-[#009ee3]"
                >
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#009ee3] focus:border-[#009ee3]"
                >
            </div>

            {{-- Recordarme --}}
            <div class="flex items-center justify-between">
                <label for="remember" class="flex items-center">
                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                        class="h-4 w-4 text-[#009ee3] focus:ring-[#009ee3] border-gray-300 rounded"
                        {{ old('remember') ? 'checked' : '' }}
                    >
                    <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-[#009ee3] hover:text-[#009ee3]">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            {{-- Botón de Ingreso --}}
            <div>
                <button
                    type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-[#009ee3] hover:bg-[#009ee3] focus:outline-none focus:ring-2 focus:ring-[#009ee3]"
                >
                    {{ __('Ingresar') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection