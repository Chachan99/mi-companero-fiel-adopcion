@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400/20 to-purple-400/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-green-400/20 to-blue-400/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Modern Hero Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full text-sm font-medium text-blue-800 mb-4">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Panel de Administración
            </div>
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800 bg-clip-text text-transparent mb-4">
                Mis Animales
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-8">
                Administra y cuida a todos los animales de tu fundación desde un solo lugar
            </p>
            <a href="{{ route('fundacion.animales.crear') }}" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Agregar Nuevo Animal
            </a>
        </div>

        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">

            <!-- Modern Filter Section -->
            <div class="p-8 border-b border-gray-100">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Filtrar Animales</h2>
                    
                    <form method="GET" class="mb-6">
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6">
                            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path>
                                    </svg>
                                    <label for="estado" class="font-semibold text-gray-700">Estado:</label>
                                </div>
                                <select name="estado" id="estado" onchange="this.form.submit()" 
                                        class="bg-white border-2 border-blue-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-4 focus:ring-blue-200 focus:border-blue-400 transition-all duration-300 min-w-[200px]">
                                    <option value="">🔍 Todos los estados</option>
                                    <option value="disponible" {{ request('estado') == 'disponible' ? 'selected' : '' }}>🟢 Disponible</option>
                                    <option value="adoptado" {{ request('estado') == 'adoptado' ? 'selected' : '' }}>❤️ Adoptado</option>
                                    <option value="en_adopcion" {{ request('estado') == 'en_adopcion' ? 'selected' : '' }}>⏳ En proceso</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl p-4 mb-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Animals Listing Section -->
            @if($animales->isEmpty())
                <div class="p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">¡Comienza tu misión!</h3>
                        <p class="text-gray-600 mb-8">No hay animales registrados aún. Agrega tu primer animal y comienza a cambiar vidas.</p>
                        <a href="{{ route('fundacion.animales.crear') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Agregar Primer Animal
                        </a>
                    </div>
                </div>
            @else
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Tus Animales</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($animales as $animal)
                    <div class="group bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden border border-white/20 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                        <!-- Imagen del animal -->
                        <div class="relative h-56 w-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                            <img src="{{ $animal->imagen_url }}" 
                                 alt="{{ $animal->nombre }}"
                                 class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110"
                                 onerror="this.onerror=null; this.src='{{ asset('img/animal-default.svg') }}'"
                                 loading="lazy" />
                            
                            <!-- Status Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="{{ 
                                    $animal->estado === 'adoptado' ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white' : 
                                    ($animal->estado === 'disponible' ? 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white' : 'bg-gradient-to-r from-yellow-500 to-orange-500 text-white')
                                }} text-xs font-bold px-3 py-1.5 rounded-full shadow-lg backdrop-blur-sm">
                                    {{ $animal->estado === 'adoptado' ? '❤️ Adoptado' : ($animal->estado === 'disponible' ? '🟢 Disponible' : '⏳ En proceso') }}
                                </span>
                            </div>
                            
                            <!-- Heart Icon -->
                            <div class="absolute top-3 left-3">
                                <div class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Información del animal -->
                        <div class="p-6">
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3">{{ $animal->nombre }}</h3>
                            
                            <div class="flex items-center text-gray-600 mb-2">
                                <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="font-medium">{{ $animal->edad }} {{ $animal->tipo_edad === 'anios' ? 'años' : 'meses' }}</span>
                            </div>
                            
                            <div class="flex items-center text-gray-600 mb-6">
                                 <div class="w-5 h-5 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                         <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm7 1a1 1 0 10-2 0v3H5a1 1 0 100 2h3v3a1 1 0 102 0v-3h3a1 1 0 100-2h-3V6z" clip-rule="evenodd" />
                                     </svg>
                                 </div>
                                 <span class="capitalize font-medium">{{ $animal->tipo }}</span>
                             </div>

                             <!-- Modern Action Buttons -->
                             <div class="space-y-3">
                                 <a href="/panel-fundacion/animales/{{ $animal->id }}/editar" 
                                    class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-3 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 flex items-center justify-center gap-2 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                         <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                     </svg>
                                     Editar Animal
                                 </a>
                                 
                                 <div class="flex gap-3">
                                     @if($animal->estado === 'disponible')
                                     <form action="{{ route('fundacion.animales.adoptado', $animal->id) }}" method="POST" class="flex-1">
                                         @csrf
                                         @method('PATCH')
                                         <button type="submit" 
                                                 class="w-full bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2.5 rounded-xl hover:from-green-600 hover:to-emerald-600 transition-all duration-300 flex items-center justify-center gap-2 font-semibold shadow-md hover:shadow-lg transform hover:scale-105"
                                                 onclick="return confirm('¿Marcar este animal como adoptado?')">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                 <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                             </svg>
                                             Adoptado
                                         </button>
                                     </form>
                                     @endif
                                     
                                     <form action="{{ route('fundacion.animales.eliminar', $animal->id) }}" method="POST" class="flex-1">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" 
                                                 class="w-full bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2.5 rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-300 flex items-center justify-center gap-2 font-semibold shadow-md hover:shadow-lg transform hover:scale-105"
                                                 onclick="return confirm('¿Estás seguro de eliminar este animal? Esta acción no se puede deshacer.')">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                 <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
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

                <!-- Modern Pagination -->
                <div class="mt-12 flex justify-center">
                    <div class="bg-white/50 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-white/20">
                        {{ $animales->links() }}
                    </div>
                </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Custom animations for blob effects */
@keyframes blob {
    0% {
        transform: translate(0px, 0px) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
    100% {
        transform: translate(0px, 0px) scale(1);
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animate-blob:nth-child(2) {
    animation-delay: 2s;
}

.animate-blob:nth-child(3) {
    animation-delay: 4s;
}
</style>

@endsection
