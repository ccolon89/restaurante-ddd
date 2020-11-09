<?php

declare(strict_types=1);

namespace Restaurante\Movimiento\Domain;

use Restaurante\Producto\Domain\ProductoCompuesto;
use Restaurante\Producto\Domain\ProductoSimple;

final class Movimiento
{

    public function __construct()
   {
       $this->detalle_movimiento = [];
   }

   public function entrada(ProductoSimple $producto, int $cantidad,float $costo) : void {
       $detalle = new DetalleMovimiento($producto->getSku(),$cantidad,$costo,0,'ENTRADA');
       $this->detalle_movimiento[] = $detalle;
   }

   public function salida(ProductoSimple $producto, int $cantidad, float $costo,float $precio) : void {
        $detalle = new DetalleMovimiento($producto->getSku(),$cantidad,$costo,$precio,'SALIDA');
        $this->detalle_movimiento[] = $detalle;
   }

    public function salidaCompuesto(ProductoCompuesto $producto, int $cantidad,float $precio) : void {
        $detalle = new DetalleMovimiento($producto->getSku(),$cantidad,$producto->getCosto(),$precio,'SALIDA');
        $this->detalle_movimiento[] = $detalle;
        self::addDetallesProductoCompuesto($producto,$cantidad);
    }

    private function  addDetallesProductoCompuesto(ProductoCompuesto $producto, int $cantidad) : void {

        foreach ($producto->getIngredientes() as $ingrediente){
            $detalle = new DetalleMovimiento($ingrediente->getSku(),$cantidad,$ingrediente->getCosto(),$ingrediente->getPrecio(),'SALIDA');
            $this->detalle_movimiento[] = $detalle;
        }

        foreach ($producto->getProductos() as $value){
            self::addDetallesProductoCompuesto($value,$cantidad);
        }

    }

    public function getCantidad(string $sku) : int {
      $entradas = 0;
      $salidas = 0;
      foreach($this->detalle_movimiento as $value){
          if($value->equals($sku)){
              $entradas += $value->getTipo() == 'ENTRADA' ? $value->getCantidad() : 0;
              $salidas += $value->getTipo() == 'SALIDA' ? $value->getCantidad() : 0;
          }
      }
      return $entradas-$salidas;
   }
}
