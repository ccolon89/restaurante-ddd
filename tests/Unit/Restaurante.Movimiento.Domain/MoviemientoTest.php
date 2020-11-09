<?php

namespace Tests\Unit\Restaurante\Movimieto\Domain;

use PHPUnit\Framework\TestCase;
use Restaurante\Movimiento\Domain\Movimiento;
use Restaurante\Producto\Domain\ProductoCompuesto;
use Restaurante\Producto\Domain\ProductoSimple;

class MoviemientoTest extends  TestCase
{

    /*
     *
        Escenario:  entrada del producto correcto.
        HU 1.  COMO USUARIO QUIERO REGISTRAR LA ENTRADA DE PRODUCTOS
        Criterio de Aceptación:
        1.1. La cantidad de la entrada debe ser mayor a 0.
        1.2. La cantidad de la entrada se le aumentará a la cantidad existente del producto.
        Dado
        El administrador tiene un producto: Nombre: Gaseosa litro costo: 2.000 precio: 5.000
        con un inventario de 0 unidades.
        Cuando
        va a ingresar 5 unidades en stock
        Entonces
        el inventario quedará con 5 unidades de gaseosa litro.
     */
     public function testEntradaDelProductoCorrecta() : void {
        $producto = new ProductoSimple('PROD-001','Gaseosa Litro',2000,5000);
        $movimientos = new Movimiento();
        $movimientos->entrada($producto,5,2000);
        $resultado = $movimientos->getCantidad($producto->getSku());
        $this->assertEquals(5,$resultado);
     }


     /*
      *
        Escenario:  entrada del producto incorrecta
        HU 1. COMO USUARIO QUIERO REGISTRAR LA ENTRADA DE PRODUCTOS.
        Criterio de Aceptación:
        1.1 .La cantidad de la entrada debe ser mayor a 0.
        Dado
        El administrador tiene un producto: Nombre: Gaseosa litro costo: 2.000 precio: 5.000 tipo: Simple.
        con un inventario de 0 unidades en stock.
        Cuando
        va a ingresar -10 unidades en stock
        Entonces
        El sistema presentará el mensaje “cantidad incorrecta” AND el stock quedará en 0 unidades.
      */

     public function testEntradaDelProductoIncorrecta() : void {
         $producto = new ProductoSimple('PROD-001','Gaseosa Litro',2000,5000);
         $movimientos = new Movimiento();
         try{
             $resultado = $movimientos->getCantidad($producto->getSku());
             $movimientos->entrada($producto,-10,2000);
             $this->assertEquals(0,$resultado);
         }catch (\Exception $exception){
              $this->assertEquals('cantidad incorrecta',$exception->getMessage());
         }
     }


     /*
      *
        Escenario:  cantidad de salida incorrecta de un producto simple.
        HU 2. COMO USUARIO QUIERO REGISTRAR LA SALIDA PRODUCTOS
        Criterio de Aceptación:
        1.1 1. La cantidad de la salida de debe ser mayor a 0
        Dado
        El administrador tiene un producto: Nombre: Gaseosa litro costo: 2.000 precio: 5.000 tipo: Simple
        con inventario de ese producto en 10 unidades.
        Cuando
        va a realizar una salida de -5 unidades
        Entonces
        El sistema presentará el mensaje  “cantidad incorrecta” AND el stock quedará en 10 unidades.
      */
     public function testSalidaIncorrectaDeUnProductoSimple() : void {
         $producto = new ProductoSimple('PROD-001','Gaseosa Litro',2000,5000);
         $movimientos = new Movimiento();
         try{
             $resultado = $movimientos->getCantidad($producto->getSku());
             $movimientos->entrada($producto,10,2000);
             $movimientos->salida($producto,-5,2000,5000);
             $this->assertEquals(10,$resultado);
         }catch (\Exception $exception){
             $this->assertEquals('cantidad incorrecta',$exception->getMessage());
         }
     }


     /*
      *
            Escenario:  cantidad de salida correcta de un producto simple.
            HU 2. COMO USUARIO QUIERO REGISTRAR LA SALIDA PRODUCTOS
            Criterio de Aceptación:
            1.1. La cantidad de la salida de debe ser mayor a 0
            1.2. En caso de un producto sencillo la cantidad de la salida se le disminuirá a la cantidad existente del producto.
            Dado
            El administrador tiene un producto: Nombre: Gaseosa litro costo: 2.000 precio: 5.000 tipo: Simple.
            con un inventario de 10 unidades en stock.
            Cuando
            va a realizar una salida de 5 unidades
            Entonces
            El stock quedará en 5 unidades.
      */
     public function testCantidadDeSalidaCorrectaDeUnProductoSimple() :void {
         $producto = new ProductoSimple('PROD-001','Gaseosa Litro',2000,5000);
         $movimientos = new Movimiento();
         $movimientos->entrada($producto,10,2000);
         $movimientos->salida($producto,5,2000,5000);
         $resultado = $movimientos->getCantidad($producto->getSku());
         $this->assertEquals(5,$resultado);
     }


     public function testSalidaDeUnProductoCompuesto() : void {
         $producto1 = new ProductoSimple('PROD-001','salchicha',1000,1000);
         $producto2 = new ProductoSimple('PROD-002','pan de perro',1000,1000);
         $producto3 = new ProductoSimple('PROD-003','lamina de queso',1000,1000);
         $producto = new ProductoCompuesto('PROD-004', 'perro sencillo', 5000);
         $producto->addIngrediente($producto1);
         $producto->addIngrediente($producto2);
         $producto->addIngrediente($producto3);
         $movimientos = new Movimiento();
         $movimientos->entrada($producto1,4,1000);
         $movimientos->entrada($producto2,3,1000);
         $movimientos->entrada($producto3,7,1000);
         $movimientos->salidaCompuesto($producto,1,5000);
         $resultado = [
                            $movimientos->getCantidad($producto1->getSku()),
                            $movimientos->getCantidad($producto2->getSku()),
                            $movimientos->getCantidad($producto3->getSku()),
                      ];
         $this->assertSame([3,2,6],$resultado);
     }



}
