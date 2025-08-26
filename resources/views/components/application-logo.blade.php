<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <!-- Círculo de fondo con gradiente -->
    <defs>
        <linearGradient id="bgGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#10b981;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#059669;stop-opacity:1" />
        </linearGradient>
        <linearGradient id="heartGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#f59e0b;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#d97706;stop-opacity:1" />
        </linearGradient>
    </defs>
    
    <!-- Fondo circular -->
    <circle cx="50" cy="50" r="48" fill="url(#bgGradient)" stroke="#ffffff" stroke-width="2"/>
    
    <!-- Cabeza del perro -->
    <ellipse cx="50" cy="35" rx="18" ry="15" fill="#ffffff" opacity="0.9"/>
    
    <!-- Orejas -->
    <ellipse cx="38" cy="28" rx="6" ry="12" fill="#ffffff" opacity="0.8" transform="rotate(-25 38 28)"/>
    <ellipse cx="62" cy="28" rx="6" ry="12" fill="#ffffff" opacity="0.8" transform="rotate(25 62 28)"/>
    
    <!-- Ojos -->
    <circle cx="45" cy="32" r="2.5" fill="#1f2937"/>
    <circle cx="55" cy="32" r="2.5" fill="#1f2937"/>
    <circle cx="45.5" cy="31.5" r="0.8" fill="#ffffff"/>
    <circle cx="55.5" cy="31.5" r="0.8" fill="#ffffff"/>
    
    <!-- Nariz -->
    <ellipse cx="50" cy="38" rx="2" ry="1.5" fill="#1f2937"/>
    
    <!-- Boca -->
    <path d="M 48 40 Q 50 42 52 40" stroke="#1f2937" stroke-width="1.5" fill="none" stroke-linecap="round"/>
    
    <!-- Cuerpo del gato (silueta simple) -->
    <ellipse cx="50" cy="65" rx="12" ry="18" fill="#ffffff" opacity="0.7"/>
    
    <!-- Cola del gato -->
    <path d="M 62 70 Q 75 65 72 50" stroke="#ffffff" stroke-width="4" fill="none" stroke-linecap="round" opacity="0.6"/>
    
    <!-- Patas -->
    <ellipse cx="42" cy="78" rx="2.5" ry="6" fill="#ffffff" opacity="0.6"/>
    <ellipse cx="58" cy="78" rx="2.5" ry="6" fill="#ffffff" opacity="0.6"/>
    
    <!-- Corazón central -->
    <path d="M 50 50 C 50 50, 45 45, 40 50 C 40 55, 50 65, 50 65 C 50 65, 60 55, 60 50 C 55 45, 50 50, 50 50 Z" fill="url(#heartGradient)" opacity="0.9"/>
    
    <!-- Huella de pata decorativa -->
    <g transform="translate(25, 75) scale(0.6)" opacity="0.4">
        <circle cx="0" cy="0" r="3" fill="#ffffff"/>
        <circle cx="-3" cy="-5" r="2" fill="#ffffff"/>
        <circle cx="3" cy="-5" r="2" fill="#ffffff"/>
        <circle cx="-1" cy="-8" r="1.5" fill="#ffffff"/>
        <circle cx="1" cy="-8" r="1.5" fill="#ffffff"/>
    </g>
    
    <!-- Segunda huella -->
    <g transform="translate(75, 25) scale(0.5)" opacity="0.3">
        <circle cx="0" cy="0" r="3" fill="#ffffff"/>
        <circle cx="-3" cy="-5" r="2" fill="#ffffff"/>
        <circle cx="3" cy="-5" r="2" fill="#ffffff"/>
        <circle cx="-1" cy="-8" r="1.5" fill="#ffffff"/>
        <circle cx="1" cy="-8" r="1.5" fill="#ffffff"/>
    </g>
</svg>
