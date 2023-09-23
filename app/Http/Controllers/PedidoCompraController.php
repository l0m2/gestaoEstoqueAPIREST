<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\pedidoCompra;
use Illuminate\Http\Request;

class PedidoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidoCompra = pedidoCompra::count();
        if($pedidoCompra == 0){
            return response()->json([
                'message' => 'Nao tem nenhum pedido de Compra'
            ],204);
        }
        return pedidoCompra::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(pedidoCompra $pedidoCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pedidoCompra $pedidoCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pedidoCompra $pedidoCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pedidoCompra $pedidoCompra)
    {
        //
    }
}
