<?php

namespace App\Http\Controllers\Movimiento\Simple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Restaurante\Movimiento\Aplication\EntradaProductoRequest;
use Restaurante\Movimiento\Aplication\EntradaProductoSimpleService;
use Restaurante\Producto\Domain\ProductoNoExiste;

class EntradaPutController extends Controller
{

    public EntradaProductoSimpleService $service;

    public function __construct(EntradaProductoSimpleService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request) {

        $request = new EntradaProductoRequest(
            $request->sku,
            $request->cantidad,
            $request->costo
        );

       try {
           $this->service->__invoke($request);
           return response('',Response::HTTP_OK);
       }catch (ProductoNoExiste $exception){
           return response($exception->errorMessage(),Response::HTTP_BAD_REQUEST);
       }

    }

}
