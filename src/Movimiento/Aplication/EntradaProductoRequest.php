<?php

namespace Restaurante\Movimiento\Aplication;

final class EntradaProductoRequest
{

  private string $sku;
  private int $cantidad;
  private float $costo;


  public function __construct(string $sku, int $cantidad, float $costo)
  {
        $this->sku = $sku;
        $this->cantidad = $cantidad;
        $this->costo = $costo;
  }

    public function sku(): string
    {
        return $this->sku;
    }

    public function cantidad(): int
    {
        return $this->cantidad;
    }

    public function costo(): float
    {
        return $this->costo;
    }

}
