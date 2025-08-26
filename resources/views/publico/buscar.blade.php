@extends('layouts.app')

@section('title', 'Buscar Mascotas - ' . config('app.name'))

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-700 text-white py-20 px-6 lg:px-12 overflow-hidden">
  <!-- Elementos decorativos -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute top-10 right-10 w-32 h-32 bg-white/10 rounded-full mix-blend-overlay filter blur-xl"></div>
    <div class="absolute bottom-10 left-10 w-40 h-40 bg-white/10 rounded-full mix-blend-overlay filter blur-xl"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full mix-blend-overlay filter blur-3xl"></div>
  </div>

  <div class="relative max-w-6xl mx-auto text-center">
    <!-- Icono principal -->
    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl mb-6">
      <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
      </svg>
    </div>
    
    <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white via-emerald-100 to-cyan-100 bg-clip-text text-transparent">
      Buscar Mascotas
    </h1>
    <p class="text-xl md:text-2xl text-emerald-100 max-w-3xl mx-auto mb-8 leading-relaxed">
      Encuentra a tu compañero perfecto usando nuestros filtros avanzados
    </p>
  </div>
</section>

<!-- Filtros de búsqueda modernos -->
<section class="py-12 px-6 lg:px-12 bg-gradient-to-b from-gray-50 to-white">
  <div class="max-w-6xl mx-auto">
    <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-white/20 mb-12">
      <div class="flex items-center mb-6">
        <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center mr-3">
          <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
          </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Filtros de Búsqueda</h2>
      </div>
      
      <form action="{{ route('publico.buscar') }}" method="GET" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Tipo de Mascota</label>
            <div class="relative">
              <select name="tipo" class="w-full pl-4 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white/70 backdrop-blur-sm transition-all duration-300 appearance-none">
                <option value="">🐾 Todos los tipos</option>
                <option value="perro" @if(request('tipo') === 'perro') selected @endif>🐕 Perros</option>
                <option value="gato" @if(request('tipo') === 'gato') selected @endif>🐱 Gatos</option>
                <option value="otro" @if(request('tipo') === 'otro') selected @endif>🐰 Otros</option>
              </select>
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </div>
            </div>
          </div>
          
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Edad Mínima</label>
            <div class="relative">
              <input type="number" name="edad_min" value="{{ request('edad_min') }}" min="0" max="20" placeholder="0"
                     class="w-full pl-4 pr-12 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white/70 backdrop-blur-sm transition-all duration-300">
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <span class="text-gray-400 text-sm">años</span>
              </div>
            </div>
          </div>
          
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Edad Máxima</label>
            <div class="relative">
              <input type="number" name="edad_max" value="{{ request('edad_max') }}" min="0" max="20" placeholder="20"
                     class="w-full pl-4 pr-12 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white/70 backdrop-blur-sm transition-all duration-300">
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <span class="text-gray-400 text-sm">años</span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 pt-4">
          <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center group">
            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            Buscar Mascotas
          </button>
          <a href="{{ route('publico.buscar') }}" class="flex-shrink-0 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-4 px-6 rounded-xl transition-all duration-300 flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Limpiar
          </a>
        </div>
      </form>
    </div>

    <!-- Resultados -->
    <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-white/20">
      <div class="flex items-center justify-between mb-8">
        <div class="flex items-center">
          <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center mr-3">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
          </div>
          <h2 class="text-2xl font-bold text-gray-800">Resultados de Búsqueda</h2>
        </div>
        @if(count($animales) > 0)
        <div class="bg-emerald-100 text-emerald-800 px-4 py-2 rounded-full text-sm font-semibold">
          {{ $animales->total() }} {{ $animales->total() === 1 ? 'mascota encontrada' : 'mascotas encontradas' }}
        </div>
        @endif
      </div>
      
      @if(count($animales) === 0)
        <div class="text-center py-16">
          <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-800 mb-2">No se encontraron mascotas</h3>
          <p class="text-gray-600 mb-6 max-w-md mx-auto">No hay mascotas que coincidan con tus criterios de búsqueda. Intenta ajustar los filtros o explorar todas nuestras mascotas disponibles.</p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('publico.buscar') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
              </svg>
              Limpiar Filtros
            </a>
            <a href="{{ route('publico.animales') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all duration-300">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
              </svg>
              Ver Todas las Mascotas
            </a>
          </div>
        </div>
      @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach($animales as $animal)
          <div class="group bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-white/20 hover:border-emerald-200 transform hover:-translate-y-2">
            <div class="relative aspect-square overflow-hidden">
              <img 
                src="{{ $animal->imagen_url }}"
                alt="{{ $animal->nombre }}"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                onerror="this.onerror=null; this.src='{{ asset('img/animal-default.svg') }}'"
                loading="lazy"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full p-2 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
                <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
              </div>
            </div>
            
            <div class="p-6">
              <div class="flex items-start justify-between mb-3">
                <h3 class="text-xl font-bold text-gray-800 group-hover:text-emerald-600 transition-colors duration-300">{{ $animal->nombre }}</h3>
                <div class="flex items-center text-sm text-gray-500">
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  {{ $animal->fundacion->perfil->ubicacion ?? 'Sin ubicación' }}
                </div>
              </div>
              
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="inline-flex items-center px-3 py-1 bg-emerald-100 text-emerald-800 text-sm font-medium rounded-full">
                  @if($animal->tipo === 'perro') 🐕 @elseif($animal->tipo === 'gato') 🐱 @else 🐰 @endif
                  {{ ucfirst($animal->tipo) }}
                </span>
                <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                  ⏰ {{ $animal->edad }} {{ $animal->tipo_edad === 'anios' ? 'años' : 'meses' }}
                </span>
                <span class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">
                  @if($animal->sexo === 'macho') ♂️ @else ♀️ @endif {{ ucfirst($animal->sexo) }}
                </span>
              </div>
              
              <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                {{ $animal->descripcion }}
              </p>
              
              <div class="flex flex-col gap-3">
                @auth
                  <form action="{{ route('adopcion.store') }}" method="POST" class="w-full">
                    @csrf
                    <input type="hidden" name="animal_id" value="{{ $animal->id }}">
                    <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center group">
                      <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                      </svg>
                      Solicitar Adopción
                    </button>
                  </form>
                @else
                  <a href="{{ route('publico.animal', $animal->id) }}" class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center group">
                    <svg class="w-5 h-5 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Ver Detalles
                  </a>
                @endauth
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <!-- Paginación moderna -->
        @if($animales->hasPages())
        <div class="mt-12 flex justify-center">
          <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-4 border border-white/20">
            {{ $animales->links() }}
          </div>
        </div>
        @endif
      @endif
    </div>
  </div>
</section>
@endsection
