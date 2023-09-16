<?php

namespace App\Http\Controllers;

use App\Models\produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
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
                'descrição' => 'required|string',
                'preço' => 'required|numeric|min:0',
                'quantidade' => 'required|integer|min:0',
            ]
            );

            if($validator->fails()){
                return response()->json([
                    'message' => 'Erro na validacao dos dados'
                ], 400);
            }

        else{
            if(produto::create($request->all())){
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
    public function show(produto $produto)
    {
        //
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
    public function update(Request $request, produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(produto $produto)
    {
        //
    }
}
