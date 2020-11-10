<?php

namespace Tests\Unit\Restaurante\Movimiento;

use Restaurante\Movimiento\Domain\IMovimientoRepository;
use Restaurante\Movimiento\Domain\Movimiento;
use Restaurante\Producto\Domain\IProductoSimpleRepository;
use Restaurante\Producto\Domain\ProductoSimple;
use Tests\TestCase;
use Mockery;

class EntradaModuleTestUnit extends  TestCase
{

    private $productoRepository;
    private $movimientoRepository;

    protected function productoRepository() {
        return $this->productoRepository  = $this->productoRepository ? : Mockery::mock(IProductoSimpleRepository::class);
    }

    protected function movimientoRepository()
    {
        return $this->movimientoRepository = $this->movimientoRepository ? : Mockery::mock(IMovimientoRepository::class);
    }

    protected function shouldSearhProducto(string $sku, ?ProductoSimple $producto) : void {
        $this->productoRepository()
            ->shouldReceive('search')
            ->with($sku)
            ->once()
            ->andReturn($producto);
    }

    protected function shouldGetAllTheMovimientos(?Movimiento $movimiento = null) {
        $this->movimientoRepository()
            ->shouldReceive('get')
            ->andReturn($movimiento ? : new Movimiento());
    }

    protected function shouldSaveTheMovimientos(Movimiento $movimiento) : void {
        $this->movimientoRepository
            ->shouldReceive('save')
            ->with(Mockery::on(function (Movimiento $item) use ($movimiento){
                return count($item->getDetalles()) == count($movimiento->getDetalles());
            }))
            ->once()
            ->andReturnNull();
    }


}
