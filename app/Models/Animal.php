<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

/**
 * Modelo que representa un animal en el sistema de adopción.
 * 
 * @property int $id
 * @property string $nombre
 * @property string $tipo
 * @property string $raza
 * @property int $edad
 * @property string $tipo_edad
 * @property string $sexo
 * @property string $descripcion
 * @property string $imagen
 * @property int $fundacion_id
 * @property string $estado
 * @property string|null $latitud
 * @property string|null $longitud
 * @property string|null $direccion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PerfilFundacion $fundacion
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Donacion[] $donaciones
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SolicitudAdopcion[] $solicitudesAdopcion
 */
class Animal extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'animales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fundacion_id',
        'nombre',
        'tipo',
        'raza',
        'edad',
        'tipo_edad',
        'sexo',
        'descripcion',
        'imagen',
        'estado',
        'tipo_publicacion',
        'telefono_contacto',
        'email_contacto',
        'recompensa',
        'ultima_ubicacion',
        'latitud',
        'longitud',
        'direccion',
        'fecha_ingreso'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['imagen_url'];



    /**
     * Obtiene la fundación a la que pertenece el animal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fundacion()
    {
        return $this->belongsTo(PerfilFundacion::class, 'fundacion_id', 'usuario_id');
    }

    /**
     * Obtiene las donaciones asociadas al animal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function donaciones()
    {
        return $this->hasMany(Donacion::class, 'animal_id');
    }

    /**
     * Obtiene las solicitudes de adopción del animal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solicitudesAdopcion()
    {
        return $this->hasMany(SolicitudAdopcion::class, 'animal_id');
    }

    /**
     * Obtiene la URL completa de la imagen del animal.
     *
     * @return string
     */
    public function getImagenUrlAttribute()
    {
        if (empty($this->imagen)) {
            return asset('img/animal-default.jpg');
        }

        // Si la imagen ya es una URL completa, la devolvemos directamente
        if (filter_var($this->imagen, FILTER_VALIDATE_URL)) {
            return $this->imagen;
        }

        // Verificar si la imagen existe en la ruta especificada
        $rutaDirecta = ltrim($this->imagen, '/');
        if (file_exists(public_path($rutaDirecta))) {
            return asset($rutaDirecta);
        }

        // Intentar con la ruta de storage (para compatibilidad con imágenes antiguas)
        $rutaStorage = 'storage/' . ltrim($this->imagen, '/');
        if (file_exists(public_path($rutaStorage))) {
            return asset($rutaStorage);
        }

        // Si no se encuentra la imagen, devolvemos la imagen por defecto
        return asset('img/animal-default.jpg');
    }
}
