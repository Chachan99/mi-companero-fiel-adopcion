<nav class="bg-white/95 backdrop-blur-md border-b border-gray-200/50 shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
           
            <!-- Logo e Identidad -->
            <div class="flex items-center space-x-3 flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                    <!-- Logo Mi Compañero Fiel -->
                    <div class="relative">
                        <img src="{{ asset('img/logo-mi-companero-fiel.svg') }}" alt="Mi Compañero Fiel" class="w-10 h-10 transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-emerald-500/20 rounded-full scale-0 group-hover:scale-110 transition-transform duration-300"></div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold text-gray-900 tracking-tight leading-none">
                            Mi Compañero Fiel
                        </span>
                        <span class="text-xs text-emerald-600 font-medium tracking-wide">
                            Adopción responsable
                        </span>
                    </div>
                </a>
            </div>

            <!-- Enlaces de navegación (desktop) - Diseño moderno -->
            <div class="hidden md:flex items-center space-x-8">
                @php 
                    $isAdmin = Auth::check() && Auth::user()?->rol === 'admin'; 
                    $isFundacion = Auth::check() && Auth::user()?->rol === 'fundacion'; 
                @endphp
                
                @if(!$isAdmin && !$isFundacion)
                <a href="{{ route('publico.index') }}" class="relative group px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('publico.index') ? 'text-emerald-600' : 'text-gray-700 hover:text-emerald-600' }}">
                    <span class="flex items-center space-x-2">
                        <i class="fas fa-home text-xs"></i>
                        <span>Inicio</span>
                    </span>
                    @if(request()->routeIs('publico.index'))
                    <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full"></div>
                    @else
                    <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                    @endif
                </a>
                <a href="{{ route('publico.buscar') }}" class="relative group px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('publico.buscar') ? 'text-emerald-600' : 'text-gray-700 hover:text-emerald-600' }}">
                    <span class="flex items-center space-x-2">
                        <i class="fas fa-heart text-xs"></i>
                        <span>¡Adopta!</span>
                    </span>
                    @if(request()->routeIs('publico.buscar'))
                    <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full"></div>
                    @else
                    <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                    @endif
                </a>
                <a href="{{ route('publico.nosotros') }}" class="relative group px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('publico.nosotros') ? 'text-emerald-600' : 'text-gray-700 hover:text-emerald-600' }}">
                    <span class="flex items-center space-x-2">
                        <i class="fas fa-users text-xs"></i>
                        <span>Nosotros</span>
                    </span>
                    @if(request()->routeIs('publico.nosotros'))
                    <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full"></div>
                    @else
                    <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                    @endif
                </a>
                <a href="{{ route('noticias.index') }}" class="relative group px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('noticias.*') ? 'text-emerald-600' : 'text-gray-700 hover:text-emerald-600' }}">
                    <span class="flex items-center space-x-2">
                        <i class="fas fa-newspaper text-xs"></i>
                        <span>Noticias</span>
                    </span>
                    @if(request()->routeIs('noticias.*'))
                    <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full"></div>
                    @else
                    <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                    @endif
                </a>
                <a href="{{ route('publico.donaciones') }}" class="relative group px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('publico.donaciones') ? 'text-emerald-600' : 'text-gray-700 hover:text-emerald-600' }}">
                    <span class="flex items-center space-x-2">
                        <i class="fas fa-hand-holding-heart text-xs"></i>
                        <span>Donaciones</span>
                    </span>
                    @if(request()->routeIs('publico.donaciones'))
                    <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full"></div>
                    @else
                    <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                    @endif
                </a>
                <a href="{{ route('animales-perdidos.index') }}" class="relative group px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('animales-perdidos.*') ? 'text-emerald-600' : 'text-gray-700 hover:text-emerald-600' }}">
                    <span class="flex items-center space-x-2">
                        <i class="fas fa-search-location text-xs"></i>
                        <span>Perdidos</span>
                    </span>
                    @if(request()->routeIs('animales-perdidos.*'))
                    <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full"></div>
                    @else
                    <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                    @endif
                </a>
                @endif
                
                @auth
                    @if(Auth::user()->rol === 'fundacion')
                        <a href="{{ route('fundacion.animales') }}" class="relative group px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('fundacion.animales') ? 'text-emerald-600' : 'text-gray-700 hover:text-emerald-600' }}">
                            <span class="flex items-center space-x-2">
                                <i class="fas fa-paw text-xs"></i>
                                <span>Mis Animales</span>
                            </span>
                            @if(request()->routeIs('fundacion.animales'))
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full"></div>
                            @else
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                            @endif
                        </a>
                        <a href="{{ route('fundacion.solicitudes') }}" class="relative group px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('fundacion.solicitudes') ? 'text-emerald-600' : 'text-gray-700 hover:text-emerald-600' }}">
                            <span class="flex items-center space-x-2">
                                <i class="fas fa-file-signature text-xs"></i>
                                <span>Solicitudes</span>
                            </span>
                            @if(request()->routeIs('fundacion.solicitudes'))
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full"></div>
                            @else
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                            @endif
                        </a>
                        <a href="{{ route('fundacion.noticias.index') }}" class="relative group px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('fundacion.noticias.*') ? 'text-emerald-600' : 'text-gray-700 hover:text-emerald-600' }}">
                            <span class="flex items-center space-x-2">
                                <i class="fas fa-newspaper text-xs"></i>
                                <span>Noticias</span>
                            </span>
                            @if(request()->routeIs('fundacion.noticias.*'))
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full"></div>
                            @else
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                            @endif
                        </a>
                    @elseif(Auth::user()->rol === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="relative group px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'text-emerald-600' : 'text-gray-700 hover:text-emerald-600' }}">
                            <span class="flex items-center space-x-2">
                                <i class="fas fa-tachometer-alt text-xs"></i>
                                <span>Panel</span>
                            </span>
                            @if(request()->routeIs('admin.dashboard'))
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full"></div>
                            @else
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                            @endif
                        </a>
                        <a href="{{ route('admin.usuarios') }}" class="relative group px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.usuarios') ? 'text-emerald-600' : 'text-gray-700 hover:text-emerald-600' }}">
                            <span class="flex items-center space-x-2">
                                <i class="fas fa-user-cog text-xs"></i>
                                <span>Usuarios</span>
                            </span>
                            @if(request()->routeIs('admin.usuarios'))
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full"></div>
                            @else
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                            @endif
                        </a>
                        <a href="{{ route('admin.solicitudes') }}" class="relative group px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.solicitudes') ? 'text-emerald-600' : 'text-gray-700 hover:text-emerald-600' }}">
                            <span class="flex items-center space-x-2">
                                <i class="fas fa-clipboard-list text-xs"></i>
                                <span>Solicitudes</span>
                            </span>
                            @if(request()->routeIs('admin.solicitudes'))
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full"></div>
                            @else
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                            @endif
                        </a>
                        <a href="{{ route('admin.mascotas-perdidas') }}" class="relative group px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.mascotas-perdidas*') ? 'text-emerald-600' : 'text-gray-700 hover:text-emerald-600' }}">
                            <span class="flex items-center space-x-2">
                                <i class="fas fa-search-location text-xs"></i>
                                <span>Mascotas Perdidas</span>
                            </span>
                            @if(request()->routeIs('admin.mascotas-perdidas*'))
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full"></div>
                            @else
                            <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-emerald-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                            @endif
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Botones de autenticación (desktop) - Diseño moderno -->
            <div class="hidden md:flex items-center space-x-3">
                @guest
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                        <i class="fas fa-sign-in-alt mr-2 text-xs"></i>
                        Iniciar Sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md border border-gray-300">
                            <i class="fas fa-user-plus mr-2 text-xs"></i>
                            Registrarse
                        </a>
                    @endif
                @else
                    <!-- Menú desplegable de usuario moderno -->
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" type="button" class="flex items-center space-x-3 focus:outline-none group">
                                <div class="relative">
                                    <div class="w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-semibold border-2 border-emerald-200 group-hover:border-emerald-300 transition-colors duration-200">
                                        {{ strtoupper(substr(Auth::user()->nombre ?? Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></div>
                                </div>
                                <span class="text-gray-700 font-medium group-hover:text-emerald-600 transition-colors duration-200 hidden lg:block">
                                    {{ Auth::user()->nombre ?? Auth::user()->name }}
                                </span>
                                <svg class="h-4 w-4 text-gray-500 transform transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" 
                                 x-transition:enter-start="opacity-0 translate-y-1" 
                                 x-transition:enter-end="opacity-100 translate-y-0" 
                                 x-transition:leave="transition ease-in duration-150" 
                                 x-transition:leave-start="opacity-100 translate-y-0" 
                                 x-transition:leave-end="opacity-0 translate-y-1"
                                 class="origin-top-right absolute right-0 mt-2 w-56 rounded-xl shadow-lg bg-white ring-1 ring-gray-200 z-50 overflow-hidden" 
                                 x-cloak>
                                <div class="py-2">
                                    @if(Auth::user()->rol === 'fundacion')
                                        <a href="{{ route('fundacion.perfil') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors duration-200">
                                            <i class="fas fa-user-circle mr-3 text-emerald-500"></i> Mi Perfil
                                        </a>
                                        <a href="{{ route('fundacion.perfil.editar') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors duration-200">
                                            <i class="fas fa-cog mr-3 text-emerald-500"></i> Editar Perfil
                                        </a>
                                    @else
                                        <a href="{{ route('profile.edit-publico') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors duration-200">
                                            <i class="fas fa-user-edit mr-3 text-emerald-500"></i> Editar Perfil
                                        </a>
                                    @endif
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left flex items-center px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-700 transition-colors duration-200">
                                            <i class="fas fa-sign-out-alt mr-3 text-red-500"></i> Cerrar Sesión
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth
                @endguest
            </div>

            <!-- Menú hamburguesa para móvil - Moderno -->
            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 focus:outline-none focus:bg-emerald-50 focus:text-emerald-600 transition duration-200 ease-in-out">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="{ 'hidden': mobileMenuOpen, 'block': !mobileMenuOpen }">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="{ 'hidden': !mobileMenuOpen, 'block': mobileMenuOpen }">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menú móvil desplegable moderno -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-5" 
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-5"
             class="md:hidden absolute top-16 sm:top-20 left-0 right-0 bg-white shadow-lg border-t border-gray-200 z-40 overflow-hidden max-h-screen overflow-y-auto"
             x-cloak
             @click.away="mobileMenuOpen = false">
            <div class="px-4 pt-4 pb-6 space-y-1">
                @php
                    $isAdmin = Auth::check() && Auth::user()?->rol === 'admin';
                    $isFundacion = Auth::check() && Auth::user()?->rol === 'fundacion';
                @endphp
                
                @if(!$isAdmin && !$isFundacion)
                <a href="{{ route('publico.index') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 transition-all duration-200 font-medium border-l-4 border-transparent hover:border-emerald-400 {{ request()->routeIs('publico.index') ? 'bg-emerald-50 border-emerald-400 text-emerald-700' : '' }} flex items-center">
                    <i class="fas fa-home mr-3 text-emerald-500"></i> Inicio
                </a>
                <a href="{{ route('publico.buscar') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 transition-all duration-200 font-medium border-l-4 border-transparent hover:border-emerald-400 {{ request()->routeIs('publico.buscar') ? 'bg-emerald-50 border-emerald-400 text-emerald-700' : '' }} flex items-center">
                    <i class="fas fa-heart mr-3 text-emerald-500"></i> ¡Adopta!
                </a>
                <a href="{{ route('publico.nosotros') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 transition-all duration-200 font-medium border-l-4 border-transparent hover:border-emerald-400 {{ request()->routeIs('publico.nosotros') ? 'bg-emerald-50 border-emerald-400 text-emerald-700' : '' }} flex items-center">
                    <i class="fas fa-users mr-3 text-emerald-500"></i> Nosotros
                </a>
                <a href="{{ route('noticias.index') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 transition-all duration-200 font-medium border-l-4 border-transparent hover:border-emerald-400 {{ request()->routeIs('noticias.*') ? 'bg-emerald-50 border-emerald-400 text-emerald-700' : '' }} flex items-center">
                    <i class="fas fa-newspaper mr-3 text-emerald-500"></i> Noticias
                </a>
                <a href="{{ route('publico.donaciones') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 transition-all duration-200 font-medium border-l-4 border-transparent hover:border-emerald-400 {{ request()->routeIs('publico.donaciones') ? 'bg-emerald-50 border-emerald-400 text-emerald-700' : '' }} flex items-center">
                    <i class="fas fa-hand-holding-heart mr-3 text-emerald-500"></i> Donaciones
                </a>
                <a href="{{ route('animales-perdidos.index') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 transition-all duration-200 font-medium border-l-4 border-transparent hover:border-emerald-400 {{ request()->routeIs('animales-perdidos.*') ? 'bg-emerald-50 border-emerald-400 text-emerald-700' : '' }} flex items-center">
                    <i class="fas fa-search-location mr-3 text-emerald-500"></i> Perdidos
                </a>
                @endif
                
                @auth
                    @if(Auth::user()->rol === 'fundacion')
                        <a href="{{ route('fundacion.animales') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 transition-all duration-200 font-medium border-l-4 border-transparent hover:border-emerald-400 {{ request()->routeIs('fundacion.animales') ? 'bg-emerald-50 border-emerald-400 text-emerald-700' : '' }} flex items-center">
                            <i class="fas fa-paw mr-3 text-emerald-500"></i> Mis Animales
                        </a>
                        <a href="{{ route('fundacion.solicitudes') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 transition-all duration-200 font-medium border-l-4 border-transparent hover:border-emerald-400 {{ request()->routeIs('fundacion.solicitudes') ? 'bg-emerald-50 border-emerald-400 text-emerald-700' : '' }} flex items-center">
                            <i class="fas fa-file-signature mr-3 text-emerald-500"></i> Solicitudes
                        </a>
                        <a href="{{ route('fundacion.noticias.index') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 transition-all duration-200 font-medium border-l-4 border-transparent hover:border-emerald-400 {{ request()->routeIs('fundacion.noticias.*') ? 'bg-emerald-50 border-emerald-400 text-emerald-700' : '' }} flex items-center">
                            <i class="fas fa-newspaper mr-3 text-emerald-500"></i> Noticias
                        </a>
                    @elseif(Auth::user()->rol === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 transition-all duration-200 font-medium border-l-4 border-transparent hover:border-emerald-400 {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 border-emerald-400 text-emerald-700' : '' }} flex items-center">
                            <i class="fas fa-tachometer-alt mr-3 text-emerald-500"></i> Panel
                        </a>
                        <a href="{{ route('admin.usuarios') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 transition-all duration-200 font-medium border-l-4 border-transparent hover:border-emerald-400 {{ request()->routeIs('admin.usuarios') ? 'bg-emerald-50 border-emerald-400 text-emerald-700' : '' }} flex items-center">
                            <i class="fas fa-user-cog mr-3 text-emerald-500"></i> Usuarios
                        </a>
                        <a href="{{ route('admin.solicitudes') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 transition-all duration-200 font-medium border-l-4 border-transparent hover:border-emerald-400 {{ request()->routeIs('admin.solicitudes') ? 'bg-emerald-50 border-emerald-400 text-emerald-700' : '' }} flex items-center">
                            <i class="fas fa-clipboard-list mr-3 text-emerald-500"></i> Solicitudes
                        </a>
                        <a href="{{ route('admin.mascotas-perdidas') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 transition-all duration-200 font-medium border-l-4 border-transparent hover:border-emerald-400 {{ request()->routeIs('admin.mascotas-perdidas*') ? 'bg-emerald-50 border-emerald-400 text-emerald-700' : '' }} flex items-center">
                            <i class="fas fa-search-location mr-3 text-emerald-500"></i> Mascotas Perdidas
                        </a>
                    @endif
                @endauth
                
                <div class="border-t border-gray-200 mt-4 pt-4">
                    @guest
                        <a href="{{ route('login') }}" class="block w-full text-center bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-5 py-3 rounded-lg shadow-sm transition duration-200 mb-3">
                            <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block w-full text-center bg-white hover:bg-emerald-50 text-emerald-600 font-semibold px-5 py-3 rounded-lg shadow-sm transition duration-200 border-2 border-emerald-500">
                                <i class="fas fa-user-plus mr-2"></i> Registrarse
                            </a>
                        @endif
                    @else
                        <div class="flex items-center justify-between px-4 py-3 bg-emerald-50 rounded-lg border border-emerald-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-semibold border-2 border-emerald-200">
                                    {{ strtoupper(substr(Auth::user()->nombre ?? Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="text-gray-700 font-medium">{{ Auth::user()->nombre ?? Auth::user()->name }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors duration-200">
                                    <i class="fas fa-sign-out-alt text-lg"></i>
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>


<script>
    // Alpine.js para manejar el estado del menú móvil
    document.addEventListener('alpine:init', () => {
        Alpine.data('navbar', () => ({
            mobileMenuOpen: false,
            
            init() {
                // Cerrar menú móvil al cambiar el tamaño de la pantalla
                window.addEventListener('resize', () => {
                    if (window.innerWidth >= 768) {
                        this.mobileMenuOpen = false;
                    }
                });
            }
        }));
    });
</script>

<style>
    /* Animación para el navbar */
    nav {
        transition: all 0.3s ease;
    }
    
    /* Mejorar la legibilidad del menú desplegable */
    [x-cloak] { display: none !important; }
    
    /* Breakpoint personalizado para pantallas extra pequeñas */
    @media (min-width: 375px) {
        .xs\:inline { display: inline; }
        .xs\:hidden { display: none; }
    }
    
    /* Mejoras para pantallas muy pequeñas */
    @media (max-width: 374px) {
        .navbar-logo {
            font-size: 1rem !important;
        }
        
        .navbar-container {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
        }
        
        .mobile-menu-item {
            padding: 0.75rem 1rem !important;
            font-size: 0.9rem;
        }
        
        .mobile-menu-icon {
            width: 1.25rem !important;
            height: 1.25rem !important;
            margin-right: 0.75rem !important;
        }
    }
    
    /* Mejoras para tablets */
    @media (min-width: 768px) and (max-width: 1023px) {
        .nav-link {
            padding: 0.5rem 0.75rem !important;
            font-size: 0.875rem;
        }
        
        .nav-icon {
            margin-right: 0.375rem !important;
        }
    }
    
    /* Animación suave para el menú móvil */
    .mobile-menu-enter {
        animation: slideDown 0.3s ease-out;
    }
    
    .mobile-menu-leave {
        animation: slideUp 0.2s ease-in;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }
    
    /* Efecto de onda para los botones */
    .wave-effect {
        position: relative;
        overflow: hidden;
    }
    
    .wave-effect:after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 5px;
        height: 5px;
        background: rgba(255, 255, 255, 0.5);
        opacity: 0;
        border-radius: 100%;
        transform: scale(1, 1) translate(-50%);
        transform-origin: 50% 50%;
    }
    
    .wave-effect:focus:not(:active)::after {
        animation: wave 0.6s ease-out;
    }
    
    @keyframes wave {
        0% {
            transform: scale(0, 0);
            opacity: 0.5;
        }
        100% {
            transform: scale(20, 20);
            opacity: 0;
        }
    }
    
    /* Mejoras de accesibilidad */
    @media (prefers-reduced-motion: reduce) {
        nav, .wave-effect, .mobile-menu-enter, .mobile-menu-leave {
            animation: none !important;
            transition: none !important;
        }
    }
    
    /* Mejoras para el modo oscuro del sistema */
    @media (prefers-color-scheme: dark) {
        .mobile-menu-backdrop {
            background-color: rgba(0, 0, 0, 0.8);
        }
    }
    
    /* Scroll suave cuando el menú móvil está abierto */
    body.mobile-menu-open {
        overflow: hidden;
    }
    
    /* Mejoras para el touch en dispositivos móviles */
    @media (hover: none) and (pointer: coarse) {
        .nav-link:hover {
            background-color: transparent !important;
        }
        
        .nav-link:active {
            background-color: rgba(59, 130, 246, 0.3) !important;
            transform: scale(0.98);
        }
        
        .mobile-menu-item:active {
            background-color: rgba(59, 130, 246, 0.5) !important;
            transform: scale(0.98);
        }
    }
</style>
