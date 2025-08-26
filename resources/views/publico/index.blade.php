@extends('layouts.app')

@section('content')

<!-- Hero Section Moderno -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-emerald-50 via-white to-green-50">
  <!-- Elementos decorativos de fondo -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-emerald-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-green-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
    <div class="absolute top-40 left-40 w-80 h-80 bg-teal-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
  </div>

  <div class="relative max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
      <!-- Contenido Principal -->
      <div class="text-center lg:text-left">
        <!-- Badge -->
        <div class="inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium mb-6">
          <i class="fas fa-heart mr-2 text-emerald-500"></i>
          Más de 1,000 adopciones exitosas
        </div>
        
        <!-- Título Principal -->
        <h1 class="text-5xl lg:text-7xl font-bold text-gray-900 mb-6 leading-tight">
          Encuentra tu
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-green-600">
            compañero
          </span>
          perfecto
        </h1>
        
        <!-- Subtítulo -->
        <p class="text-xl text-gray-600 mb-8 leading-relaxed max-w-lg">
          Conectamos corazones con patas. Descubre mascotas increíbles esperando un hogar lleno de amor y cuidado.
        </p>
        
        <!-- Estadísticas -->
        <div class="flex flex-wrap gap-8 mb-10 justify-center lg:justify-start">
          <div class="text-center">
            <div class="text-3xl font-bold text-emerald-600">500+</div>
            <div class="text-sm text-gray-500">Mascotas disponibles</div>
          </div>
          <div class="text-center">
            <div class="text-3xl font-bold text-emerald-600">50+</div>
            <div class="text-sm text-gray-500">Fundaciones aliadas</div>
          </div>
          <div class="text-center">
            <div class="text-3xl font-bold text-emerald-600">24/7</div>
            <div class="text-sm text-gray-500">Soporte disponible</div>
          </div>
        </div>
        
        <!-- Botones de Acción -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
          <a href="{{ route('publico.buscar') }}" class="group inline-flex items-center justify-center px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <i class="fas fa-search mr-2 group-hover:scale-110 transition-transform"></i>
            Explorar Mascotas
          </a>
          <a href="{{ route('publico.informacion') }}" class="group inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200">
            <i class="fas fa-info-circle mr-2 text-emerald-600 group-hover:scale-110 transition-transform"></i>
            Guía de Adopción
          </a>
        </div>
      </div>
      
      <!-- Galería de Mascotas -->
      <div class="relative">
        <div class="grid grid-cols-2 gap-4 max-w-md mx-auto">
          @foreach($animales->take(4) as $index => $animal)
            <div class="relative group cursor-pointer transform transition-all duration-300 hover:scale-105 {{ $index % 2 == 0 ? 'mt-8' : '' }}">
              <div class="aspect-square rounded-2xl overflow-hidden shadow-lg bg-white p-2">
                <img 
                  src="{{ $animal->imagen_url }}" 
                  alt="{{ $animal->nombre }}"
                  class="w-full h-full object-cover rounded-xl"
                  onerror="this.onerror=null; this.src='{{ asset('img/animal-default.svg') }}'"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl flex items-end">
                  <div class="text-white p-4">
                    <h3 class="font-semibold">{{ $animal->nombre }}</h3>
                    <p class="text-sm opacity-90">{{ ucfirst($animal->tipo) }}</p>
                  </div>
                </div>
              </div>
              <!-- Indicador de disponibilidad -->
              <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 rounded-full border-2 border-white shadow-sm"></div>
            </div>
          @endforeach
        </div>
        
        <!-- Elemento decorativo -->
        <div class="absolute -z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-emerald-200 to-green-200 rounded-full opacity-20 blur-3xl"></div>
      </div>
    </div>
  </div>
  
  <!-- Scroll indicator -->
  <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
    <div class="w-6 h-10 border-2 border-gray-400 rounded-full flex justify-center">
      <div class="w-1 h-3 bg-gray-400 rounded-full mt-2 animate-pulse"></div>
    </div>
  </div>
</section>

<!-- Estilos adicionales para animaciones -->
<style>
  @keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
  }
  .animate-blob {
    animation: blob 7s infinite;
  }
  .animation-delay-2000 {
    animation-delay: 2s;
  }
  .animation-delay-4000 {
    animation-delay: 4s;
  }
</style>

<!-- Sección de Búsqueda Moderna -->
<section class="py-16 px-6 lg:px-12 bg-white">
  <div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-12">
      <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
        Busca tu
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-green-600">
          compañero ideal
        </span>
      </h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Utiliza nuestros filtros para encontrar exactamente lo que buscas
      </p>
    </div>

    <!-- Formulario de Búsqueda -->
    <div class="bg-gray-50 rounded-2xl p-8 shadow-lg border border-gray-100">
      <form action="{{ route('publico.buscar') }}" method="GET" class="space-y-6">
        <!-- Filtros principales -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
          <!-- Tipo de Animal -->
          <div class="space-y-2">
            <label for="tipo" class="block text-sm font-semibold text-gray-700">
              <i class="fas fa-paw mr-2 text-emerald-600"></i>
              Tipo de Animal
            </label>
            <select id="tipo" name="tipo" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors text-gray-900">
              <option value="" {{ request('tipo') == '' ? 'selected' : '' }}>Todos los tipos</option>
              <option value="perro" {{ request('tipo') == 'perro' ? 'selected' : '' }}>🐕 Perros</option>
              <option value="gato" {{ request('tipo') == 'gato' ? 'selected' : '' }}>🐱 Gatos</option>
              <option value="pequeño" {{ request('tipo') == 'pequeño' ? 'selected' : '' }}>🐹 Mascotas Pequeñas</option>
            </select>
          </div>

          <!-- Edad Mínima -->
          <div class="space-y-2">
            <label for="edad_min" class="block text-sm font-semibold text-gray-700">
              <i class="fas fa-calendar-alt mr-2 text-emerald-600"></i>
              Edad Mínima
            </label>
            <div class="relative">
              <input 
                type="number" 
                id="edad_min" 
                name="edad_min" 
                min="0" 
                placeholder="0" 
                value="{{ request('edad_min') }}"
                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors text-gray-900 pr-16"
              />
              <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-sm text-gray-500">años</span>
            </div>
          </div>

          <!-- Edad Máxima -->
          <div class="space-y-2">
            <label for="edad_max" class="block text-sm font-semibold text-gray-700">
              <i class="fas fa-calendar-check mr-2 text-emerald-600"></i>
              Edad Máxima
            </label>
            <div class="relative">
              <input 
                type="number" 
                id="edad_max" 
                name="edad_max" 
                min="0" 
                placeholder="10" 
                value="{{ request('edad_max') }}"
                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors text-gray-900 pr-16"
              />
              <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-sm text-gray-500">años</span>
            </div>
          </div>

          <!-- Botón de Búsqueda -->
          <div class="flex items-end">
            <button 
              type="submit" 
              class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center group"
            >
              <i class="fas fa-search mr-2 group-hover:scale-110 transition-transform"></i>
              Buscar Mascotas
            </button>
          </div>
        </div>

        <!-- Filtros rápidos -->
        <div class="border-t border-gray-200 pt-6">
          <div class="flex flex-wrap gap-3 justify-center">
            <a href="{{ route('publico.buscar') }}?tipo=perro" class="inline-flex items-center px-4 py-2 bg-white hover:bg-emerald-50 text-gray-700 hover:text-emerald-700 rounded-lg border border-gray-200 hover:border-emerald-200 transition-colors text-sm font-medium">
              🐕 Ver todos los perros
            </a>
            <a href="{{ route('publico.buscar') }}?tipo=gato" class="inline-flex items-center px-4 py-2 bg-white hover:bg-emerald-50 text-gray-700 hover:text-emerald-700 rounded-lg border border-gray-200 hover:border-emerald-200 transition-colors text-sm font-medium">
              🐱 Ver todos los gatos
            </a>
            <a href="{{ route('publico.buscar') }}?edad_max=1" class="inline-flex items-center px-4 py-2 bg-white hover:bg-emerald-50 text-gray-700 hover:text-emerald-700 rounded-lg border border-gray-200 hover:border-emerald-200 transition-colors text-sm font-medium">
              🍼 Cachorros y gatitos
            </a>
            <a href="{{ route('publico.buscar') }}" class="inline-flex items-center px-4 py-2 bg-white hover:bg-emerald-50 text-gray-700 hover:text-emerald-700 rounded-lg border border-gray-200 hover:border-emerald-200 transition-colors text-sm font-medium">
              ✨ Ver todas las mascotas
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Animales Destacados -->
<section class="py-16 lg:py-24 px-6 lg:px-12 bg-gray-50">
  <div class="max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="text-center mb-16">
      <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
        Conoce a nuestros
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-green-600">
          amigos
        </span>
      </h2>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto">
        Cada uno de estos increíbles compañeros está esperando encontrar su hogar perfecto
      </p>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @forelse($animales as $animal)
      <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-emerald-200 transform hover:-translate-y-2">
        <!-- Image Container -->
        <div class="relative overflow-hidden">
          <div class="aspect-w-4 aspect-h-3">
            <img 
              src="{{ $animal->imagen_url }}"
              alt="{{ $animal->nombre }}"
              class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-110"
              onerror="this.onerror=null; this.src='{{ asset('img/animal-default.svg') }}'"
              loading="lazy"
            />
          </div>
          <!-- Status Badge -->
          <div class="absolute top-4 left-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
              <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
              Disponible
            </span>
          </div>
          <!-- Heart Icon -->
          <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <div class="w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white transition-colors cursor-pointer">
              <i class="fas fa-heart text-emerald-600 hover:text-red-500 transition-colors"></i>
            </div>
          </div>
        </div>

        <!-- Content -->
        <div class="p-6">
          <!-- Name and Type -->
          <div class="mb-4">
            <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors">
              {{ $animal->nombre }}
            </h3>
            <div class="flex items-center gap-2 flex-wrap">
              <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                <i class="fas fa-{{ $animal->tipo === 'perro' ? 'dog' : ($animal->tipo === 'gato' ? 'cat' : 'paw') }} mr-1"></i>
                {{ ucfirst($animal->tipo) }}
              </span>
              <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                <i class="fas fa-birthday-cake mr-1"></i>
                {{ $animal->edad }} {{ $animal->tipo_edad === 'anios' ? 'años' : 'meses' }}
              </span>
              <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-purple-50 text-purple-700 border border-purple-200">
                <i class="fas fa-{{ $animal->sexo === 'macho' ? 'mars' : 'venus' }} mr-1"></i>
                {{ ucfirst($animal->sexo) }}
              </span>
            </div>
          </div>

          <!-- Description -->
          <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
            {{ $animal->descripcion ?? 'Este adorable compañero está buscando un hogar lleno de amor donde pueda ser feliz.' }}
          </p>

          <!-- Additional Info -->
          @if($animal->tamanio || $animal->personalidad)
          <div class="mb-6 space-y-2">
            @if($animal->tamanio)
            <div class="flex items-center text-sm text-gray-600">
              <i class="fas fa-ruler-combined w-4 text-emerald-500 mr-2"></i>
              <span class="font-medium">Tamaño:</span>
              <span class="ml-1">{{ ucfirst($animal->tamanio) }}</span>
            </div>
            @endif
            @if($animal->personalidad)
            <div class="flex items-center text-sm text-gray-600">
              <i class="fas fa-smile w-4 text-emerald-500 mr-2"></i>
              <span class="font-medium">Personalidad:</span>
              <span class="ml-1">{{ $animal->personalidad }}</span>
            </div>
            @endif
          </div>
          @endif

          <!-- Action Buttons -->
          <div class="flex gap-3">
            @auth
            <form action="{{ route('adopcion.store') }}" method="POST" class="flex-1">
              @csrf
              <input name="animal_id" type="hidden" value="{{ $animal->id }}"/>
              <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                <i class="fas fa-heart mr-2"></i>
                Adoptar
              </button>
            </form>
            @else
            <a href="{{ route('publico.animal', $animal->id) }}" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
              <i class="fas fa-eye mr-2"></i>
              Ver Detalles
            </a>
            @endauth
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-700 font-semibold py-3 px-4 rounded-xl transition-all duration-300 border border-gray-200">
              <i class="fas fa-share-alt"></i>
            </button>
          </div>
        </div>
      </div>
      @empty
      <div class="col-span-full">
        <div class="text-center py-16 bg-white rounded-2xl shadow-lg">
          <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-paw text-3xl text-gray-400"></i>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">
            No hay mascotas disponibles
          </h3>
          <p class="text-gray-600 mb-6">
            En este momento no tenemos animales disponibles para adopción.
          </p>
          <a href="{{ route('publico.buscar') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition-colors">
            <i class="fas fa-search mr-2"></i>
            Explorar más opciones
          </a>
        </div>
      </div>
      @endforelse
    </div>

    <!-- Pagination -->
    @if($animales->hasPages())
    <div class="mt-16 flex justify-center">
      <div class="bg-white rounded-xl shadow-lg p-4">
        {{ $animales->links() }}
      </div>
    </div>
    @endif
  </div>
</section>

<!-- Sección de Donaciones Moderna -->
<section class="py-20 px-6 lg:px-12 bg-gradient-to-br from-emerald-50 via-white to-green-50 relative overflow-hidden">
  <!-- Elementos decorativos -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute top-20 right-20 w-32 h-32 bg-emerald-200 rounded-full mix-blend-multiply filter blur-xl opacity-30"></div>
    <div class="absolute bottom-20 left-20 w-40 h-40 bg-green-200 rounded-full mix-blend-multiply filter blur-xl opacity-30"></div>
  </div>

  <div class="relative max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <!-- Contenido Principal -->
      <div class="text-center lg:text-left">
        <div class="inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium mb-6">
          <i class="fas fa-heart mr-2 text-emerald-500"></i>
          Haz la diferencia hoy
        </div>
        
        <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
          Ayuda a nuestros
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-green-600">
            amigos peludos
          </span>
        </h2>
        
        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
          Tu generosidad es fundamental para mantener nuestras fundaciones funcionando. Cada donación hace posible que más animales encuentren un hogar lleno de amor.
        </p>
        
        <!-- Estadísticas de impacto -->
        <div class="grid grid-cols-3 gap-6 mb-10">
          <div class="text-center">
            <div class="text-3xl font-bold text-emerald-600 mb-1">1,200+</div>
            <div class="text-sm text-gray-500">Animales rescatados</div>
          </div>
          <div class="text-center">
            <div class="text-3xl font-bold text-emerald-600 mb-1">95%</div>
            <div class="text-sm text-gray-500">Tasa de adopción</div>
          </div>
          <div class="text-center">
            <div class="text-3xl font-bold text-emerald-600 mb-1">24/7</div>
            <div class="text-sm text-gray-500">Cuidado médico</div>
          </div>
        </div>
        
        <!-- Botones de acción -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
          <a href="{{ route('publico.donaciones') }}" class="group inline-flex items-center justify-center px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <i class="fas fa-donate mr-2 group-hover:scale-110 transition-transform"></i>
            Hacer Donación
          </a>
          <a href="{{ route('publico.informacion') }}" class="group inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200">
            <i class="fas fa-info-circle mr-2 text-emerald-600 group-hover:scale-110 transition-transform"></i>
            Más Información
          </a>
        </div>
      </div>
      
      <!-- Imagen/Ilustración -->
      <div class="relative">
        <div class="bg-white rounded-2xl shadow-2xl p-8 transform rotate-3 hover:rotate-0 transition-transform duration-500">
          <div class="grid grid-cols-2 gap-4">
            <!-- Iconos de impacto -->
            <div class="bg-emerald-50 rounded-xl p-6 text-center hover:bg-emerald-100 transition-colors">
              <div class="w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-home text-white text-xl"></i>
              </div>
              <h4 class="font-semibold text-gray-900 mb-1">Refugio Seguro</h4>
              <p class="text-sm text-gray-600">Hogar temporal para animales</p>
            </div>
            
            <div class="bg-blue-50 rounded-xl p-6 text-center hover:bg-blue-100 transition-colors">
              <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-user-md text-white text-xl"></i>
              </div>
              <h4 class="font-semibold text-gray-900 mb-1">Atención Médica</h4>
              <p class="text-sm text-gray-600">Cuidado veterinario completo</p>
            </div>
            
            <div class="bg-purple-50 rounded-xl p-6 text-center hover:bg-purple-100 transition-colors">
              <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-utensils text-white text-xl"></i>
              </div>
              <h4 class="font-semibold text-gray-900 mb-1">Alimentación</h4>
              <p class="text-sm text-gray-600">Nutrición balanceada diaria</p>
            </div>
            
            <div class="bg-green-50 rounded-xl p-6 text-center hover:bg-green-100 transition-colors">
              <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-heart text-white text-xl"></i>
              </div>
              <h4 class="font-semibold text-gray-900 mb-1">Amor y Cuidado</h4>
              <p class="text-sm text-gray-600">Atención personalizada</p>
            </div>
          </div>
        </div>
        
        <!-- Elemento decorativo -->
        <div class="absolute -z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-gradient-to-r from-emerald-200 to-green-200 rounded-full opacity-20 blur-3xl"></div>
      </div>
    </div>
  </div>
</section>

@endsection
