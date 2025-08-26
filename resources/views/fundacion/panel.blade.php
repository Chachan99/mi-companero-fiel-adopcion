@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-emerald-500 via-green-500 to-teal-600 overflow-hidden min-h-[60vh] flex items-center">
  <!-- Decorative Background -->
  <div class="absolute inset-0">
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    <div class="absolute top-1/3 left-1/4 w-48 h-48 bg-white/5 rounded-full blur-2xl animate-pulse" style="animation-delay: 2s;"></div>
    <div class="absolute bottom-1/4 right-1/3 w-32 h-32 bg-white/8 rounded-full blur-xl animate-pulse" style="animation-delay: 0.5s;"></div>
  </div>

  <!-- Pattern Overlay -->
  <div class="absolute inset-0 opacity-10">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
  </div>

  <div class="relative px-6 lg:px-12 py-20 lg:py-28 w-full">
    <div class="max-w-7xl mx-auto">
      <!-- Welcome Header -->
      <div class="text-center mb-16">
        <div class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl border border-white/30">
          <i class="fas fa-paw text-4xl text-white drop-shadow-lg"></i>
        </div>
        <h1 class="text-5xl lg:text-7xl font-extrabold text-white mb-6 tracking-tight">
          Panel de
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-green-200 drop-shadow-sm">
            Fundación
          </span>
        </h1>
        <p class="text-xl lg:text-2xl text-emerald-50/90 max-w-4xl mx-auto leading-relaxed font-light">
          ¡Bienvenido de vuelta! Gestiona tus animales, solicitudes y noticias desde tu centro de control personalizado.
        </p>
        <div class="mt-8 flex justify-center">
          <div class="w-24 h-1 bg-gradient-to-r from-transparent via-white/50 to-transparent rounded-full"></div>
        </div>
      </div>

      <!-- Quick Stats -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
        <div class="group bg-white/15 backdrop-blur-md rounded-3xl p-8 border border-white/30 hover:bg-white/20 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-emerald-100 text-sm font-semibold uppercase tracking-wider mb-2">Animales Activos</p>
              <p class="text-4xl font-black text-white drop-shadow-lg">{{ Auth::user()->fundacion->animales->where('estado', 'disponible')->count() ?? 0 }}</p>
            </div>
            <div class="w-16 h-16 bg-emerald-400/30 backdrop-blur-sm rounded-2xl flex items-center justify-center group-hover:bg-emerald-400/40 transition-all duration-300 shadow-lg">
              <i class="fas fa-paw text-emerald-100 text-2xl drop-shadow-md"></i>
            </div>
          </div>
        </div>
        
        <div class="group bg-white/15 backdrop-blur-md rounded-3xl p-8 border border-white/30 hover:bg-white/20 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-blue-100 text-sm font-semibold uppercase tracking-wider mb-2">Solicitudes Pendientes</p>
              <p class="text-4xl font-black text-white drop-shadow-lg">{{ Auth::user()->fundacion->solicitudesAdopcion->where('estado', 'pendiente')->count() ?? 0 }}</p>
            </div>
            <div class="w-16 h-16 bg-blue-400/30 backdrop-blur-sm rounded-2xl flex items-center justify-center group-hover:bg-blue-400/40 transition-all duration-300 shadow-lg">
              <i class="fas fa-clipboard-list text-blue-100 text-2xl drop-shadow-md"></i>
            </div>
          </div>
        </div>
        
        <div class="group bg-white/15 backdrop-blur-md rounded-3xl p-8 border border-white/30 hover:bg-white/20 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-green-100 text-sm font-semibold uppercase tracking-wider mb-2">Adopciones Exitosas</p>
              <p class="text-4xl font-black text-white drop-shadow-lg">{{ Auth::user()->fundacion->solicitudesAdopcion->where('estado', 'aprobada')->count() ?? 0 }}</p>
            </div>
            <div class="w-16 h-16 bg-green-400/30 backdrop-blur-sm rounded-2xl flex items-center justify-center group-hover:bg-green-400/40 transition-all duration-300 shadow-lg">
              <i class="fas fa-heart text-green-100 text-2xl drop-shadow-md"></i>
            </div>
          </div>
        </div>
        
        <div class="group bg-white/15 backdrop-blur-md rounded-3xl p-8 border border-white/30 hover:bg-white/20 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-purple-100 text-sm font-semibold uppercase tracking-wider mb-2">Noticias Publicadas</p>
              <p class="text-4xl font-black text-white drop-shadow-lg">{{ Auth::user()->fundacion->noticias->count() ?? 0 }}</p>
            </div>
            <div class="w-16 h-16 bg-purple-400/30 backdrop-blur-sm rounded-2xl flex items-center justify-center group-hover:bg-purple-400/40 transition-all duration-300 shadow-lg">
              <i class="fas fa-newspaper text-purple-100 text-2xl drop-shadow-md"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Main Dashboard -->
<section class="py-20 lg:py-28 px-6 lg:px-12 bg-gradient-to-br from-gray-50 via-white to-emerald-50/30">
  <div class="max-w-7xl mx-auto">
    <!-- Navigation Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
      <!-- Animales Card -->
      <a href="{{ route('fundacion.animales') }}" class="group relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-700 overflow-hidden border border-gray-200/50 hover:border-emerald-300/50 transform hover:-translate-y-3 hover:rotate-1">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 via-transparent to-green-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        
        <div class="relative p-10">
          <div class="w-20 h-20 bg-gradient-to-br from-emerald-100 via-emerald-200 to-green-200 rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
            <i class="fas fa-paw text-3xl text-emerald-600 drop-shadow-sm"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-900 mb-5 group-hover:text-emerald-600 transition-colors duration-300">
            Mis Animales
          </h3>
          <p class="text-gray-600 mb-8 leading-relaxed text-lg">
            Gestiona el perfil, fotos y estado de todos tus animales en adopción.
          </p>
          <div class="flex items-center text-emerald-600 font-bold group-hover:text-emerald-700 text-lg">
            <span>Gestionar animales</span>
            <i class="fas fa-arrow-right ml-3 transform group-hover:translate-x-2 transition-transform duration-300"></i>
          </div>
        </div>
      </a>

      <!-- Solicitudes Card -->
      <a href="{{ route('fundacion.solicitudes') }}" class="group relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-700 overflow-hidden border border-gray-200/50 hover:border-blue-300/50 transform hover:-translate-y-3 hover:-rotate-1">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 via-transparent to-indigo-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        
        <div class="relative p-10">
          <div class="w-20 h-20 bg-gradient-to-br from-blue-100 via-blue-200 to-indigo-200 rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:-rotate-6 transition-all duration-500 shadow-lg">
            <i class="fas fa-clipboard-list text-3xl text-blue-600 drop-shadow-sm"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-900 mb-5 group-hover:text-blue-600 transition-colors duration-300">
            Solicitudes
          </h3>
          <p class="text-gray-600 mb-8 leading-relaxed text-lg">
            Revisa y gestiona las solicitudes de adopción de tus animales.
          </p>
          <div class="flex items-center text-blue-600 font-bold group-hover:text-blue-700 text-lg">
            <span>Ver solicitudes</span>
            <i class="fas fa-arrow-right ml-3 transform group-hover:translate-x-2 transition-transform duration-300"></i>
          </div>
        </div>
      </a>

      <!-- Noticias Card -->
      <a href="{{ route('fundacion.noticias.index') }}" class="group relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-700 overflow-hidden border border-gray-200/50 hover:border-purple-300/50 transform hover:-translate-y-3 hover:rotate-1">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 via-transparent to-pink-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        
        <div class="relative p-10">
          <div class="w-20 h-20 bg-gradient-to-br from-purple-100 via-purple-200 to-pink-200 rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
            <i class="fas fa-newspaper text-3xl text-purple-600 drop-shadow-sm"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-900 mb-5 group-hover:text-purple-600 transition-colors duration-300">
            Noticias
          </h3>
          <p class="text-gray-600 mb-8 leading-relaxed text-lg">
            Comparte historias de éxito y noticias importantes de tu fundación.
          </p>
          <div class="flex items-center text-purple-600 font-bold group-hover:text-purple-700 text-lg">
            <span>Gestionar noticias</span>
            <i class="fas fa-arrow-right ml-3 transform group-hover:translate-x-2 transition-transform duration-300"></i>
          </div>
        </div>
      </a>
    </div>

    <!-- Quick Actions -->
    <div class="relative bg-gradient-to-br from-white via-gray-50 to-white rounded-3xl shadow-2xl p-10 border border-gray-200/50 overflow-hidden">
      <!-- Background Pattern -->
      <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-32 h-32 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full -translate-x-16 -translate-y-16"></div>
        <div class="absolute bottom-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full translate-x-12 translate-y-12"></div>
      </div>
      
      <div class="relative">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
          <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
            <i class="fas fa-bolt text-white text-xl"></i>
          </div>
          Acciones Rápidas
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <a href="{{ route('fundacion.animales.crear') }}" class="group relative bg-gradient-to-br from-green-500 via-green-600 to-emerald-600 text-white p-6 rounded-2xl hover:from-green-600 hover:via-green-700 hover:to-emerald-700 transition-all duration-500 text-center transform hover:-translate-y-2 hover:rotate-1 shadow-xl hover:shadow-2xl">
            <div class="absolute inset-0 bg-white/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative">
              <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                <i class="fas fa-plus-circle text-3xl"></i>
              </div>
              <div class="font-bold text-lg">Agregar Animal</div>
            </div>
          </a>
          
          <a href="{{ route('fundacion.noticias.create') }}" class="group relative bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 text-white p-6 rounded-2xl hover:from-blue-600 hover:via-blue-700 hover:to-indigo-700 transition-all duration-500 text-center transform hover:-translate-y-2 hover:rotate-1 shadow-xl hover:shadow-2xl">
            <div class="absolute inset-0 bg-white/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative">
              <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                <i class="fas fa-newspaper text-3xl"></i>
              </div>
              <div class="font-bold text-lg">Nueva Noticia</div>
            </div>
          </a>
          
          <a href="{{ route('fundacion.perfil') }}" class="group relative bg-gradient-to-br from-purple-500 via-purple-600 to-pink-600 text-white p-6 rounded-2xl hover:from-purple-600 hover:via-purple-700 hover:to-pink-700 transition-all duration-500 text-center transform hover:-translate-y-2 hover:rotate-1 shadow-xl hover:shadow-2xl">
            <div class="absolute inset-0 bg-white/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative">
              <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                <i class="fas fa-user-edit text-3xl"></i>
              </div>
              <div class="font-bold text-lg">Editar Perfil</div>
            </div>
          </a>
          
          <a href="{{ route('publico.fundacion', Auth::user()->fundacion->id) }}" class="group relative bg-gradient-to-br from-orange-500 via-orange-600 to-red-600 text-white p-6 rounded-2xl hover:from-orange-600 hover:via-orange-700 hover:to-red-700 transition-all duration-500 text-center transform hover:-translate-y-2 hover:rotate-1 shadow-xl hover:shadow-2xl">
            <div class="absolute inset-0 bg-white/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative">
              <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                <i class="fas fa-eye text-3xl"></i>
              </div>
              <div class="font-bold text-lg">Ver Perfil Público</div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
