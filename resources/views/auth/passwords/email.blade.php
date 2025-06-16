@extends('layouts.app')

@section('content')
<div class="flex justify-center py-12">
    <div class="w-full max-w-xl">
        <div class="bg-white shadow-md rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 text-lg font-semibold">
                {{ __('Reset Password') }}
            </div>

            <div class="px-6 py-4">
                @if (session('status'))
                    <div class="mb-4 p-4 text-green-700 bg-green-100 border border-green-300 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">
                            {{ __('Email Address') }}
                        </label>

                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            class="w-full px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200">

                        @error('email')
                            <span class="text-sm text-red-600 mt-2 block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-[#009ee3] border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-200">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
