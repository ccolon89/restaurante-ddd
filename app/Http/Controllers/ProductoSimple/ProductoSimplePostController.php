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
    /**
     * @OA\Post(
     *     path="/api/productoSimple",
     *     tags={"crear un nuevo producto simple"},
     *     summary="crear un nuevo producto simple",
     *     description="Nuevo producto simple",
     *     @OA\Parameter(
     *      name="sku",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *     ),
     *     @OA\Parameter(
     *      name="nombre",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
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
     *     @OA\Parameter(
     *      name="precio",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="number"
     *      )
     *     ),
     *     @OA\Response(response="201", description="success"),
     *     @OA\Response(response="400", description="Bad Request")
     * )
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
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
