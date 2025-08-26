@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400/20 to-purple-400/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-green-400/20 to-blue-400/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <div class="relative max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Modern Hero Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-100 to-blue-100 rounded-full text-sm font-medium text-green-800 mb-4">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                Nuevo Registro
            </div>
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-green-600 via-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                Agregar Nuevo Animal
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-8">
                Completa el formulario para registrar un nuevo animal y darle una oportunidad de encontrar un hogar
            </p>
        </div>

        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden p-8">

            <!-- Modern Success/Error Messages -->
            @if(session('success'))
                <div class="mb-8 p-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl border-2 border-green-200 shadow-lg">
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
            @elseif(session('error'))
                <div class="mb-8 p-6 bg-gradient-to-r from-red-50 to-pink-50 rounded-2xl border-2 border-red-200 shadow-lg">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-red-800">¡Error!</h3>
                            <p class="mt-1 text-red-700 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Validation Errors -->
            @if($errors->any())
                <div class="mb-8 p-6 bg-gradient-to-r from-red-50 to-pink-50 rounded-2xl border-2 border-red-200 shadow-lg">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-red-800">¡Errores de validación!</h3>
                            <ul class="mt-2 text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-center">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Modern Form -->
            <form action="{{ route('fundacion.animales.guardar') }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="animalForm">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Columna 1 -->
                    <div class="space-y-8">
                        <!-- Nombre -->
                        <div class="group">
                            <label for="nombre" class="block text-lg font-bold text-gray-800 mb-3 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                                    <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                Nombre del Animal *
                            </label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" 
                                   class="w-full px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition-all duration-300 text-lg font-medium placeholder-gray-400 group-hover:border-blue-300" 
                                   placeholder="Ej: Max, Luna, Firulais..." required>
                            @error('nombre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tipo -->
                        <div class="group">
                            <label for="tipo" class="block text-lg font-bold text-gray-800 mb-3 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center mr-3">
                                    <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                Tipo de Animal *
                            </label>
                            <select id="tipo" name="tipo" class="w-full px-6 py-4 bg-gradient-to-r from-gray-50 to-green-50 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-green-200 focus:border-green-500 transition-all duration-300 text-lg font-medium group-hover:border-green-300" required>
                                <option value="" disabled selected class="text-gray-400">Selecciona el tipo de animal</option>
                                <option value="perro" {{ old('tipo') == 'perro' ? 'selected' : '' }}>🐕 Perro</option>
                                <option value="gato" {{ old('tipo') == 'gato' ? 'selected' : '' }}>🐱 Gato</option>
                                <option value="otro" {{ old('tipo') == 'otro' ? 'selected' : '' }}>🐾 Otro</option>
                            </select>
                            @error('tipo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Edad -->
                        <div class="group">
                            <label class="block text-lg font-bold text-gray-800 mb-3 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center mr-3">
                                    <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                Edad del Animal *
                            </label>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <div class="flex-1">
                                    <input type="number" name="edad" value="{{ old('edad') }}" 
                                           class="w-full px-6 py-4 bg-gradient-to-r from-gray-50 to-purple-50 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition-all duration-300 text-lg font-medium placeholder-gray-400 group-hover:border-purple-300" 
                                           placeholder="Ej: 2" min="0" required>
                                    @error('edad')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex items-center gap-6 bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-2xl border-2 border-purple-100">
                                    <label class="flex items-center cursor-pointer group/radio">
                                        <input type="radio" id="edad_anios" name="tipo_edad" value="anios" 
                                               class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-2 border-purple-300 group-hover/radio:border-purple-400" 
                                               {{ old('tipo_edad') == 'anios' ? 'checked' : '' }}>
                                        <span class="ml-3 text-lg font-medium text-purple-700 group-hover/radio:text-purple-800">Años</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer group/radio">
                                        <input type="radio" id="edad_meses" name="tipo_edad" value="meses" 
                                               class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-2 border-purple-300 group-hover/radio:border-purple-400" 
                                               {{ old('tipo_edad') == 'meses' ? 'checked' : '' }}>
                                        <span class="ml-3 text-lg font-medium text-purple-700 group-hover/radio:text-purple-800">Meses</span>
                                    </label>
                                    @error('tipo_edad')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Ubicación en el mapa -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dirección *</label>
                            <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3 border mb-2" placeholder="Busca o escribe la dirección" required autocomplete="off">
                            <ul id="autocomplete-results" class="bg-white border border-gray-300 rounded shadow mt-1 mb-2 hidden z-10"></ul>
                            <div id="gmap-create" class="min-h-[300px] border-2 border-red-500 flex items-center justify-center text-center text-red-700" style="height: 300px; border-radius: 0.5rem; margin-bottom: 1rem;">
                                <span id="gmap-error" style="display:none;">No se pudo cargar el mapa. Revisa la consola del navegador.</span>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-1/2">
                                    <label for="latitud" class="block text-xs text-gray-600">Latitud</label>
                                    <input type="text" id="latitud" name="latitud" value="{{ old('latitud') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3 border" readonly required>
                                </div>
                                <div class="w-1/2">
                                    <label for="longitud" class="block text-xs text-gray-600">Longitud</label>
                                    <input type="text" id="longitud" name="longitud" value="{{ old('longitud') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3 border" readonly required>
                                </div>
                            </div>
                            @error('direccion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('latitud')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('longitud')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Columna 2 -->
                    <div class="space-y-8">
                        <!-- Sexo -->
                        <div class="group">
                            <label for="sexo" class="block text-lg font-bold text-gray-800 mb-3 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-pink-500 to-rose-600 rounded-full flex items-center justify-center mr-3">
                                    <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                    </svg>
                                </div>
                                Sexo del Animal *
                            </label>
                            <select id="sexo" name="sexo" class="w-full px-6 py-4 bg-gradient-to-r from-gray-50 to-pink-50 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-pink-200 focus:border-pink-500 transition-all duration-300 text-lg font-medium group-hover:border-pink-300" required>
                                <option value="" disabled selected class="text-gray-400">Selecciona el sexo del animal</option>
                                <option value="macho" {{ old('sexo') == 'macho' ? 'selected' : '' }}>♂️ Macho</option>
                                <option value="hembra" {{ old('sexo') == 'hembra' ? 'selected' : '' }}>♀️ Hembra</option>
                            </select>
                            @error('sexo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="group">
                            <label for="descripcion" class="block text-lg font-bold text-gray-800 mb-3 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-blue-600 rounded-full flex items-center justify-center mr-3">
                                    <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                Descripción del Animal *
                            </label>
                            <textarea id="descripcion" name="descripcion" rows="5" 
                                      class="w-full px-6 py-4 bg-gradient-to-r from-gray-50 to-indigo-50 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition-all duration-300 text-lg font-medium placeholder-gray-400 group-hover:border-indigo-300 resize-none" 
                                      placeholder="Describe las características, personalidad y cuidados especiales del animal...">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Imagen -->
                        <div class="group">
                            <label for="imagen" class="block text-lg font-bold text-gray-800 mb-3 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-full flex items-center justify-center mr-3">
                                    <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                Imagen del Animal *
                            </label>
                            <div class="mt-1">
                                <label for="imagen" class="cursor-pointer">
                                    <div class="group/upload relative border-2 border-dashed border-gray-300 rounded-2xl p-8 hover:border-yellow-500 hover:bg-gradient-to-br hover:from-yellow-50 hover:to-orange-50 transition-all duration-300 bg-gradient-to-br from-gray-50 to-yellow-50">
                                        <div class="flex flex-col items-center justify-center text-center">
                                            <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-full flex items-center justify-center mb-4 group-hover/upload:scale-110 transition-transform duration-300">
                                                <svg class="h-8 w-8 text-white" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover/upload:text-yellow-700">Subir Imagen del Animal</h3>
                                            <p class="text-lg text-gray-600 mb-2 group-hover/upload:text-yellow-600">Haz clic aquí o arrastra una imagen</p>
                                            <p class="text-sm text-gray-500 bg-white px-4 py-2 rounded-full border border-gray-200">PNG, JPG, JPEG (Máx. 5MB)</p>
                                        </div>
                                        <input id="imagen" name="imagen" type="file" accept="image/*" class="sr-only" required>
                                    </div>
                                </label>
                            </div>
                            @error('imagen')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Modern Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end gap-4 pt-8 border-t-2 border-gradient-to-r from-gray-200 to-blue-200">
                    <a href="{{ route('fundacion.animales') }}" 
                       class="group flex items-center justify-center px-8 py-4 bg-gradient-to-r from-gray-100 to-gray-200 border-2 border-gray-300 rounded-2xl text-gray-700 font-bold text-lg hover:from-gray-200 hover:to-gray-300 hover:border-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all duration-300 transform hover:scale-105">
                        <svg class="h-5 w-5 mr-3 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Cancelar
                    </a>
                    <button type="submit" id="submitBtn"
                            class="group flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 border-2 border-blue-500 rounded-2xl text-white font-bold text-lg hover:from-blue-600 hover:to-purple-700 hover:border-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-200 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <svg class="h-5 w-5 mr-3 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Guardar Animal
                        <div class="ml-2 w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script>
    $(document).ready(function() {
        // Validación del formulario
        $('#animalForm').on('submit', function(e) {
            let isValid = true;
            const requiredFields = ['nombre', 'tipo', 'edad', 'tipo_edad', 'sexo', 'descripcion', 'imagen'];
            
            // Validar campos requeridos
            requiredFields.forEach(function(field) {
                const $field = $(`[name="${field}"]`);
                if (!$field.val()) {
                    isValid = false;
                    $field.addClass('border-red-500').removeClass('border-gray-300');
                } else {
                    $field.removeClass('border-red-500').addClass('border-gray-300');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Por favor, complete todos los campos requeridos.');
                return false;
            }
            
            // Mostrar mensaje de carga
            $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Guardando...');
            return true;
        });
    });
</script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    let map, marker;
    function setMarkerAndInputs(lat, lng, address) {
        marker.setLatLng([lat, lng]);
        map.setView([lat, lng], 16);
        document.getElementById('latitud').value = lat.toFixed(7);
        document.getElementById('longitud').value = lng.toFixed(7);
        if(address) document.getElementById('direccion').value = address;
    }
    document.addEventListener('DOMContentLoaded', function () {
        var defaultLat = parseFloat(document.getElementById('latitud').value) || 4.710989;
        var defaultLng = parseFloat(document.getElementById('longitud').value) || -74.072092;
        var gmapDiv = document.getElementById('gmap-create');
        var gmapError = document.getElementById('gmap-error');
        if (!gmapDiv) {
            if(gmapError) gmapError.style.display = 'block';
            console.error('No se encontró el div del mapa.');
            return;
        }
        try {
            map = L.map('gmap-create').setView([defaultLat, defaultLng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);
            marker = L.marker([defaultLat, defaultLng], {draggable:true}).addTo(map);
            setMarkerAndInputs(defaultLat, defaultLng);
            setTimeout(() => { map.invalidateSize(); }, 300);
            map.on('click', function(e) {
                setMarkerAndInputs(e.latlng.lat, e.latlng.lng);
                // Reverse geocode
                fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${e.latlng.lat}&lon=${e.latlng.lng}`)
                    .then(res => res.json())
                    .then(data => {
                        if(data.display_name) document.getElementById('direccion').value = data.display_name;
                    });
            });
            marker.on('dragend', function(e) {
                var latlng = marker.getLatLng();
                setMarkerAndInputs(latlng.lat, latlng.lng);
                fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latlng.lat}&lon=${latlng.lng}`)
                    .then(res => res.json())
                    .then(data => {
                        if(data.display_name) document.getElementById('direccion').value = data.display_name;
                    });
            });

            // Autocomplete
            const direccionInput = document.getElementById('direccion');
            const resultsList = document.getElementById('autocomplete-results');
            let timeout = null;
            direccionInput.addEventListener('input', function() {
                clearTimeout(timeout);
                const query = this.value;
                if(query.length < 3) {
                    resultsList.innerHTML = '';
                    resultsList.classList.add('hidden');
                    return;
                }
                timeout = setTimeout(() => {
                    fetch(`https://nominatim.openstreetmap.org/search?format=jsonv2&q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            resultsList.innerHTML = '';
                            if(data.length === 0) {
                                resultsList.classList.add('hidden');
                                return;
                            }
                            data.forEach(item => {
                                const li = document.createElement('li');
                                li.textContent = item.display_name;
                                li.className = 'px-3 py-2 cursor-pointer hover:bg-blue-100';
                                li.addEventListener('click', function() {
                                    setMarkerAndInputs(parseFloat(item.lat), parseFloat(item.lon), item.display_name);
                                    resultsList.innerHTML = '';
                                    resultsList.classList.add('hidden');
                                });
                                resultsList.appendChild(li);
                            });
                            resultsList.classList.remove('hidden');
                        });
                }, 400);
            });
            document.addEventListener('click', function(e) {
                if(!direccionInput.contains(e.target) && !resultsList.contains(e.target)) {
                    resultsList.classList.add('hidden');
                }
            });
        } catch (e) {
            if(gmapError) gmapError.style.display = 'block';
            console.error('Error al inicializar el mapa:', e);
        }
    });
</script>
@endpush
