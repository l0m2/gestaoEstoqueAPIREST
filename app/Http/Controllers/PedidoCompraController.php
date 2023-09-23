<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\pedidoCompra;
use Illuminate\Http\Request;
use App\Models\fornecer;

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
        $validator = Validator::make(
            $request->all(),[
                'fornecedor_id' => 'required|integer|min:0',
                'status'=> 'required|string|max:15',
            ]);
        
        if($validator->fails()){
            return response()->json([
                'message'=> 'Erro na validacao dos dados'
            ],400);
        }
        
      else if(!fornecer::find($request['fornecedor_id'])){
        return response()->json([
            'message' => 'Fornecedor nao existe'
        ],404);
      }  

       else{
         if(pedidoCompra::create($request->all())){
            return response()->json([
                'message' => 'Pedido de Compra registado com sucesso'
            ],201);
         }
         return response()->json([
            'message' => 'Erro no registo do Pedido de Compra'
         ],400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pedidoCompra = pedidoCompra::find($id);
        if(!$pedidoCompra){
            return response()->json([
             'message'=> 'Pedido de Compra nao existe'
            ],404);
        }

        return $pedidoCompra;
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
    public function update(Request $request, $id)
    {
        $pedidoCompra = pedidoCompra::find($id);
        if(!$pedidoCompra){
            return response()->json([
             'message'=> 'Pedido de Compra nao existe'
            ],404);
        }

        $validator = Validator::make(
            $request->all(),[
                'fornecedor_id' => 'required|integer|min:0',
                'status'=> 'required|string|max:15'  
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> 'Erro na validacao dos dados'
            ], 400);
        }

        else if(!fornecer::find($request['fornecedor_id'])){
            return response()->json([
                'message' => 'Fornecedor nao existe'
            ],404);
          }  


          $validated = $validator->validated();

         if($validated['status'] == 'concluido'){
            return response()->json([
    'message'=> 'Nao e possivel concluir um pedido sem que nenhum produto seja comprado'
            ],400);
        }
          
        $update = $pedidoCompra ->update([
        'fornecedor_id' => $validated['fornecedor_id'],
        'status' => $validated['status']
        ]);

        if($update){
            return response()->json([
                'message'=> 'Pedido de Compra atualizado'
            ],200);
        }

        return response()->json([
            'message' => 'Erro na atualizacao do Pedido de Compra'
        ], 400);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pedidoCompra = pedidoCompra::find($id);
        if(!$pedidoCompra){
            return response()->json([
             'message'=> 'Pedido de Compra nao existe'
            ],404);
        }

        if($pedidoCompra->delete()){
            return response()->json([
                'message' => 'Pedido de Compra apagado'
            ], 200);
        }
        
        return response()->json([
            'messagem' => 'nao foi possivel apagar o pedido de compra'
        ],400);
    }
}
