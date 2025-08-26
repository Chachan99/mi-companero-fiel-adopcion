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
                        <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.11 3.89 23 5 23H19C20.11 23 21 22.11 21 21V9M20 8L15 3H5V21H19V8M7 12V14H17V12H7M7 16V18H14V16H7Z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-blue-900 mb-2">Verificar Email</h2>
                <p class="text-cyan-700">Confirma tu dirección de correo electrónico</p>
            </div>

            <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <p class="text-sm text-blue-800">
                    ¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar? Si no recibiste el correo, con gusto te enviaremos otro.
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 p-4 bg-green-50 rounded-lg border border-green-200">
                    <p class="text-sm text-green-800 font-medium">
                        Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.
                    </p>
                </div>
            @endif

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
                <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-blue-900 to-cyan-400 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:from-cyan-600 hover:to-blue-800 transition-all duration-200">
                        {{ __("Reenviar Email de Verificación") }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto text-sm text-gray-600 hover:text-gray-900 underline font-medium px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-colors">
                        {{ __("Cerrar Sesión") }}
                    </button>
                </form>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600">
                    ¿Problemas con la verificación? 
                    <a href="mailto:soporte@adopcionanimales.com" class="text-cyan-600 hover:text-cyan-800 font-semibold underline">
                        Contacta soporte
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
