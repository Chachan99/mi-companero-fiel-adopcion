@extends('layouts.app')

@section('title', 'Mascotas Perdidas - Panel de Administración')

@section('content')
<!-- Elementos decorativos de fondo -->
<div class="fixed inset-0 overflow-hidden pointer-events-none">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-orange-400/20 to-red-600/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-yellow-400/20 to-orange-600/20 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-red-400/10 to-pink-600/10 rounded-full blur-3xl"></div>
</div>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-orange-50 to-red-100 relative">
    <div class="container mx-auto px-4 py-8">
        <!-- Header modernizado -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-100 to-red-100 rounded-full text-sm font-medium text-orange-800 mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Panel de Administración
            </div>
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-orange-600 via-red-600 to-pink-800 bg-clip-text text-transparent mb-4">
                Mascotas Perdidas
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Gestiona los reportes de mascotas perdidas y ayuda a reunir familias
            </p>
        </div>

        <!-- Filtros y búsqueda modernizados -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl p-6 mb-8 border border-white/20">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="search" placeholder="Buscar por nombre de mascota..." class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white/70 backdrop-blur-sm transition-all duration-300">
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="relative">
                        <select id="filter-status" class="appearance-none bg-white/70 backdrop-blur-sm border border-gray-200 rounded-2xl px-4 py-3 pr-8 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300">
                            <option value="">Todos los estados</option>
                            <option value="perdido">Perdido</option>
                            <option value="encontrado">Encontrado</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    <button id="apply-filters" class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-semibold px-6 py-3 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                        </svg>
                        Aplicar Filtros
                    </button>
                </div>
            </div>
        </div>

        <!-- Grid de mascotas perdidas modernizado -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl p-8 border border-white/20">
            <div class="grid gap-6" id="pets-container">
                @forelse($mascotas as $mascota)
                <div class="bg-gradient-to-r from-white to-gray-50 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border border-gray-100 group hover:-translate-y-1">
                    <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                        <!-- Imagen y datos básicos -->
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <img class="w-16 h-16 rounded-2xl object-cover shadow-md" src="{{ $mascota->imagen_url }}" alt="{{ $mascota->nombre }}">
                                <div class="absolute -top-2 -right-2">
                                    @if($mascota->estado === 'encontrado')
                                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">{{ $mascota->nombre }}</h3>
                                <p class="text-sm text-gray-600">{{ ucfirst($mascota->tipo) }} • {{ $mascota->raza ? ucfirst($mascota->raza) : 'Raza no especificada' }}</p>
                                <p class="text-xs text-gray-500 mt-1">Reportado: {{ $mascota->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        
                        <!-- Información del propietario -->
                        <div class="flex-1">
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4">
                                <h4 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Información de Contacto
                                </h4>
                                @if($mascota->usuario)
                                    <p class="text-sm text-gray-800 font-medium">{{ $mascota->usuario->nombre }}</p>
                                    <p class="text-sm text-gray-600">{{ $mascota->usuario->email }}</p>
                                @else
                                    <p class="text-sm text-gray-800 font-medium">{{ $mascota->nombre_contacto ?? 'No especificado' }}</p>
                                    @if($mascota->email_contacto)
                                        <p class="text-sm text-gray-600">{{ $mascota->email_contacto }}</p>
                                    @endif
                                    @if($mascota->telefono_contacto)
                                        <p class="text-sm text-gray-600">{{ $mascota->telefono_contacto }}</p>
                                    @endif
                                @endif
                            </div>
                        </div>
                        
                        <!-- Estado y acciones -->
                        <div class="flex flex-col items-center gap-4">
                            <!-- Estado -->
                            @if($mascota->estado === 'encontrado')
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800 border border-green-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Encontrado
                                </span>
                            @else
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    Perdido
                                </span>
                            @endif
                            
                            <!-- Recompensa -->
                            @if($mascota->recompensa)
                                <div class="bg-gradient-to-r from-yellow-100 to-orange-100 px-3 py-2 rounded-xl">
                                    <p class="text-xs font-semibold text-yellow-800 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        Recompensa: {{ $mascota->recompensa }}
                                    </p>
                                </div>
                            @endif
                            
                            <!-- Acciones -->
                            <div class="flex flex-col gap-2">
                                <a href="{{ route('animales-perdidos.show', $mascota->id) }}" class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold px-4 py-2 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg text-center">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Ver Detalles
                                </a>
                                @if($mascota->estado === 'perdido')
                                    <form action="{{ route('animales-perdidos.marcar-encontrado', $mascota->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-semibold px-4 py-2 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg" onclick="return confirm('¿Marcar esta mascota como encontrada?')">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Marcar Encontrada
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Estado vacío modernizado -->
                <div class="text-center py-16">
                    <div class="mx-auto w-24 h-24 bg-gradient-to-br from-orange-100 to-red-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">No hay mascotas perdidas reportadas</h3>
                    <p class="text-gray-600 mb-6">Afortunadamente, no hay reportes de mascotas perdidas en este momento.</p>
                </div>
                @endforelse
            </div>
            
            <!-- Paginación modernizada -->
            @if($mascotas->hasPages())
            <div class="mt-8 bg-white/60 backdrop-blur-sm rounded-2xl p-4 border border-white/30">
                {{ $mascotas->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const filterStatus = document.getElementById('filter-status');
    const applyFiltersBtn = document.getElementById('apply-filters');
    
    function applyFilters() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilter = filterStatus.value.toLowerCase();
        const rows = document.querySelectorAll('#pets-container tr');
        
        rows.forEach(row => {
            const petName = row.querySelector('.text-gray-900').textContent.toLowerCase();
            const petStatus = row.querySelector('.text-xs').textContent.trim().toLowerCase();
            const matchesSearch = petName.includes(searchTerm);
            const matchesStatus = !statusFilter || petStatus === statusFilter;
            
            if (matchesSearch && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    // Aplicar filtros al hacer clic en el botón
    applyFiltersBtn.addEventListener('click', applyFilters);
    
    // También se pueden aplicar los filtros al presionar Enter en el campo de búsqueda
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            applyFilters();
        }
    });
});
</script>
@endpush
@endsection
