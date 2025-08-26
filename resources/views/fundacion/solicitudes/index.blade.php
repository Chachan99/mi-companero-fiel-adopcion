@extends('layouts.app')

@section('content')
<!-- Modern Background with Decorative Elements -->
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 relative overflow-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-blue-400 to-indigo-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute top-40 left-40 w-80 h-80 bg-gradient-to-br from-green-400 to-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative z-10 py-12 px-4 lg:px-0">
        <div class="max-w-6xl mx-auto">
            <!-- Modern Hero Section -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full border-2 border-purple-200 mb-6">
                    <svg class="h-5 w-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-purple-700 font-bold text-sm">Panel de Gestión</span>
                </div>
                <h1 class="text-5xl font-black bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 bg-clip-text text-transparent mb-4">
                    Solicitudes de Adopción
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Gestiona y revisa todas las solicitudes de adopción de tus animales
                </p>
            </div>

            <!-- Modern Success Message -->
            @if(session('success'))
                <div class="mb-8 p-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl border-2 border-green-200 shadow-lg max-w-2xl mx-auto">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-green-800">¡Éxito!</h3>
                            <p class="mt-1 text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Main Content Container -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden p-8">
                <!-- Modern Solicitudes Grid -->
                <div class="space-y-6">
                    @forelse($solicitudes as $solicitud)
                    <div class="group bg-gradient-to-r from-white to-purple-50 rounded-2xl shadow-lg hover:shadow-xl border-2 border-purple-100 hover:border-purple-200 transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                                <!-- User Info Section -->
                                <div class="flex items-center gap-6">
                                    <div class="relative">
                                        <div class="w-16 h-16 rounded-2xl overflow-hidden border-3 border-purple-200 bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center shadow-lg">
                                            @if($solicitud->usuario && $solicitud->usuario->imagen)
                                                <img src="{{ asset('test/' . $solicitud->usuario->imagen) }}" alt="Foto de perfil" class="object-cover w-full h-full">
                                            @else
                                                <div class="text-3xl">🐾</div>
                                            @endif
                                        </div>
                                        <div class="absolute -top-1 -right-1 w-6 h-6 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                                            <svg class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $solicitud->usuario->nombre ?? 'Usuario no registrado' }}</h3>
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="h-4 w-4 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="font-medium">Animal: <span class="text-purple-600 font-bold">{{ $solicitud->animal->nombre ?? '-' }}</span></span>
                                        </div>
                                        <div class="flex items-center gap-2 text-sm text-gray-500 mt-1">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>{{ $solicitud->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status and Actions Section -->
                                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                                    <!-- Status Badge -->
                                    <div class="flex items-center gap-3">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold shadow-lg
                                            @if($solicitud->estado === 'pendiente') bg-gradient-to-r from-yellow-400 to-orange-400 text-white
                                            @elseif($solicitud->estado === 'aprobado') bg-gradient-to-r from-green-400 to-emerald-400 text-white
                                            @else bg-gradient-to-r from-red-400 to-pink-400 text-white @endif">
                                            @if($solicitud->estado === 'pendiente')
                                                <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif($solicitud->estado === 'aprobado')
                                                <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                            {{ ucfirst($solicitud->estado) }}
                                        </span>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex flex-wrap gap-3">
                                        @if($solicitud->estado === 'pendiente')
                                            <form action="{{ route('fundacion.solicitudes.estado', ['id' => $solicitud->id, 'estado' => 'aprobado']) }}" method="POST" onsubmit="return confirm('¿Estás seguro de aceptar esta solicitud?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="group/btn flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold rounded-xl shadow-lg hover:from-green-600 hover:to-emerald-700 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                                    <svg class="h-4 w-4 mr-2 group-hover/btn:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Aceptar
                                                </button>
                                            </form>
                                            <form action="{{ route('fundacion.solicitudes.estado', ['id' => $solicitud->id, 'estado' => 'rechazado']) }}" method="POST" class="rechazo-form">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="comentario" value="">
                                                <button type="button" class="group/btn flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-pink-600 text-white font-bold rounded-xl shadow-lg hover:from-red-600 hover:to-pink-700 hover:shadow-xl transition-all duration-300 transform hover:scale-105 btn-rechazar">
                                                    <svg class="h-4 w-4 mr-2 group-hover/btn:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Rechazar
                                                </button>
                                            </form>
                                        @else
                                            <div class="flex items-center px-4 py-2 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-500 font-bold rounded-xl border-2 border-gray-300">
                                                <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                Sin acciones
                                            </div>
                                        @endif
                                        <a href="{{ route('fundacion.solicitudes.detalle', $solicitud->id) }}" class="group/btn flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-bold rounded-xl shadow-lg hover:from-purple-600 hover:to-indigo-700 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                            <svg class="h-4 w-4 mr-2 group-hover/btn:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Ver Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <!-- Modern Empty State -->
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="h-12 w-12 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">No hay solicitudes pendientes</h3>
                        <p class="text-gray-600 text-lg mb-6">Cuando recibas solicitudes de adopción, aparecerán aquí para que puedas gestionarlas.</p>
                        <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full border-2 border-purple-200">
                            <svg class="h-5 w-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-purple-700 font-bold">¡Mantente atento a nuevas solicitudes!</span>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-rechazar').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                const form = btn.closest('form');
                let comentario = prompt('Por favor, ingresa el motivo del rechazo (obligatorio):');
                if (comentario && comentario.trim() !== '') {
                    form.querySelector('input[name="comentario"]').value = comentario;
                    form.submit();
                } else {
                    alert('Debes ingresar un motivo para rechazar la solicitud.');
                }
            });
        });
    });
</script>
@endsection
