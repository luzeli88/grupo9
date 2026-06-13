<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'usuario_id',
        'subtotal',
        'total',
        'descuento',
        'recargo',
        'metodo_pago',
        'cuotas',
        'estado',
        'numero_factura',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function items()
    {
        return $this->hasMany(PedidoItem::class);
    }
}
