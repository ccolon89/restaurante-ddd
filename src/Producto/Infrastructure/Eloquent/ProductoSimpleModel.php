<?php

namespace Restaurante\Producto\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ProductoSimpleModel extends Model
{
    protected $keyType  = 'string';
    protected $primaryKey = 'sku';
    protected $table = 'productos';
    protected $fillable = ['sku','nombre','costo','precio','tipo'];
}
