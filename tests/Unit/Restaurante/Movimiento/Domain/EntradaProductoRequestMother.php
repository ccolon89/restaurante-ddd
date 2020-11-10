<?php

namespace Tests\Unit\Restaurante\Movimiento\Domain;

use Restaurante\Movimiento\Aplication\EntradaProductoRequest;
use Tests\Unit\Restaurante\Shared\Domain\IntegerMother;
use Tests\Unit\Restaurante\Shared\Domain\MotherCreator;
use Tests\Unit\Restaurante\Shared\Domain\UuidMother;

final class EntradaProductoRequestMother
{

    public static function create(string $sku, int $cantidad, float $costo) : EntradaProductoRequest {
        return new EntradaProductoRequest($sku,$cantidad,$costo);
    }

    public static function random() : EntradaProductoRequest {
        return self::create(
            UuidMother::random(),
            IntegerMother::moreThan(1),
            MotherCreator::random()->randomFloat(2,1000,20000)
        );
    }

}
