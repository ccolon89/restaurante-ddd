<?php

namespace Restaurante\Producto\Aplication;

class CrearProductoSimpleRequest
{
    private $sku;
    private $nombre;
    private $costo;
    private $precio;

    public function __construct($sku, $nombre, $costo, $precio)
    {
        $this->sku = $sku;
        $this->nombre = $nombre;
        $this->costo = $costo;
        $this->precio = $precio;
    }

    public function sku()
    {
        return $this->sku;
    }

    public function nombre()
    {
        return $this->nombre;
    }

    public function costo()
    {
        return $this->costo;
    }

    public function precio()
    {
        return $this->precio;
    }


}
