<?php

namespace Restaurante\Producto\Domain;

interface IProductoSimpleRepository
{
    public function save(ProductoSimple $productoSimple ) : void;
}
