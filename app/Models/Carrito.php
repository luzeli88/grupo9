<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    // Laravel infiere el nombre de tabla en plural: "carritos".
    // Aquí forzamos el nombre correcto que existe en la base de datos: "carrito".
    protected $table = 'carrito';
    protected $guarded = [];

    // Relación con el producto del carrito.
    // Se usa en el controlador y vistas con Carrito::with('producto').
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    // Relación con el usuario propietario del carrito.
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
