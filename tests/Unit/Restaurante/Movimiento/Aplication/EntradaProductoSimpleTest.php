<?php

namespace Tests\Unit\Restaurante\Movimiento\Aplication;

use PHPUnit\Framework\TestCase;
use Restaurante\Movimiento\Aplication\EntradaProductoSimpleService;
use Mockery;
use Restaurante\Movimiento\Domain\IMovimientoRepository;
use Restaurante\Movimiento\Domain\Movimiento;
use Restaurante\Producto\Domain\IProductoSimpleRepository;
use Restaurante\Producto\Domain\ProductoSimple;
use Tests\Unit\Restaurante\Movimiento\Domain\EntradaProductoRequestMother;
use Tests\Unit\Restaurante\Movimiento\EntradaModuleTestUnit;
use Tests\Unit\Restaurante\Producto\Simple\Domain\ProductoSimpleMother;

class EntradaProductoSimpleTest extends EntradaModuleTestUnit
{

    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new EntradaProductoSimpleService($this->productoRepository(),$this->movimientoRepository());
    }

    /**
     * @test
     */
    public function it_should_save_a_input_of_a_product_simple() : void {
        $movimientos = new Movimiento();
        $request = EntradaProductoRequestMother::random();
        $producto = ProductoSimpleMother::random();
        $this->shouldSearhProducto($request->sku(),$producto);
        $this->shouldGetAllTheMovimientos($movimientos);
        $this->shouldSaveTheMovimientos($movimientos);
        $this->service->__invoke($request);
    }


}
