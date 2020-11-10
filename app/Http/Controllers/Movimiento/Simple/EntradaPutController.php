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

    /**
     * @OA\Put(
     * tags={"Entrada de un producto simple"},
     * description="Entrada de un producto simple",
     * path="/api/entrada/simple/{sku}",
     * @OA\Parameter(
     *    description="ID of producto simple",
     *    in="path",
     *    name="sku",
     *    required=true,
     *    example="2387983d-fbd6-410f-8c71-dc92c4899d01",
     *    @OA\Schema(
     *       type="string",
     *    )
     * ),
     *     @OA\Parameter(
     *      name="cantidad",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="number"
     *      )
     *     ),
     *     @OA\Parameter(
     *      name="costo",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="number"
     *      )
     *     ),
     * @OA\Response(response="200", description="success"),
     * @OA\Response(response="400", description="Bad Request")
     * )
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
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
