# Mi Compañero Fiel - Guía Rápida de Despliegue

## 🚀 Despliegue en Railway

Esta aplicación Laravel está configurada para desplegarse fácilmente en Railway con PostgreSQL.

### Pasos Rápidos

1. **Crear cuenta en Railway**: [railway.app](https://railway.app)
2. **Crear nuevo proyecto** desde GitHub
3. **Agregar PostgreSQL** al proyecto
4. **Configurar variables de entorno** (ver sección abajo)
5. **Generar dominio público**

### Variables de Entorno Requeridas

```env
APP_NAME="Mi Compañero Fiel"
APP_ENV=production
APP_KEY=base64:b8uZ6ll/okxBhPXI6y0YK1dEsKmY9arfMqjitmemDFI=
APP_DEBUG=false
APP_URL=https://tu-dominio.railway.app

DB_CONNECTION=pgsql
DB_HOST=${PGHOST}
DB_PORT=${PGPORT}
DB_DATABASE=${PGDATABASE}
DB_USERNAME=${PGUSER}
DB_PASSWORD=${PGPASSWORD}

SESSION_DRIVER=database
CACHE_DRIVER=database
QUEUE_CONNECTION=database

GOOGLE_MAPS_API_KEY=tu_api_key_opcional
```

### Archivos de Configuración Incluidos

- ✅ `Procfile` - Comandos de inicio y release
- ✅ `nixpacks.toml` - Configuración de build para Railway
- ✅ `.env.example` - Template de variables de entorno
- ✅ `DEPLOYMENT.md` - Guía detallada paso a paso

### Características de la Aplicación

- 🐕 Sistema de adopción de animales
- 👥 Gestión de usuarios y fundaciones
- 📰 Sistema de noticias
- 💰 Gestión de donaciones
- 🔍 Búsqueda de mascotas perdidas
- 🗺️ Integración con Google Maps
- 📱 Diseño responsive

### Tecnologías

- **Backend**: Laravel 12.x, PHP 8.2+
- **Frontend**: Blade, Bootstrap, JavaScript
- **Base de Datos**: PostgreSQL
- **Hosting**: Railway
- **Assets**: Vite

### Enlaces Útiles

- 📖 [Guía Completa de Despliegue](./DEPLOYMENT.md)
- 🚂 [Documentación de Railway](https://docs.railway.com)
- 🐘 [Laravel en Railway](https://docs.railway.com/guides/laravel)

### Soporte

Si encuentras problemas durante el despliegue, revisa:
1. Los logs de Railway en tiempo real
2. La configuración de variables de entorno
3. El estado de la base de datos PostgreSQL
4. La guía detallada en `DEPLOYMENT.md`

---

**¡Tu aplicación estará lista en minutos!** 🎉