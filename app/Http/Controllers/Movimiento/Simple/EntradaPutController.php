<?php

namespace App\Http\Controllers\Movimiento\Simple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Restaurante\Movimiento\Aplicacion\Simple\EntradaProductoSimpleService;

class EntradaPutController extends Controller
{

    public EntradaProductoSimpleService $service;

    public function __construct(EntradaProductoSimpleService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request) {

        $request = new EntradaProductoSimpleRequest(
            $request->sku,
            $request->cantidad,
            $request->costo
        );

        $this->service->__invoke($request);

    }

}
