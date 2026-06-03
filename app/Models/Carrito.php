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

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
