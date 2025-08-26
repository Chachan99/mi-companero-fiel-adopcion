<?php                                           
        
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\SolicitudAdopcion;
use App\Models\Noticia;

class PerfilFundacion extends Model
{
    use HasFactory;

    protected $table = 'perfil_fundaciones';

    protected $fillable = [
        'usuario_id',
        'nombre',
        'descripcion',
        'direccion',
        'telefono',
        'email',
        'sitio_web',
        'facebook',
        'instagram',
        'imagen',
        'banco',
        'tipo_cuenta',
        'numero_cuenta',
        'titular_cuenta',
        'identificacion_titular',
        'tipo_identificacion',
        'email_contacto_pagos',
        'otros_metodos_pago'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function animales()
    {
        return $this->hasMany(Animal::class, 'fundacion_id', 'usuario_id');
    }

    public function donaciones()
    {
        return $this->hasMany(Donacion::class, 'usuario_id', 'usuario_id');
    }

    public function solicitudesAdopcion()
    {
        return $this->hasMany(SolicitudAdopcion::class, 'fundacion_id', 'usuario_id');
    }

    public function noticias()
    {
        return $this->hasMany(Noticia::class, 'fundacion_id', 'id');
    }

    /**
     * Obtiene la URL completa de la imagen del perfil de la fundación.
     *
     * @return string
     */
    public function getImagenUrlAttribute()
    {
        if (empty($this->imagen)) {
            return asset('img/fundacion-default.jpg');
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
        return asset('img/fundacion-default.jpg');
    }
}
