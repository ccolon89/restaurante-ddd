<?php


namespace Tests\Feature\Producto\Simple;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

final class CrearProductoSimpleTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_save_a_new_product_simple(){
        $respose = $this->post('api/productoSimple',[
            'sku' => '1ad6784f-a836-48dc-9c30-ebc0535c7cb9',
            'nombre' => 'GASEOSA LITRO',
            'costo' => 2000,
            'precio' => 5000
        ]);

        $respose->assertStatus(Response::HTTP_CREATED);
    }

}
