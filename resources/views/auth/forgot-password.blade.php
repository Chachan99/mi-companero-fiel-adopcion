<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-blue-50 to-cyan-100 min-h-screen">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 to-cyan-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border-2 border-cyan-200">
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <svg class="w-12 h-12 text-cyan-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.11 3.89 23 5 23H11V21H5V3H13V9H21Z"/>
                        <path d="M17 13C15.34 13 14 14.34 14 16S15.34 19 17 19 20 17.66 20 16 18.66 13 17 13M17 21C14.24 21 12 18.76 12 16S14.24 11 17 11 22 13.24 22 16 19.76 21 17 21M17.5 16.25L15.75 14.5V17.5H16.25V15.25L17.5 16.25Z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-blue-900 mb-2">Recuperar Contraseña</h2>
                <p class="text-cyan-700">Te enviaremos un enlace para restablecer tu contraseña</p>
            </div>

            <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <p class="text-sm text-blue-800">
                    ¿Olvidaste tu contraseña? No hay problema. Solo proporciona tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                </p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-50 rounded-lg border border-green-200">
                    <p class="text-sm text-green-800 font-medium">{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" novalidate>
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-blue-900 mb-2">{{ __("Email") }}</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full px-4 py-3 rounded-lg border border-cyan-300 focus:border-cyan-500 focus:ring focus:ring-cyan-200 focus:ring-opacity-50 transition-colors"
                        placeholder="tu@email.com"
                    />
                    @error('email')
                        <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-900 to-cyan-400 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:from-cyan-600 hover:to-blue-800 transition-all duration-200">
                        {{ __("Enviar Enlace de Recuperación") }}
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        ¿Recordaste tu contraseña? 
                        <a href="{{ route('login') }}" class="text-cyan-600 hover:text-cyan-800 font-semibold underline">
                            Volver al login
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
