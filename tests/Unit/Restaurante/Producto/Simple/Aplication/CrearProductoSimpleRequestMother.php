<?php


namespace Tests\Unit\Restaurante\Producto\Simple\Aplication;


use Restaurante\Producto\Aplication\CrearProductoSimpleRequest;
use Tests\Unit\Restaurante\Shared\Domain\MotherCreator;
use Tests\Unit\Restaurante\Shared\Domain\UuidMother;
use Tests\Unit\Restaurante\Shared\Domain\WordMother;

final class CrearProductoSimpleRequestMother
{
    public static function create(string $sku, string $nombre,float $costo,float $precio) : CrearProductoSimpleRequest {
       return new CrearProductoSimpleRequest( $sku, $nombre, $costo, $precio );
    }

    public static function random() : CrearProductoSimpleRequest {
        return self::create(
           UuidMother::random(),
           WordMother::random(),
           MotherCreator::random()->randomFloat(2,1000,20000),
           MotherCreator::random()->randomFloat(2,1000,20000)
        );
    }
}
