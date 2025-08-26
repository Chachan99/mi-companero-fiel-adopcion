# Configuración de Debug para Railway

## Variables de Entorno Necesarias para Debugging

Para diagnosticar el error 500 en Railway, necesitas configurar estas variables:

### 1. Habilitar Debug Mode (TEMPORAL)
```
APP_DEBUG=true
```
**IMPORTANTE:** Solo para debugging, cambiar a `false` en producción.

### 2. Configurar Logs para Railway
```
LOG_CHANNEL=errorlog
```
Esto hace que los logs aparezcan en la consola de Railway en lugar de archivos.

### 3. Verificar APP_KEY
```
APP_KEY=base64:b8uZ6ll/okxBhPXI6y0YK1dEsKmY9arfMqjitmemDFI=
```
Asegúrate de que esta variable esté configurada.

## Pasos para Debugging:

1. **Agregar variables en Railway Dashboard:**
   - Ve a tu servicio web en Railway
   - Sección "Variables"
   - Agregar: `APP_DEBUG=true`
   - Agregar: `LOG_CHANNEL=errorlog`

2. **Verificar en Logs de Railway:**
   - Ve a "Observability" en Railway
   - O haz clic en el deployment más reciente
   - Busca errores específicos de Laravel

3. **Causas Comunes del Error 500:**
   - Migraciones no ejecutadas (tablas faltantes)
   - Variables de entorno faltantes
   - Permisos de storage/
   - Conexión a base de datos fallida
   - APP_KEY no configurada

## Comandos de Verificación:

En Railway, estos comandos se ejecutan automáticamente:
```bash
# Migraciones (en nixpacks.toml)
php artisan migrate --force

# Cache (en nixpacks.toml)
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Filtros de Logs en Railway:

- Errores: `@level:error`
- Errores 500: `@httpStatus:500`
- Errores de Laravel: `"Laravel"`
- Errores de base de datos: `"SQLSTATE"`