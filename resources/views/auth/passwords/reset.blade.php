@extends('layouts.app')

@section('content')
<div class="flex justify-center py-12">
    <div class="w-full max-w-xl">
        <div class="bg-white shadow-md rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 text-lg font-semibold">
                {{ __('Reset Password') }}
            </div>

            <div class="px-6 py-4">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">
                            {{ __('Email Address') }}
                        </label>

                        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                            class="w-full px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200">

                        @error('email')
                            <span class="text-sm text-red-600 mt-2 block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-medium mb-2">
                            {{ __('Password') }}
                        </label>

                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200">

                        @error('password')
                            <span class="text-sm text-red-600 mt-2 block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-6">
                        <label for="password-confirm" class="block text-gray-700 font-medium mb-2">
                            {{ __('Confirm Password') }}
                        </label>

                        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200">
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-[#009ee3] border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-200">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
