<?php

declare(strict_types=1);

namespace Restaurante\Producto\Domain;

class ProductoSimple extends Producto {

      public function __construct(string $sku, string $nombre, float $costo, float $precio)
      {
          parent::__construct($sku, $nombre, $costo, $precio);
      }

      public function toArray() : array {
        return [
            'sku' => $this->getSku(),
            'nombre' => $this->getNombre(),
            'costo' => $this->getCosto(),
            'precio' => $this->getPrecio()
        ];
      }
}
