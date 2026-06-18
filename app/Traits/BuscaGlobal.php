<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait BuscaGlobal
{
    /**
     * Aplica filtro de búsqueda por nombre/email
     */
    public function scopeBuscaPorNombre(Builder $query, ?string $buscar): Builder
    {
        if (!$buscar) {
            return $query;
        }

        $buscarLower = strtolower($buscar);
        return $query->whereRaw('LOWER(nombre) LIKE ?', ["%{$buscarLower}%"]);
    }

    /**
     * Aplica filtro de búsqueda por nombre o email
     */
    public function scopeBuscaPorNombreOEmail(Builder $query, ?string $buscar): Builder
    {
        if (!$buscar) {
            return $query;
        }

        $buscarLower = strtolower($buscar);
        return $query->whereRaw('LOWER(nombre) LIKE ?', ["%{$buscarLower}%"])
                     ->orWhereRaw('LOWER(email) LIKE ?', ["%{$buscarLower}%"]);
    }
}
