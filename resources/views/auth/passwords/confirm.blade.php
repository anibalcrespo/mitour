@extends('layouts.app')

@section('content')
<div class="flex justify-center py-12">
    <div class="w-full max-w-xl">
        <div class="bg-white shadow-md rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 text-lg font-semibold">
                {{ __('Confirm Password') }}
            </div>

            <div class="px-6 py-4">
                <p class="mb-4 text-gray-600">
                    {{ __('Please confirm your password before continuing.') }}
                </p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-medium mb-2">
                            {{ __('Password') }}
                        </label>

                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200">

                        @error('password')
                            <span class="text-sm text-red-600 mt-2 block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-[#009ee3] border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-200">
                            {{ __('Confirm Password') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="ml-4 text-sm text-[#009ee3] hover:underline" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection