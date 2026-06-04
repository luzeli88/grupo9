<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoTalle extends Model
{
    protected $table = 'producto_talles';

    protected $fillable = [
        'producto_id',
        'talle',
        'stock',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
