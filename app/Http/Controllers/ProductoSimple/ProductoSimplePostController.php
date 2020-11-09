<?php

namespace App\Http\Controllers\ProductoSimple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Restaurante\Producto\Aplication\CrearProductoSimpleRequest;
use Restaurante\Producto\Aplication\CrearProductoSimpleService;
use Restaurante\Producto\Domain\ProductoSimpleDuplicado;

class ProductoSimplePostController extends Controller
{

    public CrearProductoSimpleService $service;

    public function __construct(CrearProductoSimpleService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request) {

       $productoRequest = new CrearProductoSimpleRequest(
           $request->sku,
           $request->nombre,
           $request->costo,
           $request->precio
       );
       try{
           $this->service->__invoke($productoRequest);
           return response('',Response::HTTP_CREATED);
       }catch (ProductoSimpleDuplicado $exception){
           return response($exception->errorMessage(),Response::HTTP_BAD_REQUEST);
       }

    }
}
