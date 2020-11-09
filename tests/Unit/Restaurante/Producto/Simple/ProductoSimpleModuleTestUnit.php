<?php

namespace Tests\Unit\Restaurante\Producto\Simple;

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Restaurante\Producto\Domain\IProductoSimpleRepository;
use Mockery;
use Restaurante\Producto\Domain\ProductoSimple;
use Tests\Unit\Restaurante\Shared\Domain\TestUtils;

class ProductoSimpleModuleTestUnit extends TestCase
{
    private  $repository;

    /**@return IProductoSimpleRepository | MockInterface */
    protected function repository() : MockInterface {
        return $this->repository = $this->repository ? : Mockery::mock(IProductoSimpleRepository::class);
    }

    protected function shouldSave(ProductoSimple $productoSimple) {
        $this->repository()
            ->shouldReceive('save')
            ->with(TestUtils::similarTo($productoSimple))
            ->once();
    }
}
