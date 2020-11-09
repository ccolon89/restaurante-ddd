<?php


namespace Tests\Unit\Restaurante\Producto\Simple\Domain;


use Restaurante\Producto\Aplication\CrearProductoSimpleRequest;
use Restaurante\Producto\Domain\ProductoSimple;
use Tests\Unit\Restaurante\Shared\Domain\MotherCreator;
use Tests\Unit\Restaurante\Shared\Domain\UuidMother;
use Tests\Unit\Restaurante\Shared\Domain\WordMother;

final class ProductoSimpleMother
{
   public static function create(String $sku,String $nombre,float $costo,float $precio) : ProductoSimple{
       return new ProductoSimple($sku, $nombre, $costo, $precio);
   }

   public static function fromRequest(CrearProductoSimpleRequest $request) : ProductoSimple {
      return self::create(
         $request->sku(),
         $request->nombre(),
         $request->costo(),
         $request->precio()
      );
   }

   public function random() : ProductoSimple {
       return self::create(
          UuidMother::random(),
          WordMother::random(),
          MotherCreator::random()->randomFloat(2,1000,50000),
          MotherCreator::random()->randomFloat(2,1000,50000)
       );
   }
}
