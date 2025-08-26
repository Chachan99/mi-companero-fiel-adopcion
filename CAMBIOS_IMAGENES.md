# Cambios en el Sistema de Almacenamiento de Imágenes

## Resumen
Se ha unificado el sistema de almacenamiento de imágenes para que todas se guarden en la carpeta `public/img/` con sus respectivas subcarpetas.

## Estructura Nueva
```
public/img/
├── animales/           # Imágenes de animales de fundaciones
├── animales-perdidos/  # Imágenes de mascotas perdidas
├── fundaciones/        # Imágenes de perfiles de fundaciones
└── noticias/          # Imágenes de noticias
```

## Cambios Realizados

### 1. Controladores Actualizados
- **FundacionController.php**: 
  - Método `guardarImagen()` ahora guarda en `public/img/animales/`
  - Método `actualizarImagenPerfil()` guarda en `public/img/fundaciones/`
  - Métodos de eliminación actualizados para usar `unlink()` en lugar de Storage

- **AnimalPerdidoController.php**:
  - Mantiene el almacenamiento en `public/img/animales-perdidos/`
  - Nombres de archivo unificados con formato `uniqid()_timestamp.extensión`

- **NoticiaController.php**:
  - Ya estaba configurado correctamente para `public/img/noticias/`

### 2. Modelos Actualizados
- **Animal.php**: Método `getImagenUrlAttribute()` actualizado para buscar en las nuevas rutas
- **PerfilFundacion.php**: Método `getImagenUrlAttribute()` actualizado con compatibilidad hacia atrás
- **Noticia.php**: Método `getImagenUrlAttribute()` mejorado para mayor flexibilidad
- **MascotaPerdida.php**: Ya estaba configurado correctamente

### 3. Migración de Imágenes Existentes
- Se ejecutó un script que copió todas las imágenes de `storage/app/public/` a `public/img/`
- 27 imágenes de animales migradas
- 1 imagen de fundación migrada
- Todas las imágenes existentes mantienen compatibilidad

## Ventajas del Nuevo Sistema

1. **Simplicidad**: Todas las imágenes en una ubicación centralizada
2. **Acceso Directo**: No requiere enlaces simbólicos de Laravel Storage
3. **Consistencia**: Mismo patrón de nombres para todos los tipos de imágenes
4. **Mantenimiento**: Más fácil de gestionar y hacer backup
5. **Compatibilidad**: Los modelos mantienen compatibilidad con imágenes antiguas

## Formato de Nombres de Archivo
Todos los archivos nuevos siguen el formato:
```
uniqid()_timestamp.extensión
```
Ejemplo: `6892789dd52bb_1754429597.jpg`

## Rutas de Acceso
- **Animales**: `public/img/animales/`
- **Animales Perdidos**: `public/img/animales-perdidos/`
- **Fundaciones**: `public/img/fundaciones/`
- **Noticias**: `public/img/noticias/`

## Notas Importantes
- Las imágenes por defecto se mantienen en `public/img/`
- Los modelos incluyen fallbacks para compatibilidad
- El sistema anterior de `storage/app/public/` ya no se usa para nuevas imágenes
- Las imágenes existentes siguen funcionando normalmente