@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 relative overflow-hidden">
    <!-- Elementos decorativos de fondo mejorados -->
    <div class="absolute inset-0">
        <!-- Formas geométricas animadas -->
        <div class="absolute top-10 left-5 w-20 h-20 bg-gradient-to-br from-emerald-400 to-teal-400 rounded-full opacity-20 animate-float"></div>
        <div class="absolute top-32 right-10 w-16 h-16 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full opacity-25 animate-float-delayed"></div>
        <div class="absolute bottom-40 left-1/4 w-24 h-24 bg-gradient-to-br from-teal-400 to-cyan-400 rounded-full opacity-15 animate-bounce-slow"></div>
        <div class="absolute bottom-20 right-1/3 w-18 h-18 bg-gradient-to-br from-pink-400 to-purple-400 rounded-full opacity-30 animate-pulse-slow"></div>
        
        <!-- Elementos adicionales -->
        <div class="absolute top-1/2 left-10 w-32 h-1 bg-gradient-to-r from-emerald-300 to-transparent opacity-40 animate-slide-right"></div>
        <div class="absolute top-1/3 right-20 w-28 h-1 bg-gradient-to-l from-purple-300 to-transparent opacity-40 animate-slide-left"></div>
        
        <!-- Partículas flotantes -->
        <div class="absolute top-20 left-1/2 w-2 h-2 bg-emerald-400 rounded-full opacity-60 animate-float"></div>
        <div class="absolute top-60 left-1/3 w-1 h-1 bg-teal-400 rounded-full opacity-70 animate-float-delayed"></div>
        <div class="absolute bottom-60 right-1/4 w-3 h-3 bg-purple-400 rounded-full opacity-50 animate-bounce-slow"></div>
    </div>

    <!-- Hero Section Mejorado -->
    <section class="relative z-10 py-24 px-4 lg:px-0">
        <div class="max-w-7xl mx-auto text-center">
            <!-- Badge animado -->
            <div class="inline-block relative mb-8">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full blur opacity-75 animate-pulse-slow"></div>
                <div class="relative bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-10 py-4 rounded-full text-sm font-bold uppercase tracking-wider shadow-2xl transform hover:scale-105 transition-all duration-300">
                    <span class="animate-bounce inline-block mr-2">📰</span>
                    <span>Mantente Informado</span>
                    <span class="animate-bounce inline-block ml-2 delay-500">✨</span>
                </div>
            </div>
            
            <!-- Título principal con efectos -->
            <div class="relative mb-8">
                <h1 class="text-7xl lg:text-8xl font-black bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 bg-clip-text text-transparent mb-4 leading-tight animate-fade-in-up">
                    Últimas Noticias
                </h1>
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-gradient-to-r from-transparent via-emerald-400 to-transparent opacity-60 animate-pulse"></div>
            </div>
            
            <!-- Descripción mejorada -->
            <p class="text-xl lg:text-2xl text-gray-700 max-w-5xl mx-auto leading-relaxed font-medium mb-12 animate-fade-in-up delay-200">
                Descubre las historias más inspiradoras, conoce nuestros rescates más recientes y mantente al día con todas las novedades del mundo de la adopción animal. Cada noticia es una ventana a la esperanza.
            </p>
            
            <!-- Categorías mejoradas -->
            <div class="flex flex-wrap justify-center gap-6 mb-16 animate-fade-in-up delay-400">
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity duration-300"></div>
                    <div class="relative bg-white/90 backdrop-blur-sm rounded-2xl px-8 py-4 shadow-xl border border-emerald-200 hover:border-emerald-300 transition-all duration-300 transform hover:scale-105">
                        <span class="text-2xl mb-2 block animate-bounce">🏠</span>
                        <span class="text-emerald-600 font-bold text-lg">Historias de Adopción</span>
                    </div>
                </div>
                
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-400 to-orange-400 rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity duration-300"></div>
                    <div class="relative bg-white/90 backdrop-blur-sm rounded-2xl px-8 py-4 shadow-xl border border-red-200 hover:border-red-300 transition-all duration-300 transform hover:scale-105">
                        <span class="text-2xl mb-2 block animate-bounce delay-200">🚨</span>
                        <span class="text-red-600 font-bold text-lg">Rescates Urgentes</span>
                    </div>
                </div>
                
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-pink-400 rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity duration-300"></div>
                    <div class="relative bg-white/90 backdrop-blur-sm rounded-2xl px-8 py-4 shadow-xl border border-purple-200 hover:border-purple-300 transition-all duration-300 transform hover:scale-105">
                        <span class="text-2xl mb-2 block animate-bounce delay-400">🎉</span>
                        <span class="text-purple-600 font-bold text-lg">Eventos Especiales</span>
                    </div>
                </div>
                
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-teal-400 to-cyan-400 rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity duration-300"></div>
                    <div class="relative bg-white/90 backdrop-blur-sm rounded-2xl px-8 py-4 shadow-xl border border-teal-200 hover:border-teal-300 transition-all duration-300 transform hover:scale-105">
                        <span class="text-2xl mb-2 block animate-bounce delay-600">💚</span>
                        <span class="text-teal-600 font-bold text-lg">Consejos y Tips</span>
                    </div>
                </div>
            </div>
            
            <!-- Filtros de noticias mejorados -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-gray-200 max-w-6xl mx-auto animate-fade-in-up delay-600">
                <!-- Barra de búsqueda -->
                <div class="max-w-2xl mx-auto mb-8">
                    <div class="relative">
                        <input type="text" id="news-search" placeholder="Buscar noticias..." class="w-full px-6 py-4 pl-12 pr-16 rounded-2xl border-2 border-gray-200 focus:border-emerald-500 focus:outline-none text-lg transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-lg">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white p-2 rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Filtros por categoría -->
                <div class="flex flex-wrap justify-center gap-4 mb-8">
                    <button class="filter-btn active bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-8 py-4 rounded-2xl font-bold shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2" data-filter="all">
                        <span class="text-xl">📰</span>
                        <span>Todas</span>
                        <span class="bg-white/20 px-2 py-1 rounded-full text-xs">{{ count($noticias) }}</span>
                    </button>
                    <button class="filter-btn bg-white/80 backdrop-blur-sm text-gray-700 border-2 border-gray-200 hover:border-emerald-300 hover:bg-emerald-50 px-8 py-4 rounded-2xl font-bold shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2" data-filter="adopciones">
                        <span class="text-xl">🏠</span>
                        <span>Adopciones</span>
                        <span class="bg-gray-200 px-2 py-1 rounded-full text-xs">{{ rand(3, 8) }}</span>
                    </button>
                    <button class="filter-btn bg-white/80 backdrop-blur-sm text-gray-700 border-2 border-gray-200 hover:border-red-300 hover:bg-red-50 px-8 py-4 rounded-2xl font-bold shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2" data-filter="rescates">
                        <span class="text-xl">🚨</span>
                        <span>Rescates</span>
                        <span class="bg-gray-200 px-2 py-1 rounded-full text-xs">{{ rand(2, 5) }}</span>
                    </button>
                    <button class="filter-btn bg-white/80 backdrop-blur-sm text-gray-700 border-2 border-gray-200 hover:border-purple-300 hover:bg-purple-50 px-8 py-4 rounded-2xl font-bold shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2" data-filter="eventos">
                        <span class="text-xl">🎉</span>
                        <span>Eventos</span>
                        <span class="bg-gray-200 px-2 py-1 rounded-full text-xs">{{ rand(4, 7) }}</span>
                    </button>
                    <button class="filter-btn bg-white/80 backdrop-blur-sm text-gray-700 border-2 border-gray-200 hover:border-teal-300 hover:bg-teal-50 px-8 py-4 rounded-2xl font-bold shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2" data-filter="consejos">
                        <span class="text-xl">💚</span>
                        <span>Consejos</span>
                        <span class="bg-gray-200 px-2 py-1 rounded-full text-xs">{{ rand(1, 4) }}</span>
                    </button>
                </div>
                
                <!-- Filtros adicionales -->
                <div class="flex flex-wrap justify-center gap-3 mb-6">
                    <select class="sort-select bg-white/80 backdrop-blur-sm border-2 border-gray-200 rounded-xl px-4 py-2 text-sm font-medium text-gray-700 focus:border-emerald-500 focus:outline-none transition-all duration-300">
                        <option value="recent">📅 Más Recientes</option>
                        <option value="popular">🔥 Más Populares</option>
                        <option value="oldest">⏰ Más Antiguas</option>
                        <option value="alphabetical">🔤 Alfabético</option>
                    </select>
                    
                    <select class="date-filter bg-white/80 backdrop-blur-sm border-2 border-gray-200 rounded-xl px-4 py-2 text-sm font-medium text-gray-700 focus:border-teal-500 focus:outline-none transition-all duration-300">
                        <option value="all">📆 Todas las fechas</option>
                        <option value="today">🌅 Hoy</option>
                        <option value="week">📅 Esta semana</option>
                        <option value="month">🗓️ Este mes</option>
                        <option value="year">📊 Este año</option>
                    </select>
                    
                    <button class="reset-filters bg-gray-100 hover:bg-gray-200 text-gray-600 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span>Limpiar</span>
                    </button>
                </div>
                
                <!-- Indicador de resultados -->
                <div class="text-center">
                    <div class="inline-flex items-center space-x-2 bg-emerald-50 text-emerald-700 px-4 py-2 rounded-full text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span id="results-count">Mostrando {{ count($noticias) }} noticias</span>
                    </div>
                </div>
                
                <!-- Botón Cargar Más -->
                <div id="load-more-section" class="col-span-full text-center mt-12">
                    <button id="load-more-btn" class="group bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:from-emerald-600 hover:to-teal-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <span class="flex items-center space-x-3">
                            <span id="load-more-text">📰 Cargar Más Noticias</span>
                            <svg id="load-more-icon" class="w-6 h-6 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </span>
                    </button>
                    
                    <!-- Indicador de carga -->
                    <div id="loading-indicator" class="hidden mt-8">
                        <div class="flex items-center justify-center space-x-3">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-emerald-500"></div>
                            <span class="text-gray-600 font-medium">Cargando más noticias...</span>
                        </div>
                    </div>
                    
                    <!-- Mensaje de fin -->
                    <div id="end-message" class="hidden mt-8 p-6 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl border border-emerald-200">
                        <div class="text-center">
                            <div class="text-4xl mb-4">📚</div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">¡Has visto todas las noticias!</h3>
                            <p class="text-gray-600">Mantente atento, pronto publicaremos más contenido sobre nuestros rescates y adopciones.</p>
                            <button onclick="scrollToTop()" class="mt-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-2 rounded-xl font-medium hover:from-emerald-600 hover:to-teal-600 transition-all duration-300">
                                ⬆️ Volver al inicio
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Noticias adicionales (ocultas inicialmente) -->
                <div id="additional-news" class="hidden col-span-full">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Noticia adicional 1 -->
                        <article class="news-card group bg-white/90 backdrop-blur-sm rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-200">
                            <div class="relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1601758228041-f3b2795255f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Campaña de esterilización" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="absolute top-4 left-4">
                                    <span class="bg-purple-500/90 text-white px-3 py-1 rounded-full text-sm font-bold backdrop-blur-sm">Salud</span>
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span class="bg-white/90 text-gray-800 px-3 py-1 rounded-full text-sm font-bold backdrop-blur-sm">Hace 3 días</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-emerald-600 transition-colors duration-300">Campaña de Esterilización Gratuita</h3>
                                <p class="text-gray-600 line-clamp-3 mb-4">Únete a nuestra campaña de esterilización gratuita para mascotas de familias de bajos recursos. Ayudamos a controlar la población y mejorar la salud de los animales.</p>
                                <div class="flex items-center justify-between">
                                    <button class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-2 rounded-xl font-medium hover:from-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105">
                                        📖 Lectura rápida
                                    </button>
                                    <div class="flex items-center space-x-2">
                                        <button class="share-btn group/share p-2 rounded-full hover:bg-emerald-50 transition-colors duration-300">
                                            <svg class="w-5 h-5 text-gray-600 group-hover/share:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path></svg>
                                        </button>
                                        <button class="like-btn group/like p-2 rounded-full hover:bg-red-50 transition-colors duration-300">
                                            <svg class="w-5 h-5 text-gray-600 group-hover/like:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        </button>
                                        <button class="bookmark-btn group/bookmark p-2 rounded-full hover:bg-yellow-50 transition-colors duration-300">
                                            <svg class="w-5 h-5 text-gray-600 group-hover/bookmark:text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                        
                        <!-- Noticia adicional 2 -->
                        <article class="news-card group bg-white/90 backdrop-blur-sm rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-200">
                            <div class="relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1583337130417-3346a1be7dee?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Voluntarios en acción" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="absolute top-4 left-4">
                                    <span class="bg-green-500/90 text-white px-3 py-1 rounded-full text-sm font-bold backdrop-blur-sm">Voluntariado</span>
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span class="bg-white/90 text-gray-800 px-3 py-1 rounded-full text-sm font-bold backdrop-blur-sm">Hace 5 días</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-teal-600 transition-colors duration-300">Únete a Nuestro Equipo de Voluntarios</h3>
                                <p class="text-gray-600 line-clamp-3 mb-4">Buscamos personas comprometidas que quieran hacer la diferencia en la vida de los animales. Descubre cómo puedes ayudar con tu tiempo y habilidades.</p>
                                <div class="flex items-center justify-between">
                                    <button class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2 rounded-xl font-medium hover:from-green-600 hover:to-emerald-600 transition-all duration-300 transform hover:scale-105">
                                        📖 Lectura rápida
                                    </button>
                                    <div class="flex items-center space-x-2">
                                        <button class="share-btn group/share p-2 rounded-full hover:bg-teal-50 transition-colors duration-300">
                                            <svg class="w-5 h-5 text-gray-600 group-hover/share:text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path></svg>
                                        </button>
                                        <button class="like-btn group/like p-2 rounded-full hover:bg-red-50 transition-colors duration-300">
                                            <svg class="w-5 h-5 text-gray-600 group-hover/like:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        </button>
                                        <button class="bookmark-btn group/bookmark p-2 rounded-full hover:bg-yellow-50 transition-colors duration-300">
                                            <svg class="w-5 h-5 text-gray-600 group-hover/bookmark:text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                        
                        <!-- Noticia adicional 3 -->
                        <article class="news-card group bg-white/90 backdrop-blur-sm rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-200">
                            <div class="relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Cuidados de mascotas" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="absolute top-4 left-4">
                                    <span class="bg-orange-500/90 text-white px-3 py-1 rounded-full text-sm font-bold backdrop-blur-sm">Consejos</span>
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span class="bg-white/90 text-gray-800 px-3 py-1 rounded-full text-sm font-bold backdrop-blur-sm">Hace 1 semana</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-cyan-600 transition-colors duration-300">Cuidados Esenciales para Mascotas Rescatadas</h3>
                                <p class="text-gray-600 line-clamp-3 mb-4">Aprende los cuidados básicos que necesitan los animales rescatados durante sus primeros días en un nuevo hogar. Tips importantes para una adaptación exitosa.</p>
                                <div class="flex items-center justify-between">
                                    <button class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-medium hover:from-orange-600 hover:to-red-600 transition-all duration-300 transform hover:scale-105">
                                        📖 Lectura rápida
                                    </button>
                                    <div class="flex items-center space-x-2">
                                        <button class="share-btn group/share p-2 rounded-full hover:bg-cyan-50 transition-colors duration-300">
                                            <svg class="w-5 h-5 text-gray-600 group-hover/share:text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path></svg>
                                        </button>
                                        <button class="like-btn group/like p-2 rounded-full hover:bg-red-50 transition-colors duration-300">
                                            <svg class="w-5 h-5 text-gray-600 group-hover/like:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        </button>
                                        <button class="bookmark-btn group/bookmark p-2 rounded-full hover:bg-yellow-50 transition-colors duration-300">
                                            <svg class="w-5 h-5 text-gray-600 group-hover/bookmark:text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section Mejorado -->
    <section class="relative z-10 py-20 px-4 lg:px-0">
        <div class="max-w-7xl mx-auto">
            <!-- Header de sección -->
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-4">
                    <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Historias que Inspiran</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Cada noticia cuenta una historia de esperanza, amor y segundas oportunidades
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="news-grid">
                @foreach($noticias as $index => $noticia)
                <article class="news-card group relative bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-700 transform hover:scale-105 border border-gray-100 animate-fade-in-up" style="animation-delay: {{ $index * 0.1 }}s">
                    <!-- Imagen con overlay mejorado -->
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $noticia['imagen'] }}" alt="{{ $noticia['titulo'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        
                        <!-- Overlay gradiente -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <!-- Badge de fecha mejorado -->
                        <div class="absolute top-4 left-4">
                            <div class="bg-white/90 backdrop-blur-sm text-gray-800 px-4 py-2 rounded-2xl text-sm font-bold shadow-lg border border-white/20">
                                <span class="text-emerald-500 mr-1">📅</span>
                                {{ $noticia['fecha'] }}
                            </div>
                        </div>
                        
                        <!-- Badge de categoría -->
                        <div class="absolute top-4 right-4">
                            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                ✨ Destacado
                            </div>
                        </div>
                        
                        <!-- Botón de lectura rápida -->
                        <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <button class="bg-white/90 backdrop-blur-sm text-gray-800 p-3 rounded-full shadow-lg hover:bg-white transition-colors duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Contenido mejorado -->
                    <div class="p-8">
                        <!-- Título con mejor tipografía -->
                        <h3 class="text-2xl font-black text-gray-900 mb-4 group-hover:text-emerald-600 transition-colors duration-300 line-clamp-2 leading-tight">
                            {{ $noticia['titulo'] }}
                        </h3>
                        
                        <!-- Resumen con mejor espaciado -->
                        <p class="text-gray-600 mb-6 leading-relaxed line-clamp-3 text-base">
                            {{ $noticia['resumen'] }}
                        </p>
                        
                        <!-- Estadísticas de la noticia -->
                        <div class="flex items-center space-x-4 mb-6 text-sm text-gray-500">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span>{{ rand(50, 300) }} vistas</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span>{{ rand(5, 25) }} me gusta</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <span>{{ rand(0, 8) }} comentarios</span>
                            </div>
                        </div>
                        
                        <!-- Acciones mejoradas -->
                        <div class="flex items-center justify-between">
                            <a href="#" class="group/link inline-flex items-center space-x-3 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold px-6 py-3 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <span>Leer Completa</span>
                                <svg class="w-5 h-5 transform group-hover/link:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                            
                            <!-- Botones de acción social -->
                            <div class="flex space-x-2">
                                <button class="share-btn p-3 rounded-2xl bg-gray-100 hover:bg-emerald-100 transition-all duration-300 group/share transform hover:scale-110" title="Compartir">
                                    <svg class="w-5 h-5 text-gray-600 group-hover/share:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                    </svg>
                                </button>
                                
                                <button class="like-btn p-3 rounded-2xl bg-gray-100 hover:bg-red-100 transition-all duration-300 group/heart transform hover:scale-110" title="Me gusta">
                                    <svg class="w-5 h-5 text-gray-600 group-hover/heart:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                                
                                <button class="bookmark-btn p-3 rounded-2xl bg-gray-100 hover:bg-yellow-100 transition-all duration-300 group/bookmark transform hover:scale-110" title="Guardar">
                                    <svg class="w-5 h-5 text-gray-600 group-hover/bookmark:text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Indicador de progreso de lectura -->
                    <div class="absolute bottom-0 left-0 h-1 bg-gradient-to-r from-emerald-500 to-teal-500 transition-all duration-300 group-hover:h-2" style="width: {{ rand(20, 80) }}%"></div>
                </article>
                @endforeach
            </div>
            
            <!-- Botón para cargar más noticias -->
            <div class="text-center mt-16">
                <button class="group relative inline-block">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl blur opacity-75 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold px-8 py-4 rounded-2xl text-lg shadow-2xl transition-all duration-300 transform hover:scale-105 flex items-center space-x-3">
                        <span>📰</span>
                        <span>Cargar Más Noticias</span>
                        <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </div>
                </button>
            </div>
        </div>
    </section>

    <!-- Newsletter Section Mejorado -->
    <section class="relative py-24 px-4 lg:px-0 overflow-hidden">
        <!-- Background decorativo mejorado -->
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50"></div>
        <div class="absolute inset-0">
            <!-- Elementos flotantes animados -->
            <div class="absolute top-10 left-10 w-24 h-24 bg-gradient-to-r from-emerald-200 to-teal-200 rounded-full opacity-20 animate-float"></div>
            <div class="absolute top-32 right-20 w-20 h-20 bg-gradient-to-r from-teal-200 to-cyan-200 rounded-full opacity-30 animate-float-delayed"></div>
            <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-gradient-to-r from-cyan-200 to-emerald-200 rounded-full opacity-25 animate-float"></div>
            <div class="absolute top-1/2 right-1/4 w-12 h-12 bg-gradient-to-r from-emerald-300 to-teal-300 rounded-full opacity-20 animate-pulse"></div>
            
            <!-- Ondas de fondo -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 1200 800" fill="none">
                    <path d="M0,400 Q300,200 600,400 T1200,400 V800 H0 Z" fill="url(#wave-gradient)"/>
                    <defs>
                        <linearGradient id="wave-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:0.3" />
                            <stop offset="50%" style="stop-color:#06B6D4;stop-opacity:0.2" />
                            <stop offset="100%" style="stop-color:#8B5CF6;stop-opacity:0.3" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </div>
        
        <div class="relative z-10 max-w-5xl mx-auto">
            <!-- Header de la sección -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center space-x-2 bg-white/90 backdrop-blur-sm px-6 py-3 rounded-full shadow-lg border border-white/20 mb-6">
                    <span class="text-2xl">📧</span>
                    <span class="text-emerald-600 font-bold">Newsletter Exclusivo</span>
                </div>
                <h2 class="text-5xl lg:text-6xl font-black text-gray-900 mb-6">
                    <span class="bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 bg-clip-text text-transparent">Mantente Conectado</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Únete a nuestra comunidad de amantes de los animales y recibe historias inspiradoras, consejos de cuidado y oportunidades exclusivas para ayudar
                </p>
            </div>
            
            <!-- Tarjeta principal del newsletter -->
            <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-8 lg:p-12 shadow-2xl border border-white/20 relative overflow-hidden">
                <!-- Decoración de la tarjeta -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-full -translate-y-16 translate-x-16 opacity-50"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-purple-100 to-blue-100 rounded-full translate-y-12 -translate-x-12 opacity-50"></div>
                
                <div class="relative z-10">
                    <!-- Beneficios del newsletter -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                        <div class="text-center p-6 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl border border-emerald-100">
                            <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <span class="text-2xl text-white">🐾</span>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Historias de Éxito</h3>
                            <p class="text-gray-600 text-sm">Conoce las adopciones más emotivas</p>
                        </div>
                        
                        <div class="text-center p-6 bg-gradient-to-br from-teal-50 to-cyan-50 rounded-2xl border border-teal-100">
                            <div class="w-16 h-16 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <span class="text-2xl text-white">🎉</span>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Eventos Especiales</h3>
                            <p class="text-gray-600 text-sm">Acceso prioritario a actividades</p>
                        </div>
                        
                        <div class="text-center p-6 bg-gradient-to-br from-cyan-50 to-emerald-50 rounded-2xl border border-cyan-100">
                            <div class="w-16 h-16 bg-gradient-to-r from-cyan-500 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <span class="text-2xl text-white">💡</span>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Consejos Expertos</h3>
                            <p class="text-gray-600 text-sm">Tips de cuidado y bienestar</p>
                        </div>
                    </div>
                    
                    <!-- Formulario de suscripción mejorado -->
                    <div class="max-w-2xl mx-auto">
                        <form class="space-y-6" id="newsletter-form">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <div class="flex-1 relative">
                                    <input type="email" id="newsletter-email" placeholder="tu@email.com" class="w-full px-6 py-4 rounded-2xl border-2 border-gray-200 focus:border-emerald-500 focus:outline-none text-lg transition-all duration-300 bg-white/80 backdrop-blur-sm pl-12" required>
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <button type="submit" class="group relative overflow-hidden bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 hover:from-emerald-600 hover:via-teal-600 hover:to-cyan-600 text-white font-bold px-8 py-4 rounded-2xl text-lg shadow-xl transition-all duration-300 transform hover:scale-105">
                                    <span class="relative z-10 flex items-center space-x-2">
                                        <span>✨ Suscribirse Ahora</span>
                                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </span>
                                    <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </button>
                            </div>
                            
                            <!-- Opciones de frecuencia -->
                            <div class="flex flex-wrap justify-center gap-3">
                                <label class="flex items-center space-x-2 bg-white/60 backdrop-blur-sm px-4 py-2 rounded-full border border-gray-200 hover:border-emerald-300 transition-colors duration-300 cursor-pointer">
                                    <input type="radio" name="frequency" value="weekly" class="text-emerald-500" checked>
                                    <span class="text-sm font-medium text-gray-700">📅 Semanal</span>
                                </label>
                                <label class="flex items-center space-x-2 bg-white/60 backdrop-blur-sm px-4 py-2 rounded-full border border-gray-200 hover:border-teal-300 transition-colors duration-300 cursor-pointer">
                                    <input type="radio" name="frequency" value="monthly" class="text-teal-500">
                                    <span class="text-sm font-medium text-gray-700">📆 Mensual</span>
                                </label>
                                <label class="flex items-center space-x-2 bg-white/60 backdrop-blur-sm px-4 py-2 rounded-full border border-gray-200 hover:border-cyan-300 transition-colors duration-300 cursor-pointer">
                                    <input type="radio" name="frequency" value="events" class="text-cyan-500">
                                    <span class="text-sm font-medium text-gray-700">🎉 Solo Eventos</span>
                                </label>
                            </div>
                        </form>
                        
                        <!-- Información adicional -->
                        <div class="mt-8 text-center">
                            <div class="flex items-center justify-center space-x-6 text-sm text-gray-500 mb-4">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Sin spam</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <span>100% Seguro</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Cancela cuando quieras</span>
                                </div>
                            </div>
                            
                            <p class="text-gray-500 text-sm">
                                📬 Únete a más de <span class="font-bold text-emerald-600">2,500+ suscriptores</span> que ya reciben nuestras historias
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Testimonios de suscriptores -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white/70 backdrop-blur-sm p-6 rounded-2xl shadow-lg border border-white/20">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full flex items-center justify-center text-white font-bold">
                            M
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">María González</h4>
                            <p class="text-sm text-gray-500">Adoptante feliz</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm italic">"Gracias al newsletter conocí a Luna, mi nueva compañera. ¡Las historias me emocionan cada semana!"</p>
                    <div class="flex text-yellow-400 mt-3">
                        ⭐⭐⭐⭐⭐
                    </div>
                </div>
                
                <div class="bg-white/70 backdrop-blur-sm p-6 rounded-2xl shadow-lg border border-white/20">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-teal-400 to-cyan-400 rounded-full flex items-center justify-center text-white font-bold">
                            C
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Carlos Ruiz</h4>
                            <p class="text-sm text-gray-500">Voluntario activo</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm italic">"Los consejos de cuidado han sido invaluables para mi trabajo como voluntario. Contenido de calidad."</p>
                    <div class="flex text-yellow-400 mt-3">
                        ⭐⭐⭐⭐⭐
                    </div>
                </div>
                
                <div class="bg-white/70 backdrop-blur-sm p-6 rounded-2xl shadow-lg border border-white/20 md:col-span-2 lg:col-span-1">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-cyan-400 to-emerald-400 rounded-full flex items-center justify-center text-white font-bold">
                            A
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Ana Martín</h4>
                            <p class="text-sm text-gray-500">Donante regular</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm italic">"Me encanta estar al día con todas las adopciones exitosas. Es mi dosis semanal de alegría."</p>
                    <div class="flex text-yellow-400 mt-3">
                        ⭐⭐⭐⭐⭐
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative z-10 py-16 px-4 lg:px-0">
        <div class="max-w-4xl mx-auto text-center">
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 lg:p-12 border border-gray-200">
                <div class="text-6xl mb-6">💝</div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6 bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    ¿Quieres ayudar a más animales?
                </h2>
                <p class="text-gray-600 mb-8 text-lg leading-relaxed max-w-2xl mx-auto">
                    Tu apoyo puede marcar la diferencia en la vida de muchos animales que necesitan un hogar. Cada donación cuenta para salvar vidas.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('publico.donaciones') }}" class="group relative inline-block">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full blur opacity-75 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-bold px-8 py-4 rounded-full text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105 flex items-center space-x-3">
                            <span>💖</span>
                            <span>Haz una donación</span>
                        </div>
                    </a>
                    <a href="{{ route('publico.index') }}" class="group relative inline-block">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full blur opacity-75 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold px-8 py-4 rounded-full text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105 flex items-center space-x-3">
                            <span>🏠</span>
                            <span>Ver animales</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
        transform: translateY(30px);
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-float-delayed {
        animation: float 6s ease-in-out infinite;
        animation-delay: 2s;
    }
    
    .animate-pulse-slow {
        animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .news-card.hidden {
        display: none !important;
    }
    
    .filter-btn.active {
        background: linear-gradient(135deg, #10B981, #14B8A6) !important;
        color: white !important;
        border-color: transparent !important;
        transform: scale(1.05);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
    }
    
    .news-card {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .news-card.filtering {
        transform: scale(0.8);
        opacity: 0;
    }
    
    .search-highlight {
        background: linear-gradient(120deg, #fef08a 0%, #fbbf24 100%);
        padding: 2px 4px;
        border-radius: 4px;
        font-weight: bold;
    }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 0.8; }
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    
    .animate-shake {
        animation: shake 0.5s ease-in-out;
    }

.animate-pulse {
    animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.delay-1000 {
    animation-delay: 1s;
}

.delay-2000 {
    animation-delay: 2s;
}

.delay-3000 {
    animation-delay: 3s;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const searchInput = document.getElementById('news-search');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const sortSelect = document.querySelector('.sort-select');
    const dateFilter = document.querySelector('.date-filter');
    const resetButton = document.querySelector('.reset-filters');
    const newsCards = document.querySelectorAll('.news-card');
    const resultsCount = document.getElementById('results-count');
    const newsGrid = document.getElementById('news-grid');
    
    // Variables de estado
    let currentFilter = 'all';
    let currentSort = 'recent';
    let currentDateFilter = 'all';
    let searchTerm = '';
    
    // Datos simulados de categorías para las noticias
    const newsCategories = {
        0: 'adopciones',
        1: 'rescates', 
        2: 'eventos',
        3: 'consejos',
        4: 'adopciones',
        5: 'eventos'
    };
    
    // Función para filtrar noticias
    function filterNews() {
        let visibleCount = 0;
        
        newsCards.forEach((card, index) => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const content = card.querySelector('p').textContent.toLowerCase();
            const category = newsCategories[index] || 'adopciones';
            
            let shouldShow = true;
            
            // Filtro por categoría
            if (currentFilter !== 'all' && category !== currentFilter) {
                shouldShow = false;
            }
            
            // Filtro por búsqueda
            if (searchTerm && !title.includes(searchTerm.toLowerCase()) && !content.includes(searchTerm.toLowerCase())) {
                shouldShow = false;
            }
            
            // Aplicar filtro con animación
            if (shouldShow) {
                card.classList.remove('hidden', 'filtering');
                setTimeout(() => {
                    card.style.animationDelay = `${visibleCount * 0.1}s`;
                }, 50);
                visibleCount++;
            } else {
                card.classList.add('filtering');
                setTimeout(() => {
                    card.classList.add('hidden');
                    card.classList.remove('filtering');
                }, 300);
            }
        });
        
        // Actualizar contador de resultados
        updateResultsCount(visibleCount);
        
        // Mostrar mensaje si no hay resultados
        showNoResultsMessage(visibleCount === 0);
    }
    
    // Función para actualizar el contador de resultados
    function updateResultsCount(count) {
        const countText = count === 1 ? '1 noticia' : `${count} noticias`;
        resultsCount.textContent = `Mostrando ${countText}`;
        
        if (count === 0) {
            resultsCount.parentElement.classList.add('animate-shake');
            resultsCount.parentElement.classList.remove('bg-emerald-50', 'text-emerald-700');
            resultsCount.parentElement.classList.add('bg-red-50', 'text-red-700');
        } else {
            resultsCount.parentElement.classList.remove('animate-shake', 'bg-red-50', 'text-red-700');
            resultsCount.parentElement.classList.add('bg-emerald-50', 'text-emerald-700');
        }
    }
    
    // Función para mostrar mensaje de "sin resultados"
    function showNoResultsMessage(show) {
        let noResultsMsg = document.getElementById('no-results-message');
        
        if (show && !noResultsMsg) {
            noResultsMsg = document.createElement('div');
            noResultsMsg.id = 'no-results-message';
            noResultsMsg.className = 'col-span-full text-center py-16';
            noResultsMsg.innerHTML = `
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-12 shadow-xl border border-gray-200 max-w-md mx-auto">
                    <div class="text-6xl mb-6">🔍</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No se encontraron noticias</h3>
                    <p class="text-gray-600 mb-6">Intenta con otros términos de búsqueda o filtros diferentes</p>
                    <button onclick="resetAllFilters()" class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-2xl font-bold hover:from-emerald-600 hover:to-teal-600 transition-all duration-300">
                        🔄 Limpiar Filtros
                    </button>
                </div>
            `;
            newsGrid.appendChild(noResultsMsg);
        } else if (!show && noResultsMsg) {
            noResultsMsg.remove();
        }
    }
    
    // Función para resaltar texto en búsqueda
    function highlightSearchTerm(text, term) {
        if (!term) return text;
        const regex = new RegExp(`(${term})`, 'gi');
        return text.replace(regex, '<span class="search-highlight">$1</span>');
    }
    
    // Función para resetear todos los filtros
    window.resetAllFilters = function() {
        currentFilter = 'all';
        currentSort = 'recent';
        currentDateFilter = 'all';
        searchTerm = '';
        
        searchInput.value = '';
        sortSelect.value = 'recent';
        dateFilter.value = 'all';
        
        filterButtons.forEach(btn => {
            btn.classList.remove('active');
            if (btn.dataset.filter === 'all') {
                btn.classList.add('active');
            }
        });
        
        filterNews();
    };
    
    // Event listeners
    
    // Búsqueda en tiempo real
    searchInput.addEventListener('input', function(e) {
        searchTerm = e.target.value.trim();
        filterNews();
    });
    
    // Filtros por categoría
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            currentFilter = this.dataset.filter;
            filterNews();
        });
    });
    
    // Ordenamiento
    sortSelect.addEventListener('change', function() {
        currentSort = this.value;
        // Aquí podrías implementar la lógica de ordenamiento
        console.log('Ordenar por:', currentSort);
    });
    
    // Filtro por fecha
    dateFilter.addEventListener('change', function() {
        currentDateFilter = this.value;
        // Aquí podrías implementar la lógica de filtrado por fecha
        console.log('Filtrar por fecha:', currentDateFilter);
    });
    
    // Botón de reset
    resetButton.addEventListener('click', resetAllFilters);
    
    // Funcionalidad de botones sociales
    document.querySelectorAll('.share-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            // Simular compartir
            this.innerHTML = '<svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
            setTimeout(() => {
                this.innerHTML = '<svg class="w-5 h-5 text-gray-600 group-hover/share:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path></svg>';
            }, 2000);
        });
    });
    
    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const icon = this.querySelector('svg');
            if (icon.classList.contains('text-red-600')) {
                icon.classList.remove('text-red-600');
                icon.classList.add('text-gray-600');
            } else {
                icon.classList.remove('text-gray-600');
                icon.classList.add('text-red-600');
                // Animación de "me gusta"
                this.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 200);
            }
        });
    });
    
    document.querySelectorAll('.bookmark-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const icon = this.querySelector('svg');
            if (icon.classList.contains('text-yellow-600')) {
                icon.classList.remove('text-yellow-600');
                icon.classList.add('text-gray-600');
            } else {
                icon.classList.remove('text-gray-600');
                icon.classList.add('text-yellow-600');
            }
        });
    });
    
    // Newsletter form
    const newsletterForm = document.getElementById('newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('newsletter-email').value;
            const frequency = document.querySelector('input[name="frequency"]:checked').value;
            
            // Simular suscripción exitosa
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = '<span class="flex items-center space-x-2"><svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg><span>Suscribiendo...</span></span>';
            
            setTimeout(() => {
                submitBtn.innerHTML = '<span class="flex items-center space-x-2"><svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span>¡Suscrito!</span></span>';
                
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    document.getElementById('newsletter-email').value = '';
                }, 3000);
            }, 2000);
        });
    }
    
    // Funcionalidad del botón "Cargar Más"
     const loadMoreBtn = document.getElementById('load-more-btn');
     const loadingIndicator = document.getElementById('loading-indicator');
     const endMessage = document.getElementById('end-message');
     const additionalNews = document.getElementById('additional-news');
     let hasLoadedMore = false;
     
     if (loadMoreBtn) {
         loadMoreBtn.addEventListener('click', function() {
             if (hasLoadedMore) {
                 // Si ya se cargaron más noticias, mostrar mensaje de fin
                 loadMoreBtn.style.display = 'none';
                 endMessage.classList.remove('hidden');
                 return;
             }
             
             // Mostrar indicador de carga
             loadMoreBtn.style.display = 'none';
             loadingIndicator.classList.remove('hidden');
             
             // Simular carga de noticias
             setTimeout(() => {
                 loadingIndicator.classList.add('hidden');
                 additionalNews.classList.remove('hidden');
                 
                 // Animar la aparición de las nuevas noticias
                 const newCards = additionalNews.querySelectorAll('.news-card');
                 newCards.forEach((card, index) => {
                     card.style.opacity = '0';
                     card.style.transform = 'translateY(30px)';
                     setTimeout(() => {
                         card.style.transition = 'all 0.6s ease-out';
                         card.style.opacity = '1';
                         card.style.transform = 'translateY(0)';
                     }, index * 200);
                 });
                 
                 // Mostrar botón nuevamente para simular que hay más contenido
                 setTimeout(() => {
                     loadMoreBtn.style.display = 'block';
                     loadMoreBtn.querySelector('#load-more-text').textContent = '📰 Cargar Más Noticias';
                     hasLoadedMore = true;
                 }, 1000);
                 
                 // Actualizar contador de resultados
                 const currentCount = parseInt(resultsCount.textContent.match(/\d+/)[0]);
                 const newCount = currentCount + 3;
                 const countText = newCount === 1 ? '1 noticia' : `${newCount} noticias`;
                 resultsCount.textContent = `Mostrando ${countText}`;
                 
                 // Scroll suave hacia las nuevas noticias
                 setTimeout(() => {
                     additionalNews.scrollIntoView({ 
                         behavior: 'smooth', 
                         block: 'start' 
                     });
                 }, 800);
                 
             }, 2000); // Simular 2 segundos de carga
         });
     }
     
     // Inicializar filtros
     filterNews();
 });
 
 // Función para scroll hacia arriba
 function scrollToTop() {
     window.scrollTo({
         top: 0,
         behavior: 'smooth'
     });
 }
 </script>
@endsection
