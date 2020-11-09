<?php

namespace Tests\Unit\Restaurante\Producto\Simple\Aplication;

use Restaurante\Producto\Aplication\CrearProductoSimpleService;
use Tests\Unit\Restaurante\Producto\Simple\Domain\ProductoSimpleMother;
use Tests\Unit\Restaurante\Producto\Simple\ProductoSimpleModuleTestUnit;

final class CrearProductoSimpleServiceTestUnit extends ProductoSimpleModuleTestUnit
{

    private CrearProductoSimpleService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service =  new CrearProductoSimpleService($this->repository());
    }

    /**
     * @test
     */
    public function it_should_save_a_producto_simple() : void {

        $request = CrearProductoSimpleRequestMother::random();
        $producto = ProductoSimpleMother::fromRequest($request);
        $this->shouldSave($producto);
        $this->service->__invoke($request);
    }
}
