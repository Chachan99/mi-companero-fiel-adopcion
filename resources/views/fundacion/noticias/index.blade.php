@extends('layouts.app')

@section('title', 'Mis Noticias')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 relative overflow-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400/20 to-purple-400/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-indigo-400/20 to-pink-400/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-purple-300/10 to-blue-300/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-12">
        <!-- Modern Hero Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full border-2 border-blue-200 mb-6">
                <svg class="h-5 w-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                    <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V9a1 1 0 00-1-1h-1v3a2 2 0 01-2 2H5a2 2 0 01-2-2V9a1 1 0 00-1 1v5.5a1.5 1.5 0 01-3 0V9a2 2 0 012-2h1V7a2 2 0 012-2h8a2 2 0 012 2z"></path>
                </svg>
                <span class="text-blue-700 font-bold text-sm">Gestión de Contenido</span>
            </div>
            <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent mb-4">
                Mis Noticias
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Gestiona y publica noticias para mantener informada a tu comunidad sobre las actividades de tu fundación
            </p>
            <a href="{{ route('fundacion.noticias.create') }}" 
               class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl shadow-xl hover:from-blue-700 hover:to-indigo-700 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <svg class="h-6 w-6 mr-3 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                Nueva Noticia
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-8 mx-auto max-w-2xl">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-lg font-bold text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content Container -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
            @if($noticias->count() > 0)
                <!-- Modern News List -->
                <div class="p-8">
                    <div class="space-y-6">
                        @foreach($noticias as $noticia)
                            <div class="group bg-gradient-to-r from-white to-blue-50 rounded-2xl shadow-lg hover:shadow-xl border-2 border-blue-100 hover:border-blue-200 transition-all duration-300 overflow-hidden">
                                <div class="p-6">
                                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                                        <!-- News Info Section -->
                                        <div class="flex-1">
                                            <div class="flex items-start gap-4">
                                                <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center shadow-lg">
                                                    <svg class="h-6 w-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                                                        <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V9a1 1 0 00-1-1h-1v3a2 2 0 01-2 2H5a2 2 0 01-2-2V9a1 1 0 00-1 1v5.5a1.5 1.5 0 01-3 0V9a2 2 0 012-2h1V7a2 2 0 012-2h8a2 2 0 012 2z"></path>
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors duration-300">
                                                        {{ $noticia->titulo }}
                                                    </h3>
                                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                                        <div class="flex items-center gap-2">
                                                            <svg class="h-4 w-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span>{{ $noticia->fecha_publicacion ? $noticia->fecha_publicacion->format('d/m/Y H:i') : 'No publicada' }}</span>
                                                        </div>
                                                        <div class="flex items-center">
                                                            @if($noticia->publicada)
                                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-green-400 to-emerald-400 text-white shadow-lg">
                                                                    <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    Publicada
                                                                </span>
                                                            @else
                                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-400 to-orange-400 text-white shadow-lg">
                                                                    <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    Borrador
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex gap-3">
                                            <a href="{{ route('fundacion.noticias.edit', $noticia) }}" 
                                               class="group/btn flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-xl shadow-lg hover:from-blue-600 hover:to-indigo-700 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                                <svg class="h-4 w-4 mr-2 group-hover/btn:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                </svg>
                                                Editar
                                            </a>
                                            <form action="{{ route('fundacion.noticias.destroy', $noticia) }}" method="POST" 
                                                  onsubmit="return confirm('¿Estás seguro de eliminar esta noticia?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="group/btn flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-pink-600 text-white font-bold rounded-xl shadow-lg hover:from-red-600 hover:to-pink-700 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                                    <svg class="h-4 w-4 mr-2 group-hover/btn:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414L9.586 12l-3.293 3.293a1 1 0 101.414 1.414L10 13.414l2.293 2.293a1 1 0 001.414-1.414L10.414 12l2.293-2.293z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Modern Pagination -->
                <div class="px-8 py-6 bg-gradient-to-r from-gray-50 to-blue-50 border-t border-gray-200">
                    <div class="flex justify-center">
                        <div class="bg-white rounded-2xl shadow-lg border-2 border-blue-100 p-4">
                            {{ $noticias->links() }}
                        </div>
                    </div>
                </div>
            @else
                <!-- Modern Empty State -->
                <div class="text-center py-16 px-8">
                    <div class="w-24 h-24 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="h-12 w-12 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">No hay noticias publicadas</h3>
                    <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">
                        Comienza a compartir las actividades y logros de tu fundación creando tu primera noticia.
                    </p>
                    <a href="{{ route('fundacion.noticias.create') }}" 
                       class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl shadow-xl hover:from-blue-700 hover:to-indigo-700 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <svg class="h-5 w-5 mr-2 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Crear Primera Noticia
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
