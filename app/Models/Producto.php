<?php

namespace App\Models;

use App\Traits\BuscaGlobal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes, BuscaGlobal;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'precio_venta',
        'precio_compra',
        'stock',
        'stock_minimo',
        'descuento' ,
        'imagen' ,
    ];
    public function talles()
{
    return $this->hasMany(ProductoTalle::class);
}
}


