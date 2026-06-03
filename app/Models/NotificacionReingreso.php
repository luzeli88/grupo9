<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificacionReingreso extends Model
{
    use SoftDeletes;

    protected $table = 'notificacion_reingresos';
    protected $guarded = [];

    // Relación con Usuario - puede ser null si se suscribe sin estar logeado
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relación con Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
