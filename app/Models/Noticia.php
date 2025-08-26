<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Noticia extends Model
{
    use SoftDeletes;

    protected $table = 'noticias';

    protected $fillable = [
        'fundacion_id',
        'titulo',
        'slug',
        'contenido',
        'imagen',
        'publicada',
        'fecha_publicacion',
        'resumen',
        'autor',
        'usuario_id',
        'destacada',
        'estado',
        'publicado_en',
        'vistas'
    ];

    protected $casts = [
        'publicada' => 'boolean',
        'fecha_publicacion' => 'datetime',
        'deleted_at' => 'datetime',
        'destacada' => 'boolean',
        'publicado_en' => 'datetime',
        'vistas' => 'integer',
    ];
    
    protected $dates = [
        'fecha_publicacion',
        'publicado_en',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $appends = [
        'imagen_url',
        'publicado_en',
        'resumen_corto',
        'ruta',
        'esta_publicada'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($noticia) {
            $noticia->slug = Str::slug($noticia->titulo);
            
            // Asegurarse de que el slug sea único
            $originalSlug = $slug = $noticia->slug;
            $count = 1;
            
            while (static::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            
            $noticia->slug = $slug;
            
            // Si es una nueva noticia y no tiene autor, asignar el usuario autenticado
            if (auth()->check() && !$noticia->usuario_id) {
                $noticia->usuario_id = auth()->id();
                $noticia->autor = $noticia->autor ?? auth()->user()->name;
            }
            
            // Si se está publicando la noticia, establecer la fecha de publicación
            if ($noticia->estado === 'publicada' && !$noticia->publicado_en) {
                $noticia->publicado_en = now();
            }
        });

        static::updating(function ($noticia) {
            // Si se está publicando la noticia, establecer la fecha de publicación
            if ($noticia->isDirty('estado') && $noticia->estado === 'publicada' && !$noticia->publicado_en) {
                $noticia->publicado_en = now();
            }
        });
    }

    public function getPublicadoEnAttribute()
    {
        // Si tienes un campo 'publicado_en' en la base de datos
        return $this->attributes['publicado_en'] ?? $this->created_at;
        
        // O si 'publicado_en' es una fecha calculada:
        // return $this->fecha_publicacion ?? $this->created_at;
    }

    /**
     * Obtener el usuario que creó la noticia.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    
    /**
     * Obtener la fundación a la que pertenece la noticia.
     */
    public function fundacion()
    {
        return $this->belongsTo(PerfilFundacion::class, 'fundacion_id');
    }

    /**
     * Obtener un resumen corto del contenido.
     */
    public function getResumenCortoAttribute()
    {
        $resumen = $this->resumen ?: $this->contenido;
        return Str::limit(strip_tags($resumen), 200);
    }

    /**
     * Obtener la URL completa de la imagen.
     */
    public function getImagenUrlAttribute()
    {
        if (empty($this->imagen)) {
            return asset('img/placeholder-news.jpg');
        }

        // Si la imagen ya es una URL completa, la devolvemos directamente
        if (filter_var($this->imagen, FILTER_VALIDATE_URL)) {
            return $this->imagen;
        }

        // Verificar si la imagen existe en img/noticias/
        if (file_exists(public_path('img/noticias/' . $this->imagen))) {
            return asset('img/noticias/' . $this->imagen);
        }

        // Verificar si la imagen existe en la ruta especificada directamente
        $rutaDirecta = ltrim($this->imagen, '/');
        if (file_exists(public_path($rutaDirecta))) {
            return asset($rutaDirecta);
        }

        return asset('img/placeholder-news.jpg');
    }
    
    /**
     * Obtener la ruta de la noticia.
     */
    public function getRutaAttribute()
    {
        return route('noticias.show', $this->slug);
    }
    
    /**
     * Verificar si la noticia está publicada.
     */
    public function getEstaPublicadaAttribute()
    {
        return $this->estado === 'publicada' && 
               ($this->publicado_en === null || $this->publicado_en->isPast());
    }

    /**
     * Scope para obtener solo noticias publicadas.
     */
    public function scopePublicadas($query)
    {
        return $query->where('estado', 'publicada')
                    ->where(function($q) {
                        $q->whereNull('publicado_en')
                          ->orWhere('publicado_en', '<=', now());
                    });
    }
    
    /**
     * Scope para obtener noticias destacadas.
     */
    public function scopeDestacadas($query, $limit = 3)
    {
        return $query->where('destacada', true)
                    ->publicadas()
                    ->take($limit);
    }
    
    /**
     * Scope para buscar noticias por término.
     */
    public function scopeBuscar($query, $termino)
    {
        return $query->where(function($q) use ($termino) {
            $q->where('titulo', 'like', "%{$termino}%")
              ->orWhere('contenido', 'like', "%{$termino}%")
              ->orWhere('resumen', 'like', "%{$termino}%");
        });
    }


}
