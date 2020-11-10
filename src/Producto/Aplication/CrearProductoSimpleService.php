<?php

namespace Restaurante\Producto\Aplication;

use Restaurante\Producto\Domain\IProductoSimpleRepository;
use Restaurante\Producto\Domain\ProductoSimple;
use Restaurante\Producto\Domain\ProductoSimpleDuplicado;

final class CrearProductoSimpleService
{

    private IProductoSimpleRepository $repository;

    public function __construct(IProductoSimpleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CrearProductoSimpleRequest  $request)
    {
        $producto = $this->repository->search($request->sku());
        if($producto!=null)
            throw new ProductoSimpleDuplicado($producto->getSku());
        
        $producto = new ProductoSimple(
            $request->sku(),
            $request->nombre(),
            $request->costo(),
            $request->precio()
        );

        $this->repository->save($producto);
    }

}
