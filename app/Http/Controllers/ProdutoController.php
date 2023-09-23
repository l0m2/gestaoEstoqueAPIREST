<?php

namespace App\Http\Controllers;

use App\Models\produto;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use App\Models\movimentaçãoEstoque;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $produtos = produto::count();

        if($produtos==0){      
            return response()->json([
            'message' => 'Nao tem nenhum produto disponivel'
        ], 204);
        }

        return produto::all();
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
                'nome' => 'required|string|max:255',
                'descricao' => 'required|string',
                'preco' => 'required|numeric|between:1,9999.99',
                'quantidade' => 'required|integer|min:0',
            ]
            );

            if($validator->fails()){
                return response()->json([
                    'message' => 'Erro na validacao dos dados'
                ], 400);
            }

        else{
            $produto = produto::create($request->all());
            if($produto){
                $user = Auth::user();
                movimentaçãoEstoque::create([
                'user_id'=> $user->id,
                'produto_id'=> $produto->id,
                'tipo_movimentacao' => 'Entrada', 
                'quantidade' => $produto->quantidade 
                ]);

                return response()->json([
                'message' => 'Produto registado com sucesso'
                ],201);
            }

            return response()->json([
              'message' => 'Erro no registro do Produto'
            ],400);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produto = produto::find($id);
        if(!$produto){
            return response()->json([
             'message' => 'Produto nao existe'
            ],404);
        }
        
        return $produto;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produto = produto::find($id);
        if(!$produto){
            return response()->json([
             'message' => 'Produto nao existe'
            ],404);
        }

        $validator = Validator::make(
            $request->all(),[
                'nome' => 'required|string|max:255',
                'descricao' => 'required|string',
                'preco' => 'required|numeric|min:0',
                'quantidade' => 'required|integer|min:0',
            ]
            );

            if($validator->fails()){
                return response()->json([
                    'message' => 'Erro na validacao dos dados'
                ], 400);
            }
            else{

            $validated = $validator->validated();

            $update = $produto->update([
                'nome' => $validated['nome'],
                'descricao' => $validated['descricao'],
                'preco' =>  $validated['preco'],
                'quantidade' => $validated['quantidade']
            ]);

            if($update){
                return response()->json([
                    'message' => 'Produto atualizado com sucesso'
                    ],200);
            }

            return response()->json([
                'message' => 'Erro na atualizacao do Produto'
              ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produto = produto::find($id);
        if(!$produto){
            return response()->json([
             'message' => 'Produto nao existe'
            ],404);
        }

        if($produto->delete()){
            return response()->json([
                'message' => 'Produto Apagado'
            ], 200);
        }
        
        return response()->json([
            'message' => 'Nao foi possivel apagar o produto' 
        ],400);
        
    }
}
