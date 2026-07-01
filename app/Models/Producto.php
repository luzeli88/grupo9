<?php

namespace App\Models;

use App\Traits\BuscaGlobal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\NotificacionReingreso;

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
    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function (Producto $producto) {
            $producto->notificaciones()->delete();
        });
    }

    public function talles()
    {
        return $this->hasMany(ProductoTalle::class);
    }

    public function notificaciones()
    {
        return $this->hasMany(NotificacionReingreso::class);
    }
}


