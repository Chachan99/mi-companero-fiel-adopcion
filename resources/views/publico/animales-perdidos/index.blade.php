@extends('layouts.app')

@section('title', 'Mascotas Perdidas - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-orange-50">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-red-600 via-red-700 to-orange-600 text-white py-20 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-24 h-24 bg-white opacity-10 rounded-full animate-float"></div>
            <div class="absolute bottom-20 right-20 w-32 h-32 bg-yellow-300 opacity-20 rounded-full animate-float-delayed"></div>
            <div class="absolute top-1/3 right-1/4 w-16 h-16 bg-white opacity-15 rounded-full animate-pulse"></div>
            <div class="absolute bottom-1/3 left-1/3 w-20 h-20 bg-orange-300 opacity-10 rounded-full animate-bounce-slow"></div>
        </div>
        
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/10 to-black/20"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="mb-6">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-full mb-6 backdrop-blur-sm animate-pulse-slow">
                        <svg class="w-10 h-10 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                </div>
                
                <h1 class="text-5xl md:text-7xl font-black mb-6 animate-fade-in-up">
                    <span class="block bg-gradient-to-r from-white to-yellow-200 bg-clip-text text-transparent">Mascotas</span>
                    <span class="block text-yellow-300 animate-pulse-slow">Perdidas</span>
                </h1>
                
                <p class="text-xl md:text-2xl mb-8 max-w-4xl mx-auto opacity-95 leading-relaxed animate-fade-in-up delay-200">
                    Cada mascota perdida es una familia rota. Ayúdanos a reunirlas con el poder de la comunidad.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center animate-fade-in-up delay-400">
                    <a href="{{ route('animales-perdidos.create') }}" class="group bg-gradient-to-r from-yellow-400 to-orange-400 hover:from-yellow-300 hover:to-orange-300 text-gray-900 font-bold py-4 px-8 rounded-full transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-yellow-400/25 flex items-center">
                        <svg class="w-5 h-5 mr-3 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Reportar Mascota Perdida
                    </a>
                    <a href="#como-ayudar" class="group bg-white/20 hover:bg-white/30 text-white font-semibold py-4 px-8 rounded-full transition-all duration-300 backdrop-blur-md border border-white/30 hover:border-white/50 flex items-center">
                        <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        ¿Cómo puedo ayudar?
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        @if(session('success'))
            <div class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl shadow-lg backdrop-blur-sm animate-slide-down">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Filtros de búsqueda -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 mb-12 border border-gray-100 hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-red-500 to-orange-500 p-3 rounded-xl mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Filtrar Búsqueda</h2>
            </div>
            
            <form method="GET" action="{{ route('animales-perdidos.index') }}" class="space-y-6 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-6">
                <div class="space-y-2">
                    <label for="tipo" class="block text-sm font-semibold text-gray-700 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Tipo de mascota
                    </label>
                    <select name="tipo" id="tipo" class="block w-full px-4 py-3 text-base border-2 border-gray-200 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm transition-all duration-200 bg-white hover:border-gray-300">
                        <option value="">🐾 Todos los tipos</option>
                        <option value="perro" {{ request('tipo') == 'perro' ? 'selected' : '' }}>🐕 Perro</option>
                        <option value="gato" {{ request('tipo') == 'gato' ? 'selected' : '' }}>🐱 Gato</option>
                        <option value="otro" {{ request('tipo') == 'otro' ? 'selected' : '' }}>🐹 Otro</option>
                    </select>
                </div>
                
                <div class="space-y-2">
                    <label for="ubicacion" class="block text-sm font-semibold text-gray-700 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Ubicación
                    </label>
                    <input type="text" name="ubicacion" id="ubicacion" value="{{ request('ubicacion') }}" placeholder="🏙️ Ciudad, barrio, zona..." class="block w-full px-4 py-3 border-2 border-gray-200 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm transition-all duration-200 bg-white hover:border-gray-300">
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center group">
                        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Buscar Mascotas
                    </button>
                </div>
            </form>
        </div>

        @if($animalesPerdidos->isEmpty())
            <div class="text-center py-20">
                <div class="max-w-md mx-auto">
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-full w-32 h-32 flex items-center justify-center mx-auto mb-8 shadow-inner">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">¡Excelente noticia!</h3>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">No hay mascotas perdidas reportadas en este momento. Esperemos que todas estén seguras en casa con sus familias.</p>
                    <div class="space-y-4">
                        <a href="{{ route('animales-perdidos.create') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white font-bold rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Reportar Mascota Perdida
                        </a>
                        <p class="text-sm text-gray-500">¿Perdiste a tu mascota? Repórtala aquí para que la comunidad te ayude a encontrarla.</p>
                    </div>
                </div>
            </div>
        @else
            <!-- Header de resultados -->
            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-8 gap-4">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-red-500 to-orange-500 p-2 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Mascotas Perdidas</h2>
                        <p class="text-gray-600 mt-1">{{ $animalesPerdidos->total() }} {{ $animalesPerdidos->total() == 1 ? 'mascota reportada' : 'mascotas reportadas' }}</p>
                    </div>
                </div>
                
                <div class="flex items-center bg-white rounded-xl shadow-md px-4 py-2 border border-gray-200">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700 mr-3">Ordenar por:</span>
                    <select onchange="window.location.href = this.value" class="bg-transparent border-none focus:ring-0 text-sm font-medium text-gray-900 cursor-pointer">
                        <option value="{{ route('animales-perdidos.index', ['sort' => 'recientes', ...request()->except('sort')]) }}" {{ request('sort') == 'recientes' || !request()->has('sort') ? 'selected' : '' }}>📅 Más recientes</option>
                        <option value="{{ route('animales-perdidos.index', ['sort' => 'antiguos', ...request()->except('sort')]) }}" {{ request('sort') == 'antiguos' ? 'selected' : '' }}>⏰ Más antiguos</option>
                        <option value="{{ route('animales-perdidos.index', ['sort' => 'recompensa', ...request()->except('sort')]) }}" {{ request('sort') == 'recompensa' ? 'selected' : '' }}>⭐ Con recompensa</option>
                    </select>
                </div>
            </div>

            <!-- Grid de mascotas perdidas -->
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($animalesPerdidos as $animal)
                    <div class="group bg-white overflow-hidden shadow-lg rounded-2xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col h-full border border-gray-100">
                        <div class="relative pb-56 overflow-hidden">
                            <img class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ $animal->imagen_url ?: asset('img/default-pet.svg') }}" alt="{{ $animal->nombre }}" loading="lazy">
                            
                            <!-- Overlay gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <!-- Status badges -->
                            <div class="absolute inset-x-0 top-0 p-4 flex justify-between items-start">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-red-500 text-white shadow-lg animate-pulse">
                                    🚨 PERDIDO
                                </span>
                                @if($animal->recompensa)
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-400 to-orange-400 text-gray-900 shadow-lg">
                                        <svg class="-ml-0.5 mr-1.5 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        RECOMPENSA
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Quick action button -->
                            <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                <a href="{{ route('animales-perdidos.show', $animal->id) }}" class="bg-white/90 hover:bg-white text-gray-900 p-3 rounded-full shadow-lg backdrop-blur-sm transition-all duration-200 hover:scale-110">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-900 truncate flex-1 mr-2">{{ $animal->nombre ?: '🐾 Sin nombre' }}</h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-100 to-indigo-100 text-indigo-800 capitalize whitespace-nowrap">
                                    @if($animal->tipo == 'perro')
                                        🐕 {{ $animal->tipo }}
                                    @elseif($animal->tipo == 'gato')
                                        🐱 {{ $animal->tipo }}
                                    @else
                                        🐹 {{ $animal->tipo ?: 'mascota' }}
                                    @endif
                                </span>
                            </div>
                            
                            <div class="space-y-3 flex-1">
                                <div class="flex items-center text-sm text-gray-600">
                                    <div class="bg-red-100 p-1.5 rounded-lg mr-3">
                                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium">{{ $animal->ultima_ubicacion ?: '📍 Ubicación no especificada' }}</span>
                                </div>
                                
                                <div class="flex items-center text-sm text-gray-600">
                                    <div class="bg-blue-100 p-1.5 rounded-lg mr-3">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium">{{ $animal->created_at->diffForHumans() }}</span>
                                </div>
                                
                                @if($animal->descripcion)
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-700 line-clamp-3 leading-relaxed">{{ $animal->descripcion }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                            <span class="text-xs font-medium text-gray-500 bg-gray-200 px-2 py-1 rounded-full">
                                ID: #{{ $animal->id }}
                            </span>
                            <a href="{{ route('animales-perdidos.show', $animal->id) }}" class="group/link text-sm font-bold text-red-600 hover:text-red-700 flex items-center transition-all duration-200">
                                Ver detalles
                                <svg class="ml-2 h-4 w-4 transform group-hover/link:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="mt-12 flex justify-center">
                <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
                    {{ $animalesPerdidos->withQueryString()->links() }}
                </div>
            </div>
        @endif

        <!-- Sección de cómo ayudar -->
        <div id="como-ayudar" class="mt-20">
            <div class="bg-gradient-to-br from-white via-red-50 to-orange-50 rounded-3xl shadow-2xl overflow-hidden border border-red-100">
                <!-- Header de la sección -->
                <div class="bg-gradient-to-r from-red-600 to-orange-600 px-8 py-12 text-white relative overflow-hidden">
                    <div class="absolute inset-0">
                        <div class="absolute top-4 right-4 w-20 h-20 bg-white opacity-10 rounded-full animate-pulse"></div>
                        <div class="absolute bottom-4 left-4 w-16 h-16 bg-yellow-300 opacity-20 rounded-full animate-bounce-slow"></div>
                    </div>
                    <div class="relative text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-6 backdrop-blur-sm">
                            <svg class="w-8 h-8 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-4xl font-black mb-4">¿Cómo Puedo Ayudar?</h2>
                        <p class="text-xl opacity-90 max-w-2xl mx-auto">Juntos podemos hacer la diferencia. Cada acción cuenta para reunir a las mascotas con sus familias.</p>
                    </div>
                </div>
                
                <div class="p-8 lg:p-12">
                    <!-- Formas de ayudar -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                        <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="bg-gradient-to-br from-blue-500 to-purple-600 p-4 rounded-2xl mr-4 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900">Comparte en Redes</h3>
                            </div>
                            <p class="text-gray-600 leading-relaxed text-lg">Amplifica el alcance compartiendo los reportes en tus redes sociales. Un simple share puede ser la clave para el reencuentro.</p>
                            <div class="mt-6 flex space-x-2">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">📱 Facebook</span>
                                <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm font-medium">📸 Instagram</span>
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">🐦 Twitter</span>
                            </div>
                        </div>
                        
                        <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="bg-gradient-to-br from-yellow-500 to-orange-600 p-4 rounded-2xl mr-4 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900">Ofrece Recompensa</h3>
                            </div>
                            <p class="text-gray-600 leading-relaxed text-lg">Una recompensa puede motivar a más personas a estar atentas y reportar avistamientos de la mascota perdida.</p>
                            <div class="mt-6">
                                <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-bold">⭐ Incentivo Extra</span>
                            </div>
                        </div>
                        
                        <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="bg-gradient-to-br from-green-500 to-teal-600 p-4 rounded-2xl mr-4 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900">Reporta Avistamientos</h3>
                            </div>
                            <p class="text-gray-600 leading-relaxed text-lg">Si ves una mascota que coincide con algún reporte, contacta inmediatamente. Tu observación puede ser crucial.</p>
                            <div class="mt-6">
                                <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-bold">👁️ Mantente Alerta</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Consejos importantes -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-8 border border-gray-200">
                        <div class="flex items-center mb-6">
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-3 rounded-xl mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Consejos si Encuentras una Mascota Perdida</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="bg-blue-500 text-white rounded-full p-2 mr-4 mt-1 flex-shrink-0">
                                        <span class="text-sm font-bold">1</span>
                                    </div>
                                    <p class="text-gray-700 font-medium">Acércate con cuidado y verifica si tiene collar con identificación</p>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-green-500 text-white rounded-full p-2 mr-4 mt-1 flex-shrink-0">
                                        <span class="text-sm font-bold">2</span>
                                    </div>
                                    <p class="text-gray-700 font-medium">Si es seguro, lleva la mascota a un veterinario para escanear su microchip</p>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-purple-500 text-white rounded-full p-2 mr-4 mt-1 flex-shrink-0">
                                        <span class="text-sm font-bold">3</span>
                                    </div>
                                    <p class="text-gray-700 font-medium">Toma fotos claras desde diferentes ángulos</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="bg-orange-500 text-white rounded-full p-2 mr-4 mt-1 flex-shrink-0">
                                        <span class="text-sm font-bold">4</span>
                                    </div>
                                    <p class="text-gray-700 font-medium">Publica en grupos locales de mascotas perdidas</p>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-red-500 text-white rounded-full p-2 mr-4 mt-1 flex-shrink-0">
                                        <span class="text-sm font-bold">5</span>
                                    </div>
                                    <p class="text-gray-700 font-medium">No alimentes con comida desconocida (puede tener alergias)</p>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-teal-500 text-white rounded-full p-2 mr-4 mt-1 flex-shrink-0">
                                        <span class="text-sm font-bold">6</span>
                                    </div>
                                    <p class="text-gray-700 font-medium">Mantén la calma y actúa con paciencia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- CTA final -->
                    <div class="text-center mt-12">
                        <div class="bg-gradient-to-r from-red-600 to-orange-600 rounded-2xl p-8 text-white">
                            <h3 class="text-3xl font-bold mb-4">¿Perdiste a tu mascota?</h3>
                            <p class="text-xl mb-8 opacity-90">No esperes más. Cada minuto cuenta para aumentar las posibilidades de reencuentro.</p>
                            <a href="{{ route('animales-perdidos.create') }}" class="inline-flex items-center px-8 py-4 bg-white text-red-600 font-bold rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Reportar Ahora
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS personalizado para animaciones -->
<style>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes float-delayed {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}

@keyframes bounce-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@keyframes pulse-slow {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slide-down {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float-delayed 8s ease-in-out infinite;
}

.animate-bounce-slow {
    animation: bounce-slow 4s ease-in-out infinite;
}

.animate-pulse-slow {
    animation: pulse-slow 3s ease-in-out infinite;
}

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out;
}

.animate-slide-down {
    animation: slide-down 0.5s ease-out;
}

.delay-200 {
    animation-delay: 0.2s;
}

.delay-400 {
    animation-delay: 0.4s;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
