<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoTalle extends Model
{
    protected $table = 'producto_talles';
public $timestamps = false;
public $incrementing = false;        // le decimos que no hay id autoincremental
protected $primaryKey = null;        // sin primary key

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
