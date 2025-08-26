# Guía de Despliegue - Mi Compañero Fiel

## Despliegue en Railway

### Prerrequisitos
1. Cuenta en [Railway](https://railway.app)
2. Repositorio en GitHub con el código
3. API Key de Google Maps

### Pasos para el Despliegue

#### 1. Preparar el Repositorio
- Asegúrate de que todos los archivos estén commitados
- El archivo `Procfile` y `nixpacks.toml` deben estar en la raíz

#### 2. Crear Proyecto en Railway
1. Ve a [Railway](https://railway.app) y crea una cuenta
2. Haz clic en "New Project"
3. Selecciona "Deploy from GitHub repo"
4. Conecta tu repositorio

#### 3. Configurar Base de Datos PostgreSQL

##### 3.1 Crear Base de Datos en Railway
1. En tu proyecto Railway, haz clic en "+ New" y selecciona "Database" → "Add PostgreSQL"
2. Espera a que se despliegue la base de datos (puede tomar unos minutos)
3. Ve a la pestaña "Variables" del servicio PostgreSQL

##### 3.2 Variables de Entorno de PostgreSQL
Railway proporciona automáticamente estas variables:
- `PGHOST` - Host de la base de datos
- `PGPORT` - Puerto (generalmente 5432)
- `PGUSER` - Usuario de la base de datos
- `PGPASSWORD` - Contraseña de la base de datos
- `PGDATABASE` - Nombre de la base de datos
- `DATABASE_URL` - URL completa de conexión (formato: postgresql://user:password@host:port/database)

##### 3.3 Configurar Variables en el Servicio de la Aplicación
En la pestaña "Variables" de tu servicio de aplicación Laravel, agrega:
```
DB_CONNECTION=pgsql
DB_HOST=${PGHOST}
DB_PORT=${PGPORT}
DB_DATABASE=${PGDATABASE}
DB_USERNAME=${PGUSER}
DB_PASSWORD=${PGPASSWORD}
```

**Nota:** Railway puede usar automáticamente `DATABASE_URL` si está disponible, pero es recomendable configurar las variables individuales para mayor compatibilidad con Laravel.

#### 4. Configurar Variables de Entorno

##### 4.1 Variables Obligatorias
En la pestaña "Variables" de tu servicio Laravel, configura estas variables esenciales:

```env
# Configuración de la Aplicación
APP_NAME="Mi Compañero Fiel"
APP_ENV=production
APP_KEY=base64:tu_app_key_aqui
APP_DEBUG=false
APP_URL=https://tu-dominio.railway.app

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=error

# Base de Datos PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=${PGHOST}
DB_PORT=${PGPORT}
DB_DATABASE=${PGDATABASE}
DB_USERNAME=${PGUSER}
DB_PASSWORD=${PGPASSWORD}

# Sesiones y Cache
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_DRIVER=database
QUEUE_CONNECTION=database

# Google Maps (Opcional)
GOOGLE_MAPS_API_KEY=tu_google_maps_api_key
```

##### 4.2 Generar APP_KEY
Para generar tu `APP_KEY`, ejecuta localmente:
```bash
php artisan key:generate --show
```
Copia el resultado (incluyendo "base64:") y úsalo como valor de `APP_KEY`.

##### 4.3 Configuración Adicional para Railway
Railway también puede requerir estas variables:
```env
# Para optimización en Railway
NIXPACKS_PKGS=php82Extensions.redis php82Extensions.gd
```

#### 5. Configurar Dominio
1. En la pestaña "Settings" de tu servicio
2. Sección "Domains"
3. Haz clic en "Generate Domain" o conecta tu dominio personalizado

#### 6. Desplegar la Aplicación

##### 6.1 Preparar el Repositorio
1. Asegúrate de que todos los archivos estén commiteados:
   ```bash
   git add .
   git commit -m "Preparar para despliegue en Railway"
   git push origin main
   ```

##### 6.2 Proceso de Despliegue
1. Railway detectará automáticamente los cambios y comenzará el despliegue
2. El proceso incluirá:
   - Instalación de dependencias PHP (composer install)
   - Instalación de dependencias Node.js (npm ci)
   - Construcción de assets (npm run build)
   - Ejecución de comandos definidos en nixpacks.toml
3. Monitorea los logs en tiempo real desde el dashboard de Railway

##### 6.3 Configurar Dominio Público
1. Una vez completado el despliegue, ve a Settings → Networking
2. Haz clic en "Generate Domain" para obtener una URL pública
3. Tu aplicación estará disponible en: `https://tu-app-nombre.up.railway.app`

### Comandos Post-Despliegue

#### 7.1 Migraciones de Base de Datos
Railway ejecutará automáticamente las migraciones gracias al `Procfile`, pero si necesitas ejecutarlas manualmente:

```bash
# Desde Railway CLI (si está instalado)
railway run php artisan migrate --force

# O desde el dashboard de Railway en la sección "Deploy Logs"
```

#### 7.2 Verificar el Estado de la Aplicación
Puedes verificar que todo funcione correctamente:
```bash
# Verificar migraciones
railway run php artisan migrate:status

# Verificar configuración
railway run php artisan config:show
```

### Monitoreo
- Railway proporciona logs en tiempo real
- Métricas de uso de CPU y memoria
- Alertas automáticas en caso de errores

### Costos
- Plan gratuito: $5 USD de créditos mensuales
- Suficiente para aplicaciones pequeñas a medianas
- Escalamiento automático según demanda

### Solución de Problemas

#### Error de Migración
```bash
php artisan migrate:fresh --force
php artisan db:seed --force
```

#### Error de Permisos de Storage
```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

#### Limpiar Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### URLs Importantes
- Panel de Administración: `/admin/login`
- Panel de Fundación: `/panel-fundacion/panel`
- API de Animales: `/api/animales`

### Backup de Base de Datos
Railway proporciona backups automáticos de PostgreSQL.
Para backups manuales, usa:
```bash
pg_dump $DATABASE_URL > backup.sql
```