@extends('layouts.app')

@section('content')
<!-- Hero Section Moderno -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-emerald-50 via-white to-green-50">
  <!-- Elementos decorativos de fondo -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-emerald-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-green-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
    <div class="absolute top-40 left-40 w-80 h-80 bg-teal-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
  </div>

  <div class="relative max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 py-20 text-center">
    <!-- Badge -->
    <div class="inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium mb-6">
      <i class="fas fa-paw mr-2 text-emerald-500"></i>
      Encuentra tu compañero perfecto
    </div>
    
    <!-- Título Principal -->
    <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
      Nuestros Amigos en
      <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-green-600">
        Adopción
      </span>
    </h1>
    
    <!-- Subtítulo -->
    <p class="text-xl text-gray-600 mb-8 leading-relaxed max-w-3xl mx-auto">
      Conoce a estos maravillosos animales que están buscando un hogar lleno de amor. Cada uno tiene una historia única y está listo para convertirse en tu nuevo mejor amigo.
    </p>
    
    <!-- Botones de Acción -->
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="{{ route('publico.index') }}" class="group inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200">
        <i class="fas fa-home mr-2 text-emerald-600 group-hover:scale-110 transition-transform"></i>
        Volver al Inicio
      </a>
      <a href="{{ route('publico.informacion') }}" class="group inline-flex items-center justify-center px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <i class="fas fa-info-circle mr-2 group-hover:scale-110 transition-transform"></i>
        Guía para Adoptantes
      </a>
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

<!-- Sección de Filtros Moderna -->
<section class="py-16 px-6 lg:px-12 bg-white">
  <div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-12">
      <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
        Encuentra tu
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-green-600">
          compañero ideal
        </span>
      </h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Utiliza nuestros filtros para encontrar exactamente lo que buscas
      </p>
    </div>

    <!-- Formulario de Filtros -->
    <div class="bg-gray-50 rounded-2xl p-8 shadow-lg border border-gray-100">
      <form action="{{ route('publico.animales') }}" method="GET" class="space-y-6">
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

          <!-- Tamaño -->
          <div class="space-y-2">
            <label for="tamano" class="block text-sm font-semibold text-gray-700">
              <i class="fas fa-ruler-combined mr-2 text-emerald-600"></i>
              Tamaño
            </label>
            <select id="tamano" name="tamano" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors text-gray-900">
              <option value="" {{ request('tamano') == '' ? 'selected' : '' }}>Cualquier tamaño</option>
              <option value="pequeño" {{ request('tamano') == 'pequeño' ? 'selected' : '' }}>Pequeño</option>
              <option value="mediano" {{ request('tamano') == 'mediano' ? 'selected' : '' }}>Mediano</option>
              <option value="grande" {{ request('tamano') == 'grande' ? 'selected' : '' }}>Grande</option>
            </select>
          </div>

          <!-- Edad -->
          <div class="space-y-2">
            <label for="edad" class="block text-sm font-semibold text-gray-700">
              <i class="fas fa-birthday-cake mr-2 text-emerald-600"></i>
              Edad
            </label>
            <select id="edad" name="edad" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors text-gray-900">
              <option value="" {{ request('edad') == '' ? 'selected' : '' }}>Cualquier edad</option>
              <option value="cachorro" {{ request('edad') == 'cachorro' ? 'selected' : '' }}>Cachorro</option>
              <option value="joven" {{ request('edad') == 'joven' ? 'selected' : '' }}>Joven</option>
              <option value="adulto" {{ request('edad') == 'adulto' ? 'selected' : '' }}>Adulto</option>
              <option value="mayor" {{ request('edad') == 'mayor' ? 'selected' : '' }}>Mayor</option>
            </select>
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
            <a href="{{ route('publico.animales') }}?tipo=perro" class="inline-flex items-center px-4 py-2 bg-white hover:bg-emerald-50 text-gray-700 hover:text-emerald-700 rounded-lg border border-gray-200 hover:border-emerald-200 transition-colors text-sm font-medium">
              🐕 Ver todos los perros
            </a>
            <a href="{{ route('publico.animales') }}?tipo=gato" class="inline-flex items-center px-4 py-2 bg-white hover:bg-emerald-50 text-gray-700 hover:text-emerald-700 rounded-lg border border-gray-200 hover:border-emerald-200 transition-colors text-sm font-medium">
              🐱 Ver todos los gatos
            </a>
            <a href="{{ route('publico.animales') }}?edad=cachorro" class="inline-flex items-center px-4 py-2 bg-white hover:bg-emerald-50 text-gray-700 hover:text-emerald-700 rounded-lg border border-gray-200 hover:border-emerald-200 transition-colors text-sm font-medium">
              🍼 Cachorros y gatitos
            </a>
            <a href="{{ route('publico.animales') }}" class="inline-flex items-center px-4 py-2 bg-white hover:bg-emerald-50 text-gray-700 hover:text-emerald-700 rounded-lg border border-gray-200 hover:border-emerald-200 transition-colors text-sm font-medium">
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
    @if($animales->count() > 0)
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
        @foreach($animales as $animal)
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
                {{ ucfirst($animal->estado ?? 'Disponible') }}
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
                @if($animal->edad)
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                  <i class="fas fa-birthday-cake mr-1"></i>
                  {{ $animal->edad }} {{ $animal->tipo_edad === 'anios' ? 'años' : 'meses' }}
                </span>
                @endif
                @if($animal->sexo)
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-purple-50 text-purple-700 border border-purple-200">
                  <i class="fas fa-{{ $animal->sexo === 'macho' ? 'mars' : 'venus' }} mr-1"></i>
                  {{ ucfirst($animal->sexo) }}
                </span>
                @endif
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
        @endforeach
      </div>
              
              <div class="flex items-center text-gray-600 text-sm mb-4">
                <i class="fas fa-{{ $animal->sexo === 'macho' ? 'mars' : 'venus' }} mr-2"></i>
                <span class="mr-4">{{ ucfirst($animal->sexo) }}</span>
                <i class="fas fa-birthday-cake mr-2"></i>
                <span>{{ $animal->edad }} años</span>
              </div>
              
              <p class="text-gray-700 mb-6 line-clamp-2">
                {{ $animal->descripcion }}
              </p>
              
              <div class="flex items-center justify-between">
                <a href="{{ route('publico.animal', $animal->id) }}" class="text-cyan-600 hover:text-cyan-800 font-medium flex items-center">
                  Ver detalles
                  <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <span class="text-sm text-gray-500">
                  {{ $animal->created_at->diffForHumans() }}
                </span>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      
      <!-- Paginación -->
      <div class="mt-16 flex justify-center">
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
          {{ $animales->links('pagination::tailwind') }}
        </div>
      </div>
      
    @else
      <!-- Empty State -->
      <div class="text-center py-20">
        <div class="bg-white rounded-3xl shadow-xl p-12 max-w-md mx-auto border border-gray-100">
          <div class="w-24 h-24 bg-gradient-to-br from-emerald-100 to-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-paw text-4xl text-emerald-600"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-900 mb-4">¡Pronto habrá nuevos amigos!</h3>
          <p class="text-gray-600 mb-8 leading-relaxed">
            En este momento no hay animales disponibles con los filtros seleccionados, pero pronto tendremos nuevos compañeros buscando hogar.
          </p>
          <div class="space-y-3">
            <a href="{{ route('publico.animales') }}" class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
              <i class="fas fa-refresh mr-2"></i>
              Ver todos los animales
            </a>
            <a href="{{ route('publico.index') }}" class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-300 border border-gray-200">
              <i class="fas fa-home mr-2"></i>
              Volver al inicio
            </a>
          </div>
        </div>
      </div>
    @endif
  </div>
</section>

<!-- CTA Section -->
<section class="relative py-20 lg:py-28 overflow-hidden">
  <!-- Background with gradient -->
  <div class="absolute inset-0 bg-gradient-to-br from-emerald-600 via-green-600 to-teal-700"></div>
  
  <!-- Decorative elements -->
  <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
  </div>

  <div class="relative max-w-4xl mx-auto text-center px-6 lg:px-12">
    <!-- Icon -->
    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-8">
      <i class="fas fa-bell text-3xl text-white"></i>
    </div>
    
    <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
      ¿No encuentras a tu
      <span class="text-emerald-200">compañero ideal</span>?
    </h2>
    
    <p class="text-xl lg:text-2xl text-emerald-100 mb-10 max-w-2xl mx-auto leading-relaxed">
      Regístrate para recibir notificaciones cuando lleguen nuevos animales que coincidan con tus preferencias.
    </p>
    
    @guest
    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
      <a href="{{ route('register') }}" class="bg-white text-emerald-600 hover:bg-emerald-50 font-bold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl">
        <i class="fas fa-user-plus mr-2"></i>
        Regístrate Ahora
      </a>
      <a href="{{ route('login') }}" class="bg-emerald-500/20 backdrop-blur-sm text-white hover:bg-emerald-500/30 font-semibold py-4 px-8 rounded-2xl transition-all duration-300 border border-white/20">
        <i class="fas fa-sign-in-alt mr-2"></i>
        Ya tengo cuenta
      </a>
    </div>
    @else
    <div class="bg-emerald-500/20 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
      <i class="fas fa-check-circle text-4xl text-emerald-200 mb-4"></i>
      <p class="text-emerald-100 text-lg">
        ¡Gracias por estar registrado! Te notificaremos cuando lleguen nuevos amigos perfectos para ti.
      </p>
    </div>
    @endguest
  </div>
</section>

<!-- Why Adopt Section -->
<section class="py-20 lg:py-28 px-6 lg:px-12 bg-gradient-to-br from-gray-50 to-emerald-50">
  <div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-16">
      <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
        <i class="fas fa-question text-2xl text-white"></i>
      </div>
      <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
        ¿Por qué
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-green-600">
          adoptar
        </span>?
      </h2>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto">
        Adoptar no solo cambia la vida de un animal, también transforma la tuya de maneras increíbles
      </p>
    </div>

    <!-- Benefits Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
      <!-- Benefit 1 -->
      <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-emerald-200 transform hover:-translate-y-2">
        <div class="w-16 h-16 bg-gradient-to-br from-red-100 to-pink-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <i class="fas fa-heart text-2xl text-red-500"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-emerald-600 transition-colors">
          Salvas una vida
        </h3>
        <p class="text-gray-600 leading-relaxed">
          Al adoptar, le das una segunda oportunidad a un animal que necesita un hogar amoroso y una familia que lo cuide.
        </p>
      </div>

      <!-- Benefit 2 -->
      <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-emerald-200 transform hover:-translate-y-2">
        <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <i class="fas fa-home text-2xl text-blue-500"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-emerald-600 transition-colors">
          Ayudas a otros animales
        </h3>
        <p class="text-gray-600 leading-relaxed">
          Al adoptar, liberas espacio en refugios para que puedan rescatar y cuidar a más animales necesitados.
        </p>
      </div>

      <!-- Benefit 3 -->
      <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-emerald-200 transform hover:-translate-y-2">
        <div class="w-16 h-16 bg-gradient-to-br from-yellow-100 to-orange-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <i class="fas fa-smile text-2xl text-yellow-500"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-emerald-600 transition-colors">
          Mejoras tu vida
        </h3>
        <p class="text-gray-600 leading-relaxed">
          Las mascotas reducen el estrés, la ansiedad y la depresión, y te brindan compañía incondicional todos los días.
        </p>
      </div>

      <!-- Benefit 4 -->
      <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-emerald-200 transform hover:-translate-y-2">
        <div class="w-16 h-16 bg-gradient-to-br from-emerald-100 to-green-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <i class="fas fa-hand-holding-heart text-2xl text-emerald-500"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-emerald-600 transition-colors">
          Apoyas una causa justa
        </h3>
        <p class="text-gray-600 leading-relaxed">
          Tu adopción ayuda a combatir el abandono y maltrato animal, promoviendo un mundo más compasivo.
        </p>
      </div>
    </div>

    <!-- Call to Action -->
    <div class="text-center mt-16">
      <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 max-w-2xl mx-auto">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">
          ¿Listo para cambiar una vida?
        </h3>
        <p class="text-gray-600 mb-6">
          Explora todos nuestros animales disponibles y encuentra a tu compañero perfecto
        </p>
        <a href="#animales" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
          <i class="fas fa-paw mr-2"></i>
          Ver todos los animales
        </a>
      </div>
    </div>
  </div>
</section>
@endsection
