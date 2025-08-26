@extends('layouts.app')

@section('content')
<!-- Elementos decorativos de fondo -->
<div class="fixed inset-0 overflow-hidden pointer-events-none">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-purple-400/20 to-pink-400/20 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 -left-40 w-80 h-80 bg-gradient-to-br from-blue-400/20 to-cyan-400/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 right-1/3 w-80 h-80 bg-gradient-to-br from-green-400/20 to-emerald-400/20 rounded-full blur-3xl"></div>
</div>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/50 to-indigo-50 py-12 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full text-sm font-medium text-purple-800 mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Gestión de Fundaciones
            </div>
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-4">
                Fundaciones Registradas
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Administra y supervisa todas las fundaciones protectoras de animales registradas en la plataforma
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($fundaciones as $fundacion)
                <div class="group bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 flex flex-col items-center border border-white/20 hover:-translate-y-2">
                    <!-- Imagen de perfil con gradiente -->
                    <div class="relative mb-6">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full blur opacity-20 group-hover:opacity-40 transition-opacity"></div>
                        <img src="{{ $fundacion->imagen_perfil_url }}" alt="{{ $fundacion->nombre }}" 
                             class="relative w-32 h-32 object-cover rounded-full border-4 border-white shadow-lg" 
                             onerror="this.onerror=null; this.src='{{ asset('img/fundacion-default.svg') }}'">
                    </div>
                    
                    <!-- Nombre de la fundación -->
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center group-hover:text-purple-600 transition-colors">{{ $fundacion->nombre }}</h2>
                    
                    <!-- Información con iconos -->
                    <div class="space-y-3 w-full mb-6">
                        <div class="flex items-center text-gray-600">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <span class="text-sm">{{ $fundacion->direccion ?? 'No especificada' }}</span>
                        </div>
                        
                        <div class="flex items-center text-gray-600">
                            <div class="w-8 h-8 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <span class="text-sm">{{ $fundacion->animales_count }} animales en adopción</span>
                        </div>
                        
                        <div class="flex items-center text-gray-600">
                            <div class="w-8 h-8 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <span class="text-sm">{{ $fundacion->donaciones_count }} donaciones recibidas</span>
                        </div>
                    </div>
                    
                    <!-- Botón de acción -->
                    <a href="{{ route('publico.fundacion', $fundacion->id) }}" 
                       class="w-full bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 text-center group-hover:shadow-lg">
                        <span class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Ver Perfil Público
                        </span>
                    </a>
                </div>
            @empty
                <!-- Estado vacío modernizado -->
                <div class="col-span-3 flex flex-col items-center justify-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">No hay fundaciones registradas</h3>
                    <p class="text-gray-500 text-center max-w-md">
                        Aún no se han registrado fundaciones en la plataforma. Las fundaciones aparecerán aquí una vez que se registren.
                    </p>
                </div>
            @endforelse
        </div>
        <!-- Paginación modernizada -->
        @if($fundaciones->hasPages())
        <div class="mt-12 flex justify-center">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 px-6 py-4">
                <div class="flex items-center space-x-2">
                    @if($fundaciones->onFirstPage())
                        <span class="px-4 py-2 text-gray-400 cursor-not-allowed rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $fundaciones->previousPageUrl() }}" 
                           class="px-4 py-2 text-purple-600 hover:text-purple-800 hover:bg-purple-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                    @endif
                    
                    <span class="px-4 py-2 text-gray-600 font-medium">
                        Página {{ $fundaciones->currentPage() }} de {{ $fundaciones->lastPage() }}
                    </span>
                    
                    @if($fundaciones->hasMorePages())
                        <a href="{{ $fundaciones->nextPageUrl() }}" 
                           class="px-4 py-2 text-purple-600 hover:text-purple-800 hover:bg-purple-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @else
                        <span class="px-4 py-2 text-gray-400 cursor-not-allowed rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
