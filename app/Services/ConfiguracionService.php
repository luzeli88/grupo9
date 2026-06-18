<?php

namespace App\Services;

use App\Models\Configuracion;

class ConfiguracionService
{
    /**
     * Obtiene los porcentajes de descuentos y recargos
     */
    public static function obtenerPorcentajes(): array
    {
        return [
            'descuento_transferencia' => (float) Configuracion::get('descuento_transferencia', 10),
            'recargo_credito_6'       => (float) Configuracion::get('recargo_credito_6', 0),
            'recargo_credito_mas6'    => (float) Configuracion::get('recargo_credito_mas6', 15),
        ];
    }

    /**
     * Calcula el descuento o recargo según el método de pago
     */
    public static function calcularAjuste(float $subtotal, string $metodo, ?int $cuotas = null): array
    {
        $pcts = self::obtenerPorcentajes();
        $descuento = 0;
        $recargo = 0;

        if ($metodo === 'transferencia') {
            $descuento = $subtotal * ($pcts['descuento_transferencia'] / 100);
        } elseif ($metodo === 'credito' && $cuotas !== null) {
            if ($cuotas > 6) {
                $recargo = $subtotal * ($pcts['recargo_credito_mas6'] / 100);
            } else {
                $recargo = $subtotal * ($pcts['recargo_credito_6'] / 100);
            }
        }

        return compact('descuento', 'recargo');
    }

    /**
     * Actualiza las configuraciones de pago
     */
    public static function actualizar(array $datos): void
    {
        $claves = ['descuento_transferencia', 'recargo_credito_6', 'recargo_credito_mas6'];
        foreach ($claves as $clave) {
            Configuracion::where('clave', $clave)
                ->update(['valor' => $datos[$clave] ?? 0]);
        }
    }
}

