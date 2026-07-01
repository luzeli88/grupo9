<?php

namespace App\Models;

use App\Models\Carrito;
use App\Models\NotificacionReingreso;
use App\Traits\BuscaGlobal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Usuario extends Authenticatable implements CanResetPasswordContract
{
    use HasFactory, Notifiable, SoftDeletes, CanResetPassword, BuscaGlobal;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol_id',
        'telefono',
        'direccion',
        'ciudad',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function (Usuario $usuario) {
            $usuario->notificaciones()->delete();
        });
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function carrito()
    {
        return $this->hasMany(Carrito::class);
    }

    public function notificaciones()
    {
        return $this->hasMany(NotificacionReingreso::class);
    }
}
