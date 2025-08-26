@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Header con breadcrumb -->
        <div class="mb-8">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-emerald-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('admin.usuarios.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-emerald-600 md:ml-2">Usuarios</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Editar Usuario</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-r from-amber-500 to-orange-500 p-3 rounded-xl">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">Editar Usuario</h1>
                            <p class="text-gray-600 mt-1">Modifica la información del usuario {{ $usuario->nombre }}</p>
                        </div>
                    </div>
                    
                    <!-- Información del usuario actual -->
                    <div class="hidden lg:flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Último acceso</p>
                            <p class="text-sm font-medium text-gray-900">{{ $usuario->updated_at ? $usuario->updated_at->format('d/m/Y H:i') : 'Nunca' }}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr($usuario->nombre, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <!-- Alertas de éxito -->
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-400 p-6 m-6 rounded-lg animate-pulse">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form id="editUserForm" action="{{ route('admin.usuarios.actualizar', $usuario->id) }}" method="POST" class="p-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Información Personal -->
                        <div class="space-y-6">
                            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 p-4 rounded-xl border border-emerald-100">
                                <h3 class="text-lg font-semibold text-emerald-800 mb-1">Información Personal</h3>
                                <p class="text-sm text-emerald-600">Datos básicos del usuario</p>
                            </div>
                            
                            <!-- Nombre -->
                            <div class="form-group">
                                <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Nombre completo
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 bg-gray-50 hover:bg-white" 
                                       placeholder="Ingresa el nombre completo"
                                       required>
                                @error('nombre')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <div class="validation-message text-sm mt-1 hidden"></div>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                        Correo electrónico
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email', $usuario->email) }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 bg-gray-50 hover:bg-white" 
                                       placeholder="usuario@ejemplo.com"
                                       required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <div class="validation-message text-sm mt-1 hidden"></div>
                            </div>

                            <!-- Rol -->
                            <div class="form-group">
                                <label for="rol" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                        </svg>
                                        Rol del usuario
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <select id="rol" name="rol" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 bg-gray-50 hover:bg-white" 
                                        required>
                                    <option value="fundacion" @if($usuario->rol === 'fundacion') selected @endif>Fundación</option>
                                    <option value="admin" @if($usuario->rol === 'admin') selected @endif>Administrador</option>
                                </select>
                                @error('rol')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <div class="validation-message text-sm mt-1 hidden"></div>
                                <div class="role-description text-sm text-gray-600 mt-2 hidden"></div>
                            </div>

                            <!-- Estado del usuario -->
                            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                                <h4 class="text-sm font-medium text-gray-800 mb-3">Estado de la cuenta</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Fecha de registro:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $usuario->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Última actualización:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $usuario->updated_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Estado:</span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Activo
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Seguridad -->
                        <div class="space-y-6">
                            <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-xl border border-purple-100">
                                <h3 class="text-lg font-semibold text-purple-800 mb-1">Configuración de Seguridad</h3>
                                <p class="text-sm text-purple-600">Actualiza las credenciales de acceso</p>
                            </div>
                            
                            <!-- Contraseña -->
                            <div class="form-group">
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Nueva contraseña
                                        <span class="text-gray-500 ml-1">(opcional)</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" 
                                           class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 bg-gray-50 hover:bg-white" 
                                           placeholder="Deja en blanco para mantener la actual">
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('password')">
                                        <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <div class="validation-message text-sm mt-1 hidden"></div>
                                <p class="text-xs text-gray-500 mt-1">Solo completa este campo si deseas cambiar la contraseña actual</p>
                                
                                <!-- Indicador de fortaleza de contraseña -->
                                <div class="password-strength mt-3 hidden">
                                    <div class="flex items-center space-x-2">
                                        <div class="flex-1 bg-gray-200 rounded-full h-2">
                                            <div class="strength-bar h-2 rounded-full transition-all duration-300"></div>
                                        </div>
                                        <span class="strength-text text-xs font-medium"></span>
                                    </div>
                                    <div class="requirements mt-2 space-y-1 text-xs">
                                        <div class="requirement flex items-center" data-requirement="length">
                                            <svg class="h-3 w-3 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <span>Mínimo 8 caracteres</span>
                                        </div>
                                        <div class="requirement flex items-center" data-requirement="uppercase">
                                            <svg class="h-3 w-3 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <span>Una letra mayúscula</span>
                                        </div>
                                        <div class="requirement flex items-center" data-requirement="number">
                                            <svg class="h-3 w-3 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <span>Un número</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Acciones de seguridad -->
                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                                <div class="flex items-start">
                                    <svg class="h-5 w-5 text-yellow-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-yellow-800">Acciones de seguridad</h4>
                                        <div class="mt-2 space-y-2">
                                            <button type="button" class="text-sm text-yellow-700 hover:text-yellow-900 underline" onclick="resetPassword()">
                                                Generar contraseña temporal
                                            </button>
                                            <br>
                                            <button type="button" class="text-sm text-yellow-700 hover:text-yellow-900 underline" onclick="sendPasswordReset()">
                                                Enviar enlace de restablecimiento
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 sm:space-x-4 mt-8 pt-6 border-t border-gray-200">
                        <div class="flex space-x-3">
                            <button type="button" class="px-4 py-2 bg-red-100 text-red-700 rounded-xl hover:bg-red-200 transition-all duration-200 font-medium border border-red-300 hover:border-red-400" onclick="deleteUser()">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Eliminar Usuario
                                </span>
                            </button>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('admin.usuarios.index') }}" 
                               class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 font-medium text-center border border-gray-300 hover:border-gray-400">
                                <span class="flex items-center justify-center">
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Cancelar
                                </span>
                            </a>
                            <button type="submit" id="submitBtn"
                                    class="px-6 py-3 bg-gradient-to-r from-amber-600 to-orange-600 text-white rounded-xl hover:from-amber-700 hover:to-orange-700 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <span class="flex items-center justify-center">
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span class="btn-text">Actualizar Usuario</span>
                                    <svg class="h-4 w-4 ml-2 loading-spinner hidden animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar usuario -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-2xl bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Eliminar Usuario</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    ¿Estás seguro de que deseas eliminar al usuario <strong>{{ $usuario->nombre }}</strong>? Esta acción no se puede deshacer.
                </p>
            </div>
            <div class="items-center px-4 py-3 space-x-4 flex justify-center">
                <button id="cancelDelete" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-xl w-24 hover:bg-gray-600 transition-colors">
                    Cancelar
                </button>
                <button id="confirmDelete" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-xl w-24 hover:bg-red-600 transition-colors">
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editUserForm');
    const submitBtn = document.getElementById('submitBtn');
    const nameInput = document.getElementById('nombre');
    const emailInput = document.getElementById('email');
    const roleSelect = document.getElementById('rol');
    const passwordInput = document.getElementById('password');
    const deleteModal = document.getElementById('deleteModal');
    
    // Validación en tiempo real
    nameInput.addEventListener('input', validateName);
    emailInput.addEventListener('input', validateEmail);
    roleSelect.addEventListener('change', validateRole);
    passwordInput.addEventListener('input', validatePassword);
    
    // Mostrar descripción del rol al cargar la página
    if (roleSelect.value) {
        showRoleDescription(roleSelect.value);
    }
    
    // Mostrar descripción del rol
    roleSelect.addEventListener('change', function() {
        showRoleDescription(this.value);
    });
    
    function showRoleDescription(role) {
        const description = roleSelect.parentElement.querySelector('.role-description');
        const descriptions = {
            'admin': 'Los administradores tienen acceso completo al sistema y pueden gestionar todos los usuarios y configuraciones.',
            'fundacion': 'Las fundaciones pueden gestionar sus propios animales, adopciones y contenido relacionado.'
        };
        
        if (role && descriptions[role]) {
            description.textContent = descriptions[role];
            description.classList.remove('hidden');
        } else {
            description.classList.add('hidden');
        }
    }
    
    // Validaciones individuales
    function validateName() {
        const value = nameInput.value.trim();
        const group = nameInput.closest('.form-group');
        const message = group.querySelector('.validation-message');
        
        if (value.length < 2) {
            showValidationError(group, message, 'El nombre debe tener al menos 2 caracteres');
            return false;
        } else if (value.length > 50) {
            showValidationError(group, message, 'El nombre no puede exceder 50 caracteres');
            return false;
        } else {
            showValidationSuccess(group, message, 'Nombre válido');
            return true;
        }
    }
    
    function validateEmail() {
        const value = emailInput.value.trim();
        const group = emailInput.closest('.form-group');
        const message = group.querySelector('.validation-message');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!emailRegex.test(value)) {
            showValidationError(group, message, 'Ingresa un correo electrónico válido');
            return false;
        } else {
            showValidationSuccess(group, message, 'Correo electrónico válido');
            return true;
        }
    }
    
    function validateRole() {
        const value = roleSelect.value;
        const group = roleSelect.closest('.form-group');
        const message = group.querySelector('.validation-message');
        
        if (!value) {
            showValidationError(group, message, 'Selecciona un rol para el usuario');
            return false;
        } else {
            showValidationSuccess(group, message, 'Rol seleccionado');
            return true;
        }
    }
    
    function validatePassword() {
        const value = passwordInput.value;
        const group = passwordInput.closest('.form-group');
        const message = group.querySelector('.validation-message');
        const strengthContainer = group.querySelector('.password-strength');
        
        // Si no hay contraseña, es válido (opcional)
        if (value.length === 0) {
            if (strengthContainer) strengthContainer.classList.add('hidden');
            hideValidationMessage(group, message);
            return true;
        }
        
        // Mostrar indicador de fortaleza
        if (strengthContainer) {
            strengthContainer.classList.remove('hidden');
            updatePasswordStrength(value);
        }
        
        if (value.length < 8) {
            showValidationError(group, message, 'La contraseña debe tener al menos 8 caracteres');
            return false;
        } else {
            const strength = calculatePasswordStrength(value);
            if (strength < 3) {
                showValidationWarning(group, message, 'Contraseña débil. Considera agregar mayúsculas y números.');
                return true; // Permitir contraseñas débiles pero advertir
            } else {
                showValidationSuccess(group, message, 'Contraseña segura');
                return true;
            }
        }
    }
    
    function calculatePasswordStrength(password) {
        let strength = 0;
        
        // Longitud
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        
        // Mayúsculas
        if (/[A-Z]/.test(password)) strength++;
        
        // Números
        if (/[0-9]/.test(password)) strength++;
        
        // Caracteres especiales
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        
        return strength;
    }
    
    function updatePasswordStrength(password) {
        const strength = calculatePasswordStrength(password);
        const strengthBar = document.querySelector('.strength-bar');
        const strengthText = document.querySelector('.strength-text');
        
        if (!strengthBar || !strengthText) return;
        
        // Actualizar barra de progreso
        const percentage = (strength / 5) * 100;
        strengthBar.style.width = percentage + '%';
        
        // Colores y texto según fortaleza
        if (strength <= 2) {
            strengthBar.className = 'strength-bar h-2 rounded-full transition-all duration-300 bg-red-500';
            strengthText.textContent = 'Débil';
            strengthText.className = 'strength-text text-xs font-medium text-red-600';
        } else if (strength <= 3) {
            strengthBar.className = 'strength-bar h-2 rounded-full transition-all duration-300 bg-yellow-500';
            strengthText.textContent = 'Media';
            strengthText.className = 'strength-text text-xs font-medium text-yellow-600';
        } else {
            strengthBar.className = 'strength-bar h-2 rounded-full transition-all duration-300 bg-green-500';
            strengthText.textContent = 'Fuerte';
            strengthText.className = 'strength-text text-xs font-medium text-green-600';
        }
        
        // Actualizar requisitos
        updateRequirement('length', password.length >= 8);
        updateRequirement('uppercase', /[A-Z]/.test(password));
        updateRequirement('number', /[0-9]/.test(password));
    }
    
    function updateRequirement(type, met) {
        const requirement = document.querySelector(`[data-requirement="${type}"]`);
        if (!requirement) return;
        
        const icon = requirement.querySelector('svg');
        const text = requirement.querySelector('span');
        
        if (met) {
            icon.className = 'h-3 w-3 mr-2 text-green-500';
            text.className = 'text-green-700 line-through';
        } else {
            icon.className = 'h-3 w-3 mr-2 text-gray-400';
            text.className = 'text-gray-600';
        }
    }
    
    function showValidationError(group, message, text) {
        const input = group.querySelector('input, select');
        input.classList.remove('border-green-300', 'focus:ring-green-500', 'focus:border-green-500', 'border-yellow-300', 'focus:ring-yellow-500', 'focus:border-yellow-500');
        input.classList.add('border-red-300', 'focus:ring-red-500', 'focus:border-red-500');
        
        message.textContent = text;
        message.className = 'validation-message text-sm mt-1 text-red-600';
        message.classList.remove('hidden');
    }
    
    function showValidationSuccess(group, message, text) {
        const input = group.querySelector('input, select');
        input.classList.remove('border-red-300', 'focus:ring-red-500', 'focus:border-red-500', 'border-yellow-300', 'focus:ring-yellow-500', 'focus:border-yellow-500');
        input.classList.add('border-green-300', 'focus:ring-green-500', 'focus:border-green-500');
        
        message.textContent = text;
        message.className = 'validation-message text-sm mt-1 text-green-600';
        message.classList.remove('hidden');
    }
    
    function showValidationWarning(group, message, text) {
        const input = group.querySelector('input, select');
        input.classList.remove('border-red-300', 'focus:ring-red-500', 'focus:border-red-500', 'border-green-300', 'focus:ring-green-500', 'focus:border-green-500');
        input.classList.add('border-yellow-300', 'focus:ring-yellow-500', 'focus:border-yellow-500');
        
        message.textContent = text;
        message.className = 'validation-message text-sm mt-1 text-yellow-600';
        message.classList.remove('hidden');
    }
    
    function hideValidationMessage(group, message) {
        const input = group.querySelector('input, select');
        input.classList.remove('border-red-300', 'focus:ring-red-500', 'focus:border-red-500', 'border-green-300', 'focus:ring-green-500', 'focus:border-green-500', 'border-yellow-300', 'focus:ring-yellow-500', 'focus:border-yellow-500');
        message.classList.add('hidden');
    }
    
    // Validación del formulario completo
    function validateForm() {
        const validations = [
            validateName(),
            validateEmail(),
            validateRole(),
            validatePassword()
        ];
        
        return validations.every(validation => validation === true);
    }
    
    // Envío del formulario
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            // Mostrar estado de carga
            submitBtn.disabled = true;
            submitBtn.querySelector('.btn-text').textContent = 'Actualizando...';
            const spinner = submitBtn.querySelector('.loading-spinner');
            if (spinner) spinner.classList.remove('hidden');
            
            // Enviar formulario
            setTimeout(() => {
                this.submit();
            }, 500);
        } else {
            // Scroll al primer error
            const firstError = document.querySelector('.border-red-300');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }
    });
    
    // Modal de eliminación
    const cancelDelete = document.getElementById('cancelDelete');
    const confirmDelete = document.getElementById('confirmDelete');
    
    if (cancelDelete) {
        cancelDelete.addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });
    }
    
    if (confirmDelete) {
        confirmDelete.addEventListener('click', function() {
            // Crear formulario para eliminar
            const deleteForm = document.createElement('form');
            deleteForm.method = 'POST';
            deleteForm.action = '{{ route("admin.usuarios.eliminar", $usuario->id) }}';
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            deleteForm.appendChild(csrfToken);
            deleteForm.appendChild(methodField);
            document.body.appendChild(deleteForm);
            deleteForm.submit();
        });
    }
});

// Función para mostrar/ocultar contraseña
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const button = input.nextElementSibling;
    const icon = button.querySelector('svg');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />';
    } else {
        input.type = 'password';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
    }
}

// Función para eliminar usuario
function deleteUser() {
    document.getElementById('deleteModal').classList.remove('hidden');
}

// Función para generar contraseña temporal
function resetPassword() {
    if (confirm('¿Generar una contraseña temporal para este usuario? Se enviará por correo electrónico.')) {
        // Aquí iría la lógica para generar contraseña temporal
        alert('Funcionalidad en desarrollo: Generar contraseña temporal');
    }
}

// Función para enviar enlace de restablecimiento
function sendPasswordReset() {
    if (confirm('¿Enviar un enlace de restablecimiento de contraseña al usuario?')) {
        // Aquí iría la lógica para enviar enlace de restablecimiento
        alert('Funcionalidad en desarrollo: Enviar enlace de restablecimiento');
    }
}
</script>
@endsection
