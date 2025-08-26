// Animaciones y transiciones suaves para mejorar la UX

// Función para observar elementos y aplicar animaciones al hacer scroll
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                // Añadir un pequeño delay para elementos consecutivos
                const delay = Array.from(entry.target.parentNode.children).indexOf(entry.target) * 100;
                entry.target.style.transitionDelay = `${delay}ms`;
            }
        });
    }, observerOptions);

    // Observar todos los elementos con la clase animate-on-scroll
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
}

// Función para añadir efectos hover suaves a las cards
function initCardAnimations() {
    document.querySelectorAll('.card, .card-elevated').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

// Función para añadir animaciones a los botones
function initButtonAnimations() {
    document.querySelectorAll('button, .btn-primary, .btn-secondary, .btn-outline').forEach(button => {
        button.addEventListener('click', function(e) {
            // Crear efecto ripple
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            `;
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
}

// Función para añadir animaciones suaves a los formularios
function initFormAnimations() {
    document.querySelectorAll('input, textarea, select').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentNode.classList.add('focused');
            if (this.nextElementSibling && this.nextElementSibling.tagName === 'LABEL') {
                this.nextElementSibling.style.transform = 'translateY(-20px) scale(0.85)';
                this.nextElementSibling.style.color = '#3b82f6';
            }
        });

        input.addEventListener('blur', function() {
            this.parentNode.classList.remove('focused');
            if (this.nextElementSibling && this.nextElementSibling.tagName === 'LABEL' && !this.value) {
                this.nextElementSibling.style.transform = 'translateY(0) scale(1)';
                this.nextElementSibling.style.color = '#6b7280';
            }
        });
    });
}

// Función para añadir animaciones de carga
function initLoadingAnimations() {
    // Añadir clase de fade-in a elementos principales al cargar la página
    window.addEventListener('load', function() {
        document.querySelectorAll('main, .container, .content').forEach(el => {
            el.classList.add('animate-fade-in');
        });
    });
}

// Función para añadir animaciones a las notificaciones
function initNotificationAnimations() {
    document.querySelectorAll('.alert, .notification, .toast').forEach(notification => {
        notification.style.animation = 'slideInRight 0.5s ease-out';
        
        // Auto-hide después de 5 segundos
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.5s ease-in';
            setTimeout(() => {
                notification.remove();
            }, 500);
        }, 5000);
    });
}

// Función para añadir animaciones de navegación
function initNavigationAnimations() {
    document.querySelectorAll('nav a, .nav-link').forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-1px)';
            this.style.transition = 'transform 0.2s ease';
        });

        link.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

// Función para añadir animaciones de scroll suave
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Función para añadir animaciones de parallax ligero
function initParallaxAnimations() {
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.parallax-element');
        
        parallaxElements.forEach(element => {
            const speed = element.dataset.speed || 0.5;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
}

// Añadir estilos CSS para las animaciones
function addAnimationStyles() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
        
        .focused {
            transform: scale(1.02);
            transition: transform 0.2s ease;
        }
        
        .parallax-element {
            will-change: transform;
        }
        
        /* Mejoras de performance */
        .animate-on-scroll,
        .card,
        .card-elevated,
        button,
        .btn-primary,
        .btn-secondary,
        .btn-outline {
            will-change: transform;
        }
    `;
    document.head.appendChild(style);
}

// Inicializar todas las animaciones cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    addAnimationStyles();
    initScrollAnimations();
    initCardAnimations();
    initButtonAnimations();
    initFormAnimations();
    initLoadingAnimations();
    initNotificationAnimations();
    initNavigationAnimations();
    initSmoothScroll();
    initParallaxAnimations();
    
    console.log('✨ Animaciones inicializadas correctamente');
});

// Exportar funciones para uso en otros archivos
window.AnimationUtils = {
    initScrollAnimations,
    initCardAnimations,
    initButtonAnimations,
    initFormAnimations,
    initLoadingAnimations,
    initNotificationAnimations,
    initNavigationAnimations,
    initSmoothScroll,
    initParallaxAnimations
};