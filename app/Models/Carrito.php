<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carrito';
    
    protected $fillable = [
        'usuario_id',
        'producto_id',
        'talle',
        'cantidad',
        'precio_unitario',
        'total',
    ];

    // Relación con el producto del carrito.
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
