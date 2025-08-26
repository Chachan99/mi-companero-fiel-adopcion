@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 lg:px-0">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb Moderno -->
        <nav class="mb-8" aria-label="Navegación">
            <ol class="flex flex-wrap items-center gap-2 text-sm bg-white rounded-lg px-4 py-3 shadow-sm border border-gray-100">
                <li><a href="{{ route('publico.index') }}" class="text-emerald-600 hover:text-emerald-700 hover:underline transition-colors font-medium">🏠 Inicio</a></li>
                <li><span class="text-gray-300">•</span></li>
                <li><a href="{{ route('publico.animal', $animal->id) }}" class="text-emerald-600 hover:text-emerald-700 hover:underline transition-colors font-medium">🐾 {{ $animal->nombre }}</a></li>
                <li><span class="text-gray-300">•</span></li>
                <li class="text-gray-700 font-semibold">📝 Solicitar Adopción</li>
            </ol>
        </nav>

        <!-- Tarjeta de Información del Animal Moderna -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100 transition-all hover:shadow-xl">
            <div class="flex flex-col sm:flex-row items-center gap-6">
                <div class="relative group">
                    <div class="w-28 h-28 sm:w-36 sm:h-36 rounded-2xl overflow-hidden bg-gradient-to-br from-emerald-50 to-green-50 border-2 border-emerald-100 shadow-lg group-hover:shadow-xl transition-all">
                        <img src="{{ $animal->imagen_url }}" onerror="this.onerror=null; this.src='{{ asset('img/animal-default.svg') }}'"
                             alt="{{ $animal->nombre }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="absolute -bottom-2 -right-2 bg-emerald-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                        {{ $animal->tipo === 'perro' ? '🐕' : ($animal->tipo === 'gato' ? '🐱' : '🐹') }} {{ ucfirst($animal->tipo) }}
                    </div>
                </div>
                <div class="text-center sm:text-left flex-1">
                    <div class="mb-3">
                        <h2 class="text-3xl font-bold text-gray-900 mb-1">{{ $animal->nombre }}</h2>
                        <div class="flex items-center justify-center sm:justify-start gap-2 text-emerald-600">
                            <i class="fas fa-birthday-cake"></i>
                            <span class="font-semibold">{{ $animal->edad }} {{ $animal->tipo_edad === 'anios' ? 'años' : 'meses' }}</span>
                        </div>
                    </div>
                    @if($animal->fundacion)
                    <div class="inline-flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-lg border border-gray-100">
                        <i class="fas fa-home text-emerald-500"></i>
                        <span class="text-gray-700 text-sm font-medium">{{ $animal->fundacion->nombre }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Formulario de Solicitud Moderno -->
        <div class="bg-white rounded-2xl shadow-lg p-6 lg:p-8 border border-gray-100">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-full mb-4">
                    <i class="fas fa-heart text-2xl text-emerald-600"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-3">Solicitar Adopción</h1>
                <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">Completa este formulario para solicitar la adopción de <span class="font-semibold text-emerald-600">{{ $animal->nombre }}</span>. Revisaremos cuidadosamente tu solicitud y nos pondremos en contacto contigo pronto.</p>
                
                @guest
                    <div class="mt-6 bg-emerald-50 border border-emerald-200 rounded-xl p-4 max-w-2xl mx-auto">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-info text-emerald-600 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-emerald-800 mb-1">¿No tienes cuenta?</h4>
                                <p class="text-emerald-700 text-sm leading-relaxed">
                                    Puedes enviar esta solicitud sin registrarte. Para hacer seguimiento de tus solicitudes y recibir actualizaciones,
                                    <a href="{{ route('register') }}" class="text-emerald-600 hover:text-emerald-800 underline font-medium">crea una cuenta</a> o
                                    <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-800 underline font-medium">inicia sesión</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6" role="alert">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-red-800 mb-2">Por favor, corrige los siguientes errores:</h3>
                            <div class="space-y-1">
                                @foreach($errors->all() as $error)
                                    <div class="flex items-center gap-2 text-sm text-red-700">
                                        <i class="fas fa-dot-circle text-xs"></i>
                                        <span>{{ $error }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('adopcion.store') }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="animal_id" value="{{ $animal->id }}">

                <!-- Información Personal -->
                <div class="bg-gradient-to-br from-gray-50 to-gray-100/50 rounded-2xl p-6 border border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-user text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Información Personal</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="nombre" class="block text-sm font-semibold text-gray-700">Nombre Completo *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400 text-sm"></i>
                                </div>
                                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', auth()->user()->nombre ?? '') }}" 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-white shadow-sm hover:shadow-md"
                                       placeholder="Ej: María González" required>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-semibold text-gray-700">Email *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                                </div>
                                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-white shadow-sm hover:shadow-md"
                                       placeholder="tu@email.com" required>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="space-y-2">
                            <label for="telefono" class="block text-sm font-semibold text-gray-700">Teléfono *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-400 text-sm"></i>
                                </div>
                                <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}" 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-white shadow-sm hover:shadow-md"
                                       placeholder="+57 300 1234567" required>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="identificacion" class="block text-sm font-semibold text-gray-700">Documento de Identidad *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-id-card text-gray-400 text-sm"></i>
                                </div>
                                <input type="text" id="identificacion" name="identificacion" value="{{ old('identificacion') }}" 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-white shadow-sm hover:shadow-md"
                                       placeholder="Número de cédula o pasaporte" required>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="space-y-2">
                            <label for="edad" class="block text-sm font-semibold text-gray-700">Edad *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-birthday-cake text-gray-400 text-sm"></i>
                                </div>
                                <input type="number" id="edad" name="edad" value="{{ old('edad') }}" min="18" max="100"
                                       class="w-full pl-10 pr-16 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-white shadow-sm hover:shadow-md"
                                       placeholder="25" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">años</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="ocupacion" class="block text-sm font-semibold text-gray-700">Ocupación *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-briefcase text-gray-400 text-sm"></i>
                                </div>
                                <input type="text" id="ocupacion" name="ocupacion" value="{{ old('ocupacion') }}" 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-white shadow-sm hover:shadow-md"
                                       placeholder="Ej: Estudiante, Ingeniero, Comerciante" required>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 space-y-2">
                        <label for="direccion_solicitante" class="block text-sm font-semibold text-gray-700">Dirección Completa *</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400 text-sm"></i>
                            </div>
                            <input type="text" id="direccion_solicitante" name="direccion_solicitante" value="{{ old('direccion_solicitante') }}" 
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-white shadow-sm hover:shadow-md"
                                   placeholder="Calle, número, ciudad, departamento" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="space-y-2">
                            <label for="barrio" class="block text-sm font-semibold text-gray-700">Barrio/Sector *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-building text-gray-400 text-sm"></i>
                                </div>
                                <input type="text" id="barrio" name="barrio" value="{{ old('barrio') }}" 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-white shadow-sm hover:shadow-md"
                                       placeholder="Ej: El Poblado, La Candelaria, etc." required>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="referencia" class="block text-sm font-semibold text-gray-700">Teléfono de Referencia *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone-alt text-gray-400 text-sm"></i>
                                </div>
                                <input type="text" id="referencia" name="referencia" value="{{ old('referencia') }}" 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-white shadow-sm hover:shadow-md"
                                       placeholder="Persona que pueda confirmar tu información" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información del Hogar -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50/50 rounded-2xl p-6 border border-blue-200">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-home text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Información del Hogar</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="tipo_vivienda" class="block text-sm font-semibold text-gray-700">Tipo de Vivienda *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-building text-gray-400 text-sm"></i>
                                </div>
                                <select id="tipo_vivienda" name="tipo_vivienda" required
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white shadow-sm hover:shadow-md appearance-none">
                                    <option value="">Selecciona una opción</option>
                                    <option value="casa" {{ old('tipo_vivienda') == 'casa' ? 'selected' : '' }}>🏠 Casa</option>
                                    <option value="apartamento" {{ old('tipo_vivienda') == 'apartamento' ? 'selected' : '' }}>🏢 Apartamento</option>
                                    <option value="duplex" {{ old('tipo_vivienda') == 'duplex' ? 'selected' : '' }}>🏘️ Dúplex</option>
                                    <option value="finca" {{ old('tipo_vivienda') == 'finca' ? 'selected' : '' }}>🌾 Finca</option>
                                    <option value="otro" {{ old('tipo_vivienda') == 'otro' ? 'selected' : '' }}>🏗️ Otro</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="tiene_patio" class="block text-sm font-semibold text-gray-700">¿Tienes Patio/Jardín? *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-seedling text-gray-400 text-sm"></i>
                                </div>
                                <select id="tiene_patio" name="tiene_patio" required
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white shadow-sm hover:shadow-md appearance-none">
                                    <option value="">Selecciona una opción</option>
                                    <option value="si" {{ old('tiene_patio') == 'si' ? 'selected' : '' }}>✅ Sí, tengo espacio exterior</option>
                                    <option value="no" {{ old('tiene_patio') == 'no' ? 'selected' : '' }}>❌ No, solo espacio interior</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="space-y-2">
                            <label for="otros_mascotas" class="block text-sm font-semibold text-gray-700">¿Tienes otras mascotas? *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-paw text-gray-400 text-sm"></i>
                                </div>
                                <select id="otros_mascotas" name="otros_mascotas" required
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white shadow-sm hover:shadow-md appearance-none">
                                    <option value="">Selecciona una opción</option>
                                    <option value="si" {{ old('otros_mascotas') == 'si' ? 'selected' : '' }}>🐾 Sí, tengo otras mascotas</option>
                                    <option value="no" {{ old('otros_mascotas') == 'no' ? 'selected' : '' }}>🆕 No, sería mi primera mascota</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="experiencia_mascotas" class="block text-sm font-semibold text-gray-700">Experiencia con mascotas *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-star text-gray-400 text-sm"></i>
                                </div>
                                <select id="experiencia_mascotas" name="experiencia_mascotas" required
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white shadow-sm hover:shadow-md appearance-none">
                                    <option value="">Selecciona una opción</option>
                                    <option value="nada" {{ old('experiencia_mascotas') == 'nada' ? 'selected' : '' }}>⭐ Ninguna experiencia</option>
                                    <option value="poca" {{ old('experiencia_mascotas') == 'poca' ? 'selected' : '' }}>⭐⭐ Poca experiencia</option>
                                    <option value="moderada" {{ old('experiencia_mascotas') == 'moderada' ? 'selected' : '' }}>⭐⭐⭐ Experiencia moderada</option>
                                    <option value="mucha" {{ old('experiencia_mascotas') == 'mucha' ? 'selected' : '' }}>⭐⭐⭐⭐ Mucha experiencia</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="mascotas-info" class="mt-6 {{ old('otros_mascotas') == 'si' ? 'block' : 'hidden' }}">
                        <div class="space-y-2">
                            <label for="descripcion_mascotas" class="block text-sm font-semibold text-gray-700">Describe tus otras mascotas</label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 pointer-events-none">
                                    <i class="fas fa-edit text-gray-400 text-sm"></i>
                                </div>
                                <textarea id="descripcion_mascotas" name="descripcion_mascotas" rows="3" 
                                          class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white shadow-sm hover:shadow-md"
                                          placeholder="Ejemplo: Tengo un perro labrador de 5 años muy tranquilo y sociable, y dos gatos persas que se llevan bien con otros animales...">{{ old('descripcion_mascotas') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50/50 rounded-2xl p-6 border border-purple-200">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-clipboard-list text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Información Adicional</h3>
                    </div>
                    
                    <div class="space-y-2">
                        <label for="motivo_adopcion" class="block text-sm font-semibold text-gray-700">Motivo de la Adopción *</label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 pointer-events-none">
                                <i class="fas fa-heart text-gray-400 text-sm"></i>
                            </div>
                            <textarea id="motivo_adopcion" name="motivo_adopcion" rows="3" 
                                      class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all bg-white shadow-sm hover:shadow-md"
                                      placeholder="Ejemplo: Quiero brindar amor y un hogar seguro a {{ $animal->nombre }}. Tengo experiencia cuidando animales y creo que sería perfecto para nuestra familia..." required>{{ old('motivo_adopcion') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="space-y-2">
                            <label for="tiempo_disponible" class="block text-sm font-semibold text-gray-700">Tiempo Disponible *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-clock text-gray-400 text-sm"></i>
                                </div>
                                <select id="tiempo_disponible" name="tiempo_disponible" 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all bg-white shadow-sm hover:shadow-md appearance-none" required>
                                    <option value="">Selecciona una opción</option>
                                    <option value="poco" {{ old('tiempo_disponible') == 'poco' ? 'selected' : '' }}>⏰ Poco tiempo (1-2 horas/día)</option>
                                    <option value="moderado" {{ old('tiempo_disponible') == 'moderado' ? 'selected' : '' }}>⏱️ Tiempo moderado (2-4 horas/día)</option>
                                    <option value="mucho" {{ old('tiempo_disponible') == 'mucho' ? 'selected' : '' }}>⏳ Mucho tiempo (4+ horas/día)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="compromiso_esterilizacion" class="block text-sm font-semibold text-gray-700">¿Aceptas esterilizar? *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-shield-alt text-gray-400 text-sm"></i>
                                </div>
                                <select id="compromiso_esterilizacion" name="compromiso_esterilizacion" 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all bg-white shadow-sm hover:shadow-md appearance-none" required>
                                    <option value="">Selecciona una opción</option>
                                    <option value="si" {{ old('compromiso_esterilizacion') == 'si' ? 'selected' : '' }}>✅ Sí, estoy de acuerdo</option>
                                    <option value="no" {{ old('compromiso_esterilizacion') == 'no' ? 'selected' : '' }}>❌ No estoy de acuerdo</option>
                                    <option value="consultar" {{ old('compromiso_esterilizacion') == 'consultar' ? 'selected' : '' }}>❓ Deseo más información</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 space-y-2">
                        <label for="bienestar_mascota" class="block text-sm font-semibold text-gray-700">Plan de Cuidado *</label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 pointer-events-none">
                                <i class="fas fa-medkit text-gray-400 text-sm"></i>
                            </div>
                            <textarea id="bienestar_mascota" name="bienestar_mascota" rows="4" 
                                      class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all bg-white shadow-sm hover:shadow-md"
                                      placeholder="Ejemplo: Programaré visitas veterinarias regulares, mantendré al día las vacunas, proporcionaré alimentación de calidad, ejercicio diario y mucho amor y atención..." required>{{ old('bienestar_mascota') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="mt-6 space-y-2">
                        <label for="conocimiento_cuidados" class="block text-sm font-semibold text-gray-700">Conocimientos sobre Cuidados *</label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 pointer-events-none">
                                <i class="fas fa-graduation-cap text-gray-400 text-sm"></i>
                            </div>
                            <textarea id="conocimiento_cuidados" name="conocimiento_cuidados" rows="3" 
                                      class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all bg-white shadow-sm hover:shadow-md"
                                      placeholder="Ejemplo: Tengo conocimientos básicos sobre nutrición canina/felina, sé reconocer signos de enfermedad, tengo experiencia con entrenamiento básico y socialización..." required>{{ old('conocimiento_cuidados') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Preguntas de Seguridad -->
                <div class="bg-gradient-to-br from-orange-50 to-yellow-50/50 rounded-2xl p-6 border border-orange-200">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-shield-alt text-orange-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Preguntas de Seguridad</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="experiencia_mascotas" class="block text-sm font-semibold text-gray-700">¿Has tenido mascotas antes? *</label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 pointer-events-none">
                                    <i class="fas fa-paw text-gray-400 text-sm"></i>
                                </div>
                                <textarea id="experiencia_mascotas" name="experiencia_mascotas" rows="3" required
                                          class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all resize-none bg-white shadow-sm hover:shadow-md"
                                          placeholder="Ejemplo: Sí, he tenido perros durante 10 años. Mi último perro vivió 12 años y falleció por edad avanzada. Tengo experiencia con cuidados básicos, entrenamiento y emergencias...">{{ old('experiencia_mascotas') }}</textarea>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="plan_emergencias" class="block text-sm font-semibold text-gray-700">¿Qué harías en caso de emergencia médica? *</label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 pointer-events-none">
                                    <i class="fas fa-ambulance text-gray-400 text-sm"></i>
                                </div>
                                <textarea id="plan_emergencias" name="plan_emergencias" rows="3" required
                                          class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all resize-none bg-white shadow-sm hover:shadow-md"
                                          placeholder="Ejemplo: Tengo identificada la clínica veterinaria de emergencias más cercana. Mantendría la calma, contactaría inmediatamente al veterinario y seguiría sus instrucciones...">{{ old('plan_emergencias') }}</textarea>
                            </div>
                        </div>
                        
                        <div class="md:col-span-2 space-y-2">
                            <label for="plan_perdida" class="block text-sm font-semibold text-gray-700">¿Qué harías si la mascota se pierde? *</label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 pointer-events-none">
                                    <i class="fas fa-search text-gray-400 text-sm"></i>
                                </div>
                                <textarea id="plan_perdida" name="plan_perdida" rows="3" required
                                          class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all resize-none bg-white shadow-sm hover:shadow-md"
                                          placeholder="Ejemplo: Buscaría inmediatamente en el área, contactaría a la fundación, publicaría en redes sociales con foto, visitaría refugios locales, pondría carteles en el barrio...">{{ old('plan_perdida') }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50/50 rounded-2xl p-6 border border-blue-200">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-balance-scale text-blue-600 text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Información Importante - Ley Ángel</h3>
                                <div class="bg-white/70 rounded-xl p-4 border border-blue-100">
                                    <p class="text-sm text-gray-700 mb-3 font-medium">La Ley 2054 de 2020 (Ley Ángel) establece que:</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="fas fa-gavel text-red-500 mr-2"></i>
                                            <span>El maltrato animal es un delito penal</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="fas fa-clock text-orange-500 mr-2"></i>
                                            <span>Penas de 12 a 36 meses de prisión</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="fas fa-dollar-sign text-yellow-500 mr-2"></i>
                                            <span>Multas de 5 a 60 salarios mínimos</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                                            <span>Aplica para abandono y maltrato</span>
                                        </div>
                                    </div>
                                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg p-3">
                                        <p class="text-sm font-semibold text-green-800 flex items-center">
                                            <i class="fas fa-heart text-green-600 mr-2"></i>
                                            Al adoptar, te comprometes a brindar amor, cuidado y protección.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Información Adicional Opcional -->
                    <div class="bg-gradient-to-br from-gray-50 to-slate-50/50 rounded-2xl p-6 border border-gray-200 mt-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-comment-dots text-gray-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Información Adicional</h3>
                                <p class="text-sm text-gray-600">Opcional - Comparte algo más sobre ti</p>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <div class="absolute top-3 left-3 pointer-events-none">
                                <i class="fas fa-pen text-gray-400 text-sm"></i>
                            </div>
                            <textarea id="mensaje" name="mensaje" rows="4"
                                      class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none bg-white shadow-sm hover:shadow-md"
                                      placeholder="Ejemplo: Trabajo desde casa y tengo un patio grande. Me encanta hacer ejercicio y llevaría a {{ $animal->nombre }} a correr. También tengo experiencia con entrenamiento positivo...">{{ old('mensaje') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-emerald-600 to-green-600 text-white font-bold py-4 px-8 rounded-xl hover:from-emerald-700 hover:to-green-700 transform hover:scale-[1.02] transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center group">
                            <i class="fas fa-heart mr-3 group-hover:animate-pulse"></i>
                            <span>Enviar Solicitud de Adopción</span>
                            <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                        </button>
                        
                        <a href="{{ route('publico.animal', $animal->id) }}" 
                           class="flex-1 sm:flex-none bg-gray-100 text-gray-700 font-semibold py-4 px-8 rounded-xl hover:bg-gray-200 transition-all text-center flex items-center justify-center group hover:shadow-md">
                            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                            <span>Cancelar</span>
                        </a>
                    </div>
                    
                    <div class="mt-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
                        <div class="flex items-center text-sm text-blue-800">
                            <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                            <span class="font-medium">Tu solicitud será revisada en un plazo máximo de 48 horas. Te contactaremos pronto.</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Mostrar/ocultar campo de descripción de mascotas según selección
    document.getElementById('otros_mascotas').addEventListener('change', function() {
        const mascotasInfo = document.getElementById('mascotas-info');
        if (this.value === 'si') {
            mascotasInfo.classList.remove('hidden');
            mascotasInfo.querySelector('textarea').setAttribute('required', 'required');
        } else {
            mascotasInfo.classList.add('hidden');
            mascotasInfo.querySelector('textarea').removeAttribute('required');
        }
    });
</script>
@endsection
