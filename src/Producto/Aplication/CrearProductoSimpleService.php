<?php

namespace Restaurante\Producto\Aplication;

use Restaurante\Producto\Domain\IProductoSimpleRepository;
use Restaurante\Producto\Domain\ProductoSimple;

final class CrearProductoSimpleService
{

    private IProductoSimpleRepository $repository;

    public function __construct(IProductoSimpleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CrearProductoSimpleRequest  $request)
    {
        $producto = new ProductoSimple(
            $request->sku(),
            $request->nombre(),
            $request->costo(),
            $request->precio()
        );

        $this->repository->save($producto);
    }

}
