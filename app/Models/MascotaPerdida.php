<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MascotaPerdida extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mascotas_perdidas';

    protected $fillable = [
        'nombre',
        'tipo',
        'raza',
        'edad',
        'tipo_edad',
        'sexo',
        'descripcion',
        'imagen',
        'telefono_contacto',
        'email_contacto',
        'recompensa',
        'ultima_ubicacion',
        'latitud',
        'longitud',
        'direccion',
        'estado',
        'fecha_encontrado',
        'usuario_id',
        'fundacion_id',
    ];

    protected $casts = [
        'fecha_encontrado' => 'datetime',
        'edad' => 'integer',
        'latitud' => 'float',
        'longitud' => 'float',
    ];

    protected $dates = [
        'fecha_encontrado',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function fundacion()
    {
        return $this->belongsTo(Usuario::class, 'fundacion_id');
    }

    /**
     * Obtiene la URL completa de la imagen de la mascota.
     *
     * @return string
     */
    public function getImagenUrlAttribute()
    {
        if ($this->imagen && file_exists(public_path($this->imagen))) {
            return asset($this->imagen);
        }
        
        return asset('img/default-pet.jpg');
    }

    // Scopes
    public function scopePerdidos($query)
    {
        return $query->where('estado', 'perdido');
    }

    public function scopeEncontrados($query)
    {
        return $query->where('estado', 'encontrado');
    }
}
