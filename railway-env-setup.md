# Configuración de Variables de Entorno para Railway

## Variables Obligatorias para Railway

Copia y pega estas variables en la sección "Variables" de tu proyecto Railway:

```env
# Configuración de la Aplicación
APP_NAME="Mi Compañero Fiel"
APP_ENV=production
APP_KEY=base64:b8uZ6ll/okxBhPXI6y0YK1dEsKmY9arfMqjitmemDFI=
APP_DEBUG=false
APP_URL=https://web-production-28d0.up.railway.app

# Configuración de Base de Datos PostgreSQL (Railway - Endpoint Privado)
DB_CONNECTION=pgsql
DB_HOST=${{Postgres.RAILWAY_PRIVATE_DOMAIN}}
DB_PORT=${{Postgres.PGPORT}}
DB_DATABASE=${{Postgres.PGDATABASE}}
DB_USERNAME=${{Postgres.PGUSER}}
DB_PASSWORD=${{Postgres.PGPASSWORD}}

# Configuración de Sesiones y Cache
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database

# Configuración de Queue
QUEUE_CONNECTION=database

# Configuración de Logs
LOG_CHANNEL=stack
LOG_LEVEL=error

# Configuración de Broadcasting
BROADCAST_CONNECTION=log

# Configuración de Filesystem
FILESYSTEM_DISK=local
```

## Pasos para Configurar en Railway:

1. Ve a tu proyecto en Railway
2. Haz clic en la pestaña "Variables"
3. Copia y pega cada variable una por una
4. Asegúrate de que la base de datos PostgreSQL esté conectada
5. Redespliega la aplicación

## Variables Importantes:

- `APP_URL`: Debe coincidir con tu dominio de Railway
- `DB_*`: Usa las variables de referencia de Railway `${{Postgres.*}}`
- `APP_DEBUG=false`: Importante para producción
- `LOG_LEVEL=error`: Reduce logs innecesarios

## ⚠️ Importante - Optimización de Costos:

**USAR ENDPOINTS PRIVADOS**: Railway cobra por tráfico de egress cuando usas endpoints públicos.
- ✅ **CORRECTO**: `DB_HOST=${{Postgres.RAILWAY_PRIVATE_DOMAIN}}`
- ❌ **EVITAR**: `DB_HOST=${{Postgres.PGHOST}}` (endpoint público)

Esto evita costos adicionales de egress en Railway.

## 🔧 Solución para "Database Connection" Colgado:

Si la conexión se queda en "Database Connection" sin avanzar:

### Paso 1: Verificar Variables de Entorno
```bash
# En Railway, ve a Variables y confirma:
DB_CONNECTION=pgsql
DB_HOST=${{Postgres.RAILWAY_PRIVATE_DOMAIN}}  # ¡IMPORTANTE: Usar endpoint privado!
DB_PORT=${{Postgres.PGPORT}}
DB_DATABASE=${{Postgres.PGDATABASE}}
DB_USERNAME=${{Postgres.PGUSER}}
DB_PASSWORD=${{Postgres.PGPASSWORD}}
```

### Paso 2: Verificar Estado del Servicio PostgreSQL
- En Railway Dashboard → Tu Proyecto → PostgreSQL
- Confirma que el estado sea "Active" (verde)
- Si está "Deploying" o "Error", espera o reinicia el servicio

### Paso 3: Scripts de Diagnóstico
Usa estos archivos para diagnosticar:
- `test-db-connection.php` - Test directo de conexión
- `railway-laravel-check.php` - Verificación completa de Laravel
- `railway-debug.php` - Diagnóstico general

### Paso 4: Forzar Redespliegue
- En Railway: Settings → Redeploy
- O hacer un push vacío: `git commit --allow-empty -m "Force redeploy" && git push`

## Verificación:

Después de configurar las variables:
1. Redespliega la aplicación
2. Verifica que no haya errores 500
3. Comprueba que la base de datos se conecte correctamente
4. Confirma que uses endpoints privados para evitar costos
5. Ejecuta los scripts de diagnóstico si persisten problemas