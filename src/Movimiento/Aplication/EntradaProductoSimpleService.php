<?php

namespace Restaurante\Movimiento\Aplication;

use Restaurante\Movimiento\Domain\IMovimientoRepository;
use Restaurante\Producto\Domain\IProductoSimpleRepository;
use Restaurante\Producto\Domain\ProductoNoExiste;

final class EntradaProductoSimpleService
{
    private IMovimientoRepository $movimientoRepository;
    private IProductoSimpleRepository $productoRepository;

    public function __construct(IProductoSimpleRepository $productoRepository,IMovimientoRepository $movimientoRepository)
    {
       $this->productoRepository = $productoRepository;
       $this->movimientoRepository = $movimientoRepository;
    }

    public function __invoke(EntradaProductoRequest $request)
    {
        $producto = $this->productoRepository->search($request->sku());

        if($producto == null)
            throw new ProductoNoExiste($request->sku());

        $movimientos = $this->movimientoRepository->get();
        $movimientos->entrada($producto,$request->cantidad(),$request->costo());
        $this->movimientoRepository->save($movimientos);
    }

}
