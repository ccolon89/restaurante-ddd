<?php

namespace Restaurante\Movimiento\Domain;

interface IMovimientoRepository
{
  public function save(Movimiento $movimiento) : void;
  public function get() : Movimiento;
}
