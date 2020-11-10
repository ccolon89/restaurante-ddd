<?php

namespace Restaurante\Movimiento\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class MovimientoModel extends Model
{
   protected $table = 'movimientos';
   protected $fillable = ['id','sku','cantidad','costo','precio','tipo'];
}
