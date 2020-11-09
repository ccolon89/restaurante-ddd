<?php

namespace Restaurante\Movimiento\Aplication;

use Restaurante\Movimiento\Domain\IMovimientoRepository;
use Restaurante\Movimiento\Domain\Movimiento;
use Restaurante\Producto\Domain\IProductoSimpleRepository;

final class EntradaProductoSimpleService
{
    private IMovimientoRepository $movimientoRepository;
    private IProductoSimpleRepository $productoRepository;

    public function __construct(IProductoSimpleRepository $productoRepository,IMovimientoRepository $movimientoRepository)
    {
       $this->productoRepository = $productoRepository;
       $this->movimientoRepository = $movimientoRepository;
    }

    public function __invoke(EntradaProductoSimpleRequest $request)
    {
        $movimiento = $this->movimientoRepository->get() ? : new Movimiento();
    }

}
