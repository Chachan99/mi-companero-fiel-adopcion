@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Encabezado mejorado con gradiente -->
        <div class="mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 p-3 rounded-xl">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Gestión de Usuarios</h1>
                            <nav class="flex mt-2" aria-label="Breadcrumb">
                                <ol class="inline-flex items-center space-x-1 text-sm">
                                    <li class="inline-flex items-center">
                                        <a href="{{ route('admin.dashboard') }}" class="text-emerald-600 hover:text-emerald-800 font-medium transition-colors">
                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                                            </svg>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <span class="mx-2 text-gray-400">/</span>
                                    </li>
                                    <li class="inline-flex items-center text-gray-600 font-medium">
                                        Usuarios
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    
                    <!-- Botones de acción mejorados -->
                    <div class="flex flex-wrap gap-3">
                        <button onclick="exportUsers()" class="bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Exportar
                        </button>
                        <a href="{{ route('admin.usuarios.crear') }}" 
                           class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Nuevo Usuario
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alertas mejoradas con animación -->
        @if(session('success'))
            <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl shadow-lg animate-pulse" x-data="{ show: true }" x-show="show" x-transition>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-emerald-100 p-2 rounded-full">
                                <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button @click="show = false" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Filtros y búsqueda avanzada -->
        <div class="mb-6 bg-white rounded-xl shadow-lg border border-gray-100">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Búsqueda -->
                    <div class="flex-1 max-w-md">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" id="searchUsers" placeholder="Buscar usuarios por nombre o email..." 
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                        </div>
                    </div>
                    
                    <!-- Filtros y Acciones -->
                    <div class="flex flex-wrap gap-3">
                        <select id="roleFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white">
                            <option value="">Todos los roles</option>
                            <option value="admin">Administradores</option>
                            <option value="fundacion">Fundaciones</option>
                            <option value="publico">Público</option>
                        </select>
                        
                        <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white">
                            <option value="">Todos los estados</option>
                            <option value="1">Activos</option>
                            <option value="0">Inactivos</option>
                        </select>
                        
                        <select id="dateFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white">
                            <option value="">Todas las fechas</option>
                            <option value="today">Hoy</option>
                            <option value="week">Esta semana</option>
                            <option value="month">Este mes</option>
                            <option value="year">Este año</option>
                        </select>
                        
                        <button onclick="clearFilters()" class="px-4 py-2 text-gray-600 hover:text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="h-5 w-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Limpiar
                        </button>
                        
                        <!-- Separador -->
                        <div class="border-l border-gray-300 h-10"></div>
                        
                        <!-- Botones de acción -->
                        <button onclick="exportUsers()" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Exportar CSV
                        </button>
                        
                        <button onclick="showUserStats()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Estadísticas
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjetas de resumen mejoradas con animaciones -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-white to-blue-50 rounded-xl shadow-lg p-6 border border-blue-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Usuarios</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 counter" data-target="{{ $total_usuarios }}">0</p>
                        <div class="mt-2 flex items-center text-sm">
                            <span class="text-green-600 font-medium">+12%</span>
                            <span class="text-gray-500 ml-1">vs mes anterior</span>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-4 rounded-xl shadow-lg">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 8a3 3 0 100-6 3 3 0 000 6z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-white to-emerald-50 rounded-xl shadow-lg p-6 border border-emerald-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Administradores</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 counter" data-target="{{ $total_admins }}">0</p>
                        <div class="mt-2 flex items-center text-sm">
                            <span class="text-emerald-600 font-medium">Activos</span>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-4 rounded-xl shadow-lg">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-white to-purple-50 rounded-xl shadow-lg p-6 border border-purple-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Fundaciones</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 counter" data-target="{{ $total_fundaciones }}">0</p>
                        <div class="mt-2 flex items-center text-sm">
                            <span class="text-purple-600 font-medium">Verificadas</span>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-4 rounded-xl shadow-lg">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-white to-cyan-50 rounded-xl shadow-lg p-6 border border-cyan-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Nuevos (30d)</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 counter" data-target="8">0</p>
                        <div class="mt-2 flex items-center text-sm">
                            <span class="text-cyan-600 font-medium">Este mes</span>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-cyan-500 to-cyan-600 p-4 rounded-xl shadow-lg">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de usuarios mejorada -->
        <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-100">
            <!-- Header de la tabla con acciones en lote -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <input type="checkbox" id="selectAll" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                        <label for="selectAll" class="text-sm font-medium text-gray-700">Seleccionar todos</label>
                        <span id="selectedCount" class="text-sm text-gray-500">0 seleccionados</span>
                    </div>
                    <div id="bulkActions" class="hidden flex items-center space-x-2">
                        <button onclick="bulkDelete()" class="px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-sm flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Eliminar seleccionados
                        </button>
                        <button onclick="bulkChangeRole()" class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Cambiar rol
                        </button>
                        <button onclick="bulkToggleStatus()" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition-colors text-sm flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                            Cambiar estado
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="usersTable">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <span>Usuario</span>
                                    <svg class="h-4 w-4 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <span>Email</span>
                                    <svg class="h-4 w-4 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <span>Rol</span>
                                    <svg class="h-4 w-4 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fundación</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <span>Registro</span>
                                    <svg class="h-4 w-4 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Estado</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100" id="usersTableBody">
                        @forelse($usuarios as $usuario)
                        <tr class="hover:bg-gradient-to-r hover:from-gray-50 hover:to-blue-50 transition-all duration-200 user-row" data-user-id="{{ $usuario->id }}" data-role="{{ $usuario->rol }}" data-email="{{ $usuario->email }}" data-name="{{ $usuario->nombre }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" class="user-checkbox h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded" value="{{ $usuario->id }}">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12 relative">
                                            @if($usuario->foto_perfil)
                                                <img class="h-12 w-12 rounded-full object-cover ring-2 ring-gray-200" src="{{ asset('fundaciones/' . ltrim($usuario->foto_perfil, '/')) }}" alt="{{ $usuario->nombre }}">
                                            @else
                                                <div class="h-12 w-12 flex items-center justify-center bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full ring-2 ring-gray-200">
                                                    <span class="text-white font-bold text-lg">{{ strtoupper(substr($usuario->nombre, 0, 1)) }}</span>
                                                </div>
                                            @endif
                                            <div class="absolute -bottom-1 -right-1 h-4 w-4 bg-green-400 border-2 border-white rounded-full"></div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">{{ $usuario->nombre }}</div>
                                            <div class="text-xs text-gray-500">ID: {{ $usuario->id }}</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <svg class="h-4 w-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                    <div class="text-sm text-gray-900 font-medium">{{ $usuario->email }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    @if($usuario->rol === 'admin') bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 
                                    @elseif($usuario->rol === 'fundacion') bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800
                                    @else bg-gradient-to-r from-green-100 to-green-200 text-green-800 @endif">
                                    @if($usuario->rol === 'admin')
                                        <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    @elseif($usuario->rol === 'fundacion')
                                        <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    @else
                                        <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    @endif
                                    {{ ucfirst($usuario->rol) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($usuario->perfilFundacion)
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="h-4 w-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $usuario->perfilFundacion->nombre }}</div>
                                            <div class="text-xs text-gray-500">Fundación verificada</div>
                                        </div>
                                    </div>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-500">
                                        <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                        Sin fundación
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <svg class="h-4 w-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10m6-10v10m-6-4h6" />
                                    </svg>
                                    <div>
                                        <div class="text-sm text-gray-900 font-medium">{{ $usuario->created_at->format('d/m/Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $usuario->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <div class="h-2 w-2 bg-green-400 rounded-full mr-1 animate-pulse"></div>
                                    Activo
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <div class="relative inline-block text-left" x-data="{ open: false }">
                                        <button @click="open = !open" class="inline-flex items-center p-2 text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 rounded-full hover:bg-gray-100 transition-all duration-200">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                        </button>
                                        <div x-show="open" @click.away="open = false" x-transition class="origin-top-right absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                            <div class="py-1">
                                                <a href="{{ route('admin.usuarios.editar', $usuario->id) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-800 transition-colors">
                                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Editar usuario
                                                </a>
                                                <button onclick="viewUserDetails({{ $usuario->id }})" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800 transition-colors">
                                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Ver detalles
                                                </button>
                                                <button onclick="resetPassword({{ $usuario->id }})" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-800 transition-colors">
                                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                                    </svg>
                                                    Resetear contraseña
                                                </button>
                                                <div class="border-t border-gray-100"></div>
                                                <form action="{{ route('admin.usuarios.eliminar', $usuario->id) }}" method="POST" class="inline w-full">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.')" class="flex items-center w-full px-4 py-2 text-sm text-red-700 hover:bg-red-50 hover:text-red-800 transition-colors">
                                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Eliminar usuario
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 8a3 3 0 100-6 3 3 0 000 6z" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No hay usuarios registrados</h3>
                                    <p class="text-gray-500 mb-4">Comienza creando tu primer usuario del sistema.</p>
                                    <a href="{{ route('admin.usuarios.crear') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg transition-colors">
                                        Crear primer usuario
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación mejorada -->
            @if($usuarios->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-4 md:mb-0">
                        <p class="text-sm text-gray-700">
                            Mostrando
                            <span class="font-medium">{{ $usuarios->firstItem() }}</span>
                            a
                            <span class="font-medium">{{ $usuarios->lastItem() }}</span>
                            de
                            <span class="font-medium">{{ $usuarios->total() }}</span>
                            resultados
                        </p>
                    </div>
                    <div class="flex-1 flex justify-between md:justify-end">
                        @if($usuarios->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-white cursor-not-allowed">
                            Anterior
                        </span>
                        @else
                        <a href="{{ $usuarios->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Anterior
                        </a>
                        @endif

                        @if($usuarios->hasMorePages())
                        <a href="{{ $usuarios->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Siguiente
                        </a>
                        @else
                        <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-white cursor-not-allowed">
                            Siguiente
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal de detalles de usuario -->
<div id="userDetailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-10 mx-auto p-5 border max-w-2xl shadow-lg rounded-xl bg-white">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900">Detalles del Usuario</h3>
            <button onclick="closeUserDetailsModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="userDetailsContent">
            <!-- Contenido dinámico -->
        </div>
    </div>
</div>

<!-- Modal de estadísticas -->
<div id="statsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-5 mx-auto p-5 border max-w-6xl shadow-lg rounded-xl bg-white">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-900">Estadísticas Detalladas de Usuarios</h3>
            <button onclick="closeStatsModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="statsContent">
            <div class="animate-pulse">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="h-32 bg-gray-200 rounded-lg"></div>
                    <div class="h-32 bg-gray-200 rounded-lg"></div>
                    <div class="h-32 bg-gray-200 rounded-lg"></div>
                </div>
                <div class="h-64 bg-gray-200 rounded-lg"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de acciones en lote -->
<div id="bulkActionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border max-w-md shadow-lg rounded-xl bg-white">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900" id="bulkActionTitle">Acción en Lote</h3>
            <button onclick="closeBulkActionModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="bulkActionContent">
            <!-- Contenido dinámico -->
        </div>
        <div class="flex justify-end space-x-3 mt-6">
            <button onclick="closeBulkActionModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancelar
            </button>
            <button id="confirmBulkAction" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Confirmar
            </button>
        </div>
    </div>
</div>

<!-- Modal de confirmación con Alpine.js -->
<div x-data="{ showModal: false, userId: null }" x-cloak>
    <!-- Modal backdrop -->
    <div x-show="showModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
            <div class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Eliminar usuario
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                ¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <form :action="`/admin/usuarios/${userId}/eliminar`" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Eliminar
                        </button>
                    </form>
                    <button @click="showModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Funcionalidades interactivas
document.addEventListener('DOMContentLoaded', function() {
    // Contador animado para las tarjetas de estadísticas
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const increment = target / 50;
        let current = 0;
        
        const updateCounter = () => {
            if (current < target) {
                current += increment;
                counter.textContent = Math.ceil(current);
                setTimeout(updateCounter, 30);
            } else {
                counter.textContent = target;
            }
        };
        
        updateCounter();
    });
    
    // Funcionalidad de búsqueda en tiempo real
    const searchInput = document.getElementById('searchUsers');
    const roleFilter = document.getElementById('roleFilter');
    const statusFilter = document.getElementById('statusFilter');
    const dateFilter = document.getElementById('dateFilter');
    const userRows = document.querySelectorAll('.user-row');
    
    function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedRole = roleFilter.value;
        const selectedStatus = statusFilter.value;
        const selectedDate = dateFilter.value;
        
        userRows.forEach(row => {
            const name = row.getAttribute('data-name').toLowerCase();
            const email = row.getAttribute('data-email').toLowerCase();
            const role = row.getAttribute('data-role');
            
            const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
            const matchesRole = !selectedRole || role === selectedRole;
            const matchesStatus = !selectedStatus; // Por ahora, ya que no tenemos el atributo en el HTML
            
            if (matchesSearch && matchesRole && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        updateResultsCount();
    }
    
    function updateResultsCount() {
        const visibleRows = document.querySelectorAll('.user-row:not([style*="display: none"])');
        const totalRows = userRows.length;
        
        // Aquí podrías agregar un contador de resultados si lo deseas
        console.log(`Mostrando ${visibleRows.length} de ${totalRows} usuarios`);
    }
    
    searchInput.addEventListener('input', filterUsers);
    roleFilter.addEventListener('change', filterUsers);
    statusFilter.addEventListener('change', filterUsers);
    dateFilter.addEventListener('change', filterUsers);
    
    // Funcionalidad de selección múltiple
    const selectAllCheckbox = document.getElementById('selectAll');
    const userCheckboxes = document.querySelectorAll('.user-checkbox');
    const selectedCount = document.getElementById('selectedCount');
    const bulkActions = document.getElementById('bulkActions');
    
    function updateSelectedCount() {
        const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
        const count = checkedBoxes.length;
        
        selectedCount.textContent = `${count} seleccionados`;
        
        if (count > 0) {
            bulkActions.classList.remove('hidden');
        } else {
            bulkActions.classList.add('hidden');
        }
        
        selectAllCheckbox.indeterminate = count > 0 && count < userCheckboxes.length;
        selectAllCheckbox.checked = count === userCheckboxes.length;
    }
    
    selectAllCheckbox.addEventListener('change', function() {
        userCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateSelectedCount();
    });
    
    userCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });
});

// Funciones globales
function clearFilters() {
    document.getElementById('searchUsers').value = '';
    document.getElementById('roleFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('dateFilter').value = '';
    
    // Mostrar todas las filas
    document.querySelectorAll('.user-row').forEach(row => {
        row.style.display = '';
    });
}

function exportUsers() {
    // Obtener filtros actuales
    const searchTerm = document.getElementById('searchUsers').value;
    const roleFilter = document.getElementById('roleFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;
    const dateFilter = document.getElementById('dateFilter').value;
    
    // Construir URL con parámetros
    const params = new URLSearchParams();
    if (searchTerm) params.append('search', searchTerm);
    if (roleFilter) params.append('role', roleFilter);
    if (statusFilter) params.append('status', statusFilter);
    if (dateFilter) params.append('date', dateFilter);
    
    // Redirigir a la ruta de exportación
    window.location.href = `/admin/usuarios/exportar?${params.toString()}`;
}

function showUserStats() {
    const modal = document.getElementById('statsModal');
    const content = document.getElementById('statsContent');
    
    modal.classList.remove('hidden');
    
    // Hacer petición AJAX para obtener estadísticas
    fetch('/admin/usuarios/estadisticas')
        .then(response => response.json())
        .then(data => {
            content.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-blue-600">Total Usuarios</p>
                                <p class="text-3xl font-bold text-blue-900">${data.total_usuarios}</p>
                            </div>
                            <div class="bg-blue-500 p-3 rounded-lg">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 8a3 3 0 100-6 3 3 0 000 6z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-green-600">Usuarios Activos</p>
                                <p class="text-3xl font-bold text-green-900">${data.usuarios_activos}</p>
                            </div>
                            <div class="bg-green-500 p-3 rounded-lg">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl border border-purple-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-purple-600">Administradores</p>
                                <p class="text-3xl font-bold text-purple-900">${data.total_admins}</p>
                            </div>
                            <div class="bg-purple-500 p-3 rounded-lg">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-cyan-50 to-cyan-100 p-6 rounded-xl border border-cyan-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-cyan-600">Fundaciones</p>
                                <p class="text-3xl font-bold text-cyan-900">${data.total_fundaciones}</p>
                            </div>
                            <div class="bg-cyan-500 p-3 rounded-lg">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-xl border border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Registros por Mes</h4>
                        <div class="space-y-3">
                            ${data.registros_por_mes.map(item => `
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">${item.mes}</span>
                                    <div class="flex items-center">
                                        <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                            <div class="bg-blue-500 h-2 rounded-full" style="width: ${(item.total / Math.max(...data.registros_por_mes.map(m => m.total))) * 100}%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">${item.total}</span>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl border border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Distribución por Roles</h4>
                        <div class="space-y-4">
                            ${data.distribucion_roles.map(role => `
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 rounded-full mr-3 ${
                                            role.rol === 'admin' ? 'bg-blue-500' : 
                                            role.rol === 'fundacion' ? 'bg-purple-500' : 'bg-green-500'
                                        }"></div>
                                        <span class="text-sm text-gray-600 capitalize">${role.rol}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-sm font-medium text-gray-900">${role.total}</span>
                                        <span class="text-xs text-gray-500 ml-1">(${((role.total / data.total_usuarios) * 100).toFixed(1)}%)</span>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </div>
            `;
        })
        .catch(error => {
            console.error('Error:', error);
            content.innerHTML = `
                <div class="text-center py-8">
                    <div class="text-red-500 mb-2">
                        <svg class="h-12 w-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-600">Error al cargar las estadísticas</p>
                </div>
            `;
        });
}

function closeStatsModal() {
    document.getElementById('statsModal').classList.add('hidden');
}

function viewUserDetails(userId) {
    // Implementar modal de detalles
    const modal = document.getElementById('userDetailsModal');
    const content = document.getElementById('userDetailsContent');
    
    content.innerHTML = `
        <div class="animate-pulse">
            <div class="h-4 bg-gray-200 rounded w-3/4 mb-4"></div>
            <div class="h-4 bg-gray-200 rounded w-1/2 mb-4"></div>
            <div class="h-4 bg-gray-200 rounded w-5/6"></div>
        </div>
    `;
    
    modal.classList.remove('hidden');
    
    // Aquí harías una petición AJAX para obtener los detalles del usuario
    setTimeout(() => {
        content.innerHTML = `
            <div class="space-y-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-900 mb-2">Información básica</h4>
                    <p><strong>ID:</strong> ${userId}</p>
                    <p><strong>Estado:</strong> <span class="text-green-600">Activo</span></p>
                    <p><strong>Último acceso:</strong> Hace 2 días</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-900 mb-2">Actividad reciente</h4>
                    <p class="text-sm text-gray-600">Sin actividad reciente registrada</p>
                </div>
            </div>
        `;
    }, 1000);
}

function closeUserDetailsModal() {
    document.getElementById('userDetailsModal').classList.add('hidden');
}

function resetPassword(userId) {
    if (confirm('¿Estás seguro de que deseas resetear la contraseña de este usuario?')) {
        alert('Funcionalidad de reseteo de contraseña en desarrollo');
    }
}

function confirmDelete(userId) {
    return {
        showModal: false,
        userId: userId,
        openModal(id) {
            this.userId = id;
            this.showModal = true;
        },
        deleteUser() {
            // Lógica para eliminar el usuario
            this.showModal = false;
        }
    }
}

// Funciones de acciones en lote
function bulkDelete() {
    const selectedUsers = getSelectedUsers();
    if (selectedUsers.length === 0) {
        alert('Por favor selecciona al menos un usuario');
        return;
    }
    
    if (confirm(`¿Estás seguro de eliminar ${selectedUsers.length} usuario(s)? Esta acción no se puede deshacer.`)) {
        performBulkAction('delete', selectedUsers);
    }
}

function bulkChangeRole() {
    const selectedUsers = getSelectedUsers();
    if (selectedUsers.length === 0) {
        alert('Por favor selecciona al menos un usuario');
        return;
    }
    
    showBulkActionModal('Cambiar Rol', `
        <p class="text-gray-600 mb-4">Selecciona el nuevo rol para ${selectedUsers.length} usuario(s):</p>
        <select id="newRole" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <option value="">Seleccionar rol...</option>
            <option value="admin">Administrador</option>
            <option value="fundacion">Fundación</option>
            <option value="publico">Público</option>
        </select>
    `, () => {
        const newRole = document.getElementById('newRole').value;
        if (!newRole) {
            alert('Por favor selecciona un rol');
            return;
        }
        performBulkAction('change_role', selectedUsers, { role: newRole });
    });
}

function bulkToggleStatus() {
    const selectedUsers = getSelectedUsers();
    if (selectedUsers.length === 0) {
        alert('Por favor selecciona al menos un usuario');
        return;
    }
    
    showBulkActionModal('Cambiar Estado', `
        <p class="text-gray-600 mb-4">Selecciona la acción para ${selectedUsers.length} usuario(s):</p>
        <select id="statusAction" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <option value="">Seleccionar acción...</option>
            <option value="activate">Activar usuarios</option>
            <option value="deactivate">Desactivar usuarios</option>
        </select>
    `, () => {
        const action = document.getElementById('statusAction').value;
        if (!action) {
            alert('Por favor selecciona una acción');
            return;
        }
        performBulkAction('toggle_status', selectedUsers, { action: action });
    });
}

function getSelectedUsers() {
    const checkboxes = document.querySelectorAll('.user-checkbox:checked');
    return Array.from(checkboxes).map(cb => cb.value);
}

function showBulkActionModal(title, content, onConfirm) {
    const modal = document.getElementById('bulkActionModal');
    const titleEl = document.getElementById('bulkActionTitle');
    const contentEl = document.getElementById('bulkActionContent');
    const confirmBtn = document.getElementById('confirmBulkAction');
    
    titleEl.textContent = title;
    contentEl.innerHTML = content;
    
    // Remover listeners anteriores
    const newConfirmBtn = confirmBtn.cloneNode(true);
    confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
    
    newConfirmBtn.addEventListener('click', () => {
        onConfirm();
        closeBulkActionModal();
    });
    
    modal.classList.remove('hidden');
}

function closeBulkActionModal() {
    document.getElementById('bulkActionModal').classList.add('hidden');
}

function performBulkAction(action, userIds, params = {}) {
    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    formData.append('action', action);
    formData.append('user_ids', JSON.stringify(userIds));
    
    // Agregar parámetros adicionales
    Object.keys(params).forEach(key => {
        formData.append(key, params[key]);
    });
    
    fetch('/admin/usuarios/acciones-lote', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message || 'Acción completada exitosamente');
            location.reload(); // Recargar la página para ver los cambios
        } else {
            alert(data.message || 'Error al realizar la acción');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al realizar la acción');
    });
}
</script>
@endsection
