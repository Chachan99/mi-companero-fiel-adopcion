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

# Configuración de Base de Datos PostgreSQL (Railway)
DB_CONNECTION=pgsql
DB_HOST=${{Postgres.PGHOST}}
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

## Verificación:

Después de configurar las variables:
1. Redespliega la aplicación
2. Verifica que no haya errores 500
3. Comprueba que la base de datos se conecte correctamente