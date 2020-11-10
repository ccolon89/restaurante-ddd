<?php

namespace Restaurante\Producto\Infrastructure;

use Restaurante\Producto\Domain\IProductoSimpleRepository;
use Restaurante\Producto\Domain\ProductoSimple;
use Restaurante\Producto\Infrastructure\Eloquent\ProductoSimpleModel;

final class ProductoSimpleEloquentRepository implements IProductoSimpleRepository
{

    private ProductoSimpleModel $model;

    public function __construct(ProductoSimpleModel $model)
    {
        $this->model = $model;
    }

    public function save(ProductoSimple $productoSimple): void
    {
        $this->model->fill($productoSimple->toArray());
        $this->model->tipo = 'simple';
        $this->model->save();
    }

    public function search(string $sku): ?ProductoSimple
    {
         $producto = ProductoSimpleModel::find($sku);
         $producto = $producto!=null ? ProductoSimple::fromArray($producto->attributesToArray()) : null;
         return $producto;
    }
}
