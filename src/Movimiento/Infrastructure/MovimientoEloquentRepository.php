<?php


namespace Restaurante\Movimiento\Infrastructure;

use Illuminate\Support\Facades\DB;
use Restaurante\Movimiento\Domain\IMovimientoRepository;
use Restaurante\Movimiento\Domain\Movimiento;
use Restaurante\Movimiento\Infrastructure\Eloquent\MovimientoModel;
use Restaurante\Producto\Domain\ProductoSimple;
use Restaurante\Producto\Infrastructure\Eloquent\ProductoSimpleModel;

class MovimientoEloquentRepository implements  IMovimientoRepository
{

    private MovimientoModel $model;

    public function __construct()
    {
        $this->model = new MovimientoModel();
    }

    public function save(Movimiento $movimiento): void
    {
        DB::statement("SET foreign_key_checks=0");
        MovimientoModel::truncate();
        DB::statement("SET foreign_key_checks=1");
        $detalles = $movimiento->getDetalles();
        foreach ($detalles as $detalle) {
            $this->model->fill($detalle->toArray());
            $this->model->save();
        }
    }

    public function get(): Movimiento
    {
       $detalles = MovimientoModel::all();
       $movimientos = new Movimiento();
       if(count($detalles) > 0){
           foreach ($detalles as $detalle){
               $producto = ProductoSimpleModel::find($detalle->sku);
               $producto = ProductoSimple::fromArray($producto->attributesToArray());
               if($detalle->tipo == 'ENTRADA')
                   $movimientos->entrada($producto,$detalle->cantidad,$detalle->costo);
               else
                   $movimientos->salida($producto,$detalle->cantidad,$detalle->costo,$detalle->precio);
           }
       }
       return $movimientos;
    }
}
