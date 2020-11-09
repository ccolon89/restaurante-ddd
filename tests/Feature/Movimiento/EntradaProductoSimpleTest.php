<?php

namespace Tests\Feature\Movimiento;

use Illuminate\Http\Response;
use Restaurante\Producto\Infrastructure\Eloquent\ProductoSimpleModel;
use Tests\TestCase;

final class EntradaProductoSimpleTest extends TestCase
{
       /**
        * @test
        */
       public function it_should_add_stock_to_inventario_of_a_producto_simple() {
           $this->prepareProductInInventario();
           $respose = $this->put('api/entrada/simple/cec512a2-fb17-4893-860f-2d6f8dae5f14',[
               'cantidad' => 2,
               'costo' => 1000
           ]);
           $respose->assertStatus(Response::HTTP_OK);
       }

       public function prepareProductInInventario(){
           factory(ProductoSimpleModel::class)->create([
              'sku' => 'cec512a2-fb17-4893-860f-2d6f8dae5f14',
              'nombre' => 'pan de perro',
              'costo' => '1000',
              'precio' => '2000'
           ]);
       }
}
