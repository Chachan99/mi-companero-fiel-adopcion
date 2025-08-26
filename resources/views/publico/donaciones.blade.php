@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-cyan-50 relative overflow-hidden">
    <!-- Elementos decorativos de fondo -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute top-40 right-20 w-24 h-24 bg-gradient-to-br from-cyan-400 to-blue-400 rounded-full blur-xl animate-pulse delay-1000"></div>
        <div class="absolute bottom-32 left-1/4 w-40 h-40 bg-gradient-to-br from-pink-400 to-purple-400 rounded-full blur-xl animate-pulse delay-2000"></div>
        <div class="absolute bottom-20 right-1/3 w-28 h-28 bg-gradient-to-br from-blue-400 to-cyan-400 rounded-full blur-xl animate-pulse delay-3000"></div>
    </div>

    <!-- Hero Section -->
    <section class="relative z-10 py-20 px-4 lg:px-0">
        <div class="max-w-7xl mx-auto text-center">
            <div class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 text-white px-8 py-3 rounded-full text-sm font-bold uppercase tracking-wider mb-6 shadow-lg">
                💖 Haz la Diferencia
            </div>
            <h1 class="text-6xl lg:text-7xl font-black bg-gradient-to-r from-purple-600 via-pink-600 to-cyan-600 bg-clip-text text-transparent mb-6 leading-tight">
                Apoya Nuestra Misión
            </h1>
            <p class="text-xl lg:text-2xl text-gray-700 max-w-4xl mx-auto leading-relaxed font-medium mb-8">
                Tu donación ayuda a salvar vidas y darles una segunda oportunidad a animales necesitados. Cada aporte cuenta para crear un mundo mejor.
            </p>
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <div class="bg-white/80 backdrop-blur-sm rounded-full px-6 py-3 shadow-lg border border-purple-200">
                    <span class="text-purple-600 font-semibold">🩺 Atención Médica</span>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-full px-6 py-3 shadow-lg border border-pink-200">
                    <span class="text-pink-600 font-semibold">🏠 Refugio Seguro</span>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-full px-6 py-3 shadow-lg border border-cyan-200">
                    <span class="text-cyan-600 font-semibold">❤️ Rehabilitación</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Donation Info Section -->
    <section class="relative z-10 py-16 px-4 lg:px-0">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl p-8 lg:p-12 border border-gray-200">
                <div class="text-center mb-12">
                    <h2 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-6">
                        ¿En qué se utilizan las donaciones?
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Cada aporte que recibimos nos ayuda a mejorar la calidad de vida de los animales rescatados y a fomentar una tenencia responsable.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="group bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 hover:scale-105 border border-purple-100">
                        <div class="flex items-start space-x-6">
                            <div class="bg-gradient-to-br from-purple-500 to-pink-500 p-4 rounded-full shadow-lg text-3xl flex items-center justify-center w-16 h-16 group-hover:scale-110 transition-transform duration-300">
                                🩺
                            </div>
                            <div>
                                <h3 class="font-bold text-2xl text-gray-900 mb-3">Atención Veterinaria</h3>
                                <p class="text-gray-600 leading-relaxed">Consultas, vacunas, esterilizaciones y tratamientos médicos para garantizar su bienestar.</p>
                            </div>
                        </div>
                    </div>

                    <div class="group bg-gradient-to-br from-cyan-50 to-blue-50 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 hover:scale-105 border border-cyan-100">
                        <div class="flex items-start space-x-6">
                            <div class="bg-gradient-to-br from-cyan-500 to-blue-500 p-4 rounded-full shadow-lg text-3xl flex items-center justify-center w-16 h-16 group-hover:scale-110 transition-transform duration-300">
                                🏠
                            </div>
                            <div>
                                <h3 class="font-bold text-2xl text-gray-900 mb-3">Albergue y Cuidado</h3>
                                <p class="text-gray-600 leading-relaxed">Alimentación, refugio seguro y cuidados diarios para los animales rescatados.</p>
                            </div>
                        </div>
                    </div>

                    <div class="group bg-gradient-to-br from-pink-50 to-red-50 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 hover:scale-105 border border-pink-100">
                        <div class="flex items-start space-x-6">
                            <div class="bg-gradient-to-br from-pink-500 to-red-500 p-4 rounded-full shadow-lg text-3xl flex items-center justify-center w-16 h-16 group-hover:scale-110 transition-transform duration-300">
                                ❤️
                            </div>
                            <div>
                                <h3 class="font-bold text-2xl text-gray-900 mb-3">Rehabilitación</h3>
                                <p class="text-gray-600 leading-relaxed">Terapias y cuidados especiales para animales con necesidades médicas o emocionales.</p>
                            </div>
                        </div>
                    </div>

                    <div class="group bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 hover:scale-105 border border-green-100">
                        <div class="flex items-start space-x-6">
                            <div class="bg-gradient-to-br from-green-500 to-emerald-500 p-4 rounded-full shadow-lg text-3xl flex items-center justify-center w-16 h-16 group-hover:scale-110 transition-transform duration-300">
                                🐾
                            </div>
                            <div>
                                <h3 class="font-bold text-2xl text-gray-900 mb-3">Campañas Educativas</h3>
                                <p class="text-gray-600 leading-relaxed">Programas de concientización sobre el cuidado y la tenencia responsable de mascotas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Cuentas Bancarias -->
    <section class="relative z-10 py-16 px-4 lg:px-0">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent mb-6">
                    💳 Cuentas Bancarias para Donaciones
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Elige la fundación que más te inspire y realiza tu donación de forma segura
                </p>
            </div>

            @if($fundaciones->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($fundaciones as $fundacion)
                        <div class="group bg-white/95 backdrop-blur-md rounded-3xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl hover:scale-105 transition-all duration-500">
                            <div class="p-8">
                                <!-- Encabezado -->
                                <div class="flex items-center mb-8">
                                    @if($fundacion->imagen)
                                        <img src="{{ asset($fundacion->imagen) }}" alt="{{ $fundacion->nombre }}" class="w-20 h-20 rounded-full object-cover mr-4 border-4 border-gradient-to-r from-purple-500 to-pink-500 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    @else
                                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center mr-4 text-4xl border-4 border-purple-200 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            🐾
                                        </div>
                                    @endif
                                    <h3 class="text-2xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors duration-300">{{ $fundacion->nombre }}</h3>
                                </div>

                                <div class="space-y-4">
                                    @if(!empty($fundacion->banco_nombre))
                                        <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-4 rounded-xl flex items-center border border-blue-100 hover:shadow-md transition-shadow duration-300">
                                            <span class="text-3xl mr-4">🏦</span>
                                            <div>
                                                <p class="text-sm text-blue-600 font-semibold">Banco</p>
                                                <p class="font-bold text-gray-900">{{ $fundacion->banco_nombre }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($fundacion->tipo_cuenta))
                                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-xl flex items-center border border-purple-100 hover:shadow-md transition-shadow duration-300">
                                            <span class="text-3xl mr-4">{{ in_array(strtolower($fundacion->tipo_cuenta), ['ahorros', 'ahorro']) ? '🐖' : '👛' }}</span>
                                            <div>
                                                <p class="text-sm text-purple-600 font-semibold">Tipo de Cuenta</p>
                                                <p class="font-bold text-gray-900">{{ ucfirst($fundacion->tipo_cuenta) }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($fundacion->numero_cuenta))
                                        <div class="bg-gradient-to-r from-cyan-50 to-blue-50 p-4 rounded-xl flex justify-between items-center border border-cyan-100 hover:shadow-md transition-shadow duration-300">
                                            <div>
                                                <p class="text-sm text-cyan-600 font-semibold">Número de Cuenta</p>
                                                <p class="font-mono text-gray-900 font-bold text-lg">{{ $fundacion->numero_cuenta }}</p>
                                            </div>
                                            <button type="button" onclick="copiarAlPortapapeles('{{ $fundacion->numero_cuenta }}', this)" class="bg-cyan-500 hover:bg-cyan-600 text-white p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110" title="Copiar">
                                                📋
                                            </button>
                                        </div>
                                    @endif

                                    @if(!empty($fundacion->nombre_titular))
                                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-xl flex items-center border border-green-100 hover:shadow-md transition-shadow duration-300">
                                            <span class="text-3xl mr-4">👤</span>
                                            <div>
                                                <p class="text-sm text-green-600 font-semibold">Titular</p>
                                                <p class="font-bold text-gray-900">{{ $fundacion->nombre_titular }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($fundacion->identificacion_titular))
                                        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-4 rounded-xl flex justify-between items-center border border-yellow-100 hover:shadow-md transition-shadow duration-300">
                                            <div>
                                                <p class="text-sm text-yellow-600 font-semibold">{{ $fundacion->tipo_identificacion ?? 'Identificación' }}</p>
                                                <p class="font-bold text-gray-900">{{ $fundacion->identificacion_titular }}</p>
                                            </div>
                                            <button type="button" onclick="copiarAlPortapapeles('{{ $fundacion->identificacion_titular }}', this)" class="bg-yellow-500 hover:bg-yellow-600 text-white p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110" title="Copiar">
                                                📋
                                            </button>
                                        </div>
                                    @endif

                                    @if(!empty($fundacion->email_contacto_pagos))
                                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-4 rounded-xl flex items-center border border-indigo-100 hover:shadow-md transition-shadow duration-300">
                                            <span class="text-3xl mr-4">📧</span>
                                            <div>
                                                <p class="text-sm text-indigo-600 font-semibold">Email</p>
                                                <p class="font-bold text-gray-900">{{ $fundacion->email_contacto_pagos }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($fundacion->otros_metodos_pago))
                                        <div class="bg-gradient-to-r from-amber-50 to-yellow-50 border-l-4 border-amber-400 p-4 rounded-xl shadow-sm">
                                            <p class="text-amber-700">
                                                <span class="font-bold text-lg">💡 Otros métodos:</span>
                                                <span class="block mt-2 font-medium">{{ $fundacion->otros_metodos_pago }}</span>
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-gray-200">
                    <span class="text-6xl block mb-6">ℹ️</span>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Próximamente</h3>
                    <p class="text-gray-600 text-lg">Estarán disponibles las cuentas para donaciones.</p>
                </div>
            @endif
        </div>
    </section>

<script>
function copiarAlPortapapeles(texto, btn) {
    navigator.clipboard.writeText(texto).then(() => {
        btn.innerHTML = "✅";
        setTimeout(() => btn.innerHTML = "📋", 1500);
    });
}
</script>

    <!-- Otras formas de ayudar -->
    <section class="relative z-10 py-16 px-4 lg:px-0">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl p-8 lg:p-12 border border-gray-100">
                <div class="text-center mb-12">
                    <h2 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent mb-6">
                        🌟 Otras formas de ayudar
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Hay muchas maneras de contribuir a nuestra causa más allá de las donaciones monetarias
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Voluntariado -->
                    <div class="group text-center p-8 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl hover:shadow-xl hover:scale-105 transition-all duration-300 border border-blue-100">
                        <div class="bg-gradient-to-br from-blue-500 to-cyan-500 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            🤝
                        </div>
                        <h3 class="font-bold text-2xl text-gray-900 mb-4 group-hover:text-blue-600 transition-colors duration-300">Voluntariado</h3>
                        <p class="text-gray-600 leading-relaxed">Únete a nuestro equipo y ayuda directamente a los animales rescatados con tu tiempo y dedicación.</p>
                    </div>

                    <!-- Hogar Temporal -->
                    <div class="group text-center p-8 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl hover:shadow-xl hover:scale-105 transition-all duration-300 border border-purple-100">
                        <div class="bg-gradient-to-br from-purple-500 to-pink-500 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            🏠
                        </div>
                        <h3 class="font-bold text-2xl text-gray-900 mb-4 group-hover:text-purple-600 transition-colors duration-300">Hogar Temporal</h3>
                        <p class="text-gray-600 leading-relaxed">Ofrece un lugar seguro y amoroso para animales en proceso de adopción.</p>
                    </div>

                    <!-- Donación en Especie -->
                    <div class="group text-center p-8 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl hover:shadow-xl hover:scale-105 transition-all duration-300 border border-green-100">
                        <div class="bg-gradient-to-br from-green-500 to-emerald-500 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            🎁
                        </div>
                        <h3 class="font-bold text-2xl text-gray-900 mb-4 group-hover:text-green-600 transition-colors duration-300">Donación en Especie</h3>
                        <p class="text-gray-600 leading-relaxed">Alimentos, medicinas, cobijas y más siempre son bienvenidos para nuestros rescatados.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="relative z-10 py-16 px-4 lg:px-0">
        <div class="max-w-4xl mx-auto text-center">
            <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-3xl shadow-2xl p-8 lg:p-12 text-white relative overflow-hidden">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="relative z-10">
                    <div class="text-6xl mb-6">💝</div>
                    <h2 class="text-4xl font-bold mb-4">¡Gracias por tu apoyo!</h2>
                    <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">
                        Cada donación, cada gesto de amor, cada minuto de tu tiempo hace la diferencia en la vida de un animal necesitado.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('publico.index') }}" class="group relative inline-block">
                            <div class="absolute inset-0 bg-white rounded-full blur opacity-75 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative bg-white text-purple-600 font-bold px-8 py-4 rounded-full text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105 flex items-center space-x-3">
                                <span>🏠</span>
                                <span>Ver animales</span>
                            </div>
                        </a>
                        <a href="{{ route('publico.nosotros') }}" class="group relative inline-block">
                            <div class="absolute inset-0 bg-white/20 rounded-full blur opacity-75 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative bg-white/20 backdrop-blur-sm border-2 border-white text-white font-bold px-8 py-4 rounded-full text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105 flex items-center space-x-3">
                                <span>ℹ️</span>
                                <span>Conoce más</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
function copiarAlPortapapeles(texto, btn) {
    navigator.clipboard.writeText(texto).then(() => {
        // Cambiar icono temporalmente
        const iconoOriginal = btn.innerHTML;
        btn.innerHTML = "✅";
        btn.classList.add('bg-green-500');
        btn.classList.remove('bg-cyan-500', 'bg-yellow-500');
        
        // Mostrar notificación
        const notificacion = document.createElement('div');
        notificacion.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-full shadow-2xl flex items-center space-x-3 z-50 notificacion-copiar';
        notificacion.innerHTML = `
            <span class="text-2xl">✅</span>
            <span class="font-semibold">¡Copiado al portapapeles!</span>
        `;
        document.body.appendChild(notificacion);
        
        // Restaurar botón y eliminar notificación
        setTimeout(() => {
            btn.innerHTML = iconoOriginal;
            btn.classList.remove('bg-green-500');
            btn.classList.add('bg-cyan-500');
            
            notificacion.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            setTimeout(() => {
                document.body.removeChild(notificacion);
            }, 500);
        }, 2000);
    }).catch(err => {
        console.error('Error al copiar:', err);
    });
}
</script>

<style>
@keyframes pulse {
    0%, 100% { opacity: 0.4; }
    50% { opacity: 0.8; }
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

/* Mejoras de accesibilidad */
button:focus {
    outline: 2px solid #8b5cf6;
    outline-offset: 2px;
}

/* Notificación de copiado */
.notificacion-copiar {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from {
        transform: translateY(100px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>
@endsection
