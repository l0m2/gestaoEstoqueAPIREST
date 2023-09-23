<?php

namespace App\Http\Controllers;

use App\Models\fornecer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class FornecerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fornecers = fornecer::count();

        if($fornecers==0){
            return response()->json([
                'message' => 'Nao tem nenhum fornecedor registado'
            ], 204);
        }

        return fornecer::all();
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
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'contacto' => 'required|string|max:13',
                'endereco' => 'required|string|min:6', 
            ]);

            if($validator->fails()){
                return response()->json([
                    'message' => 'Erro na validacao dos dados'
                ], 400);
            }

            else{
                if(fornecer::create($request->all())){
                    return response()->json([
                        'message'=> 'Fornecedor Registado com Sucesso'
                    ],201); 
                }

                return response()->json([
                'message'=> 'Erro no Registo'
                ], 400);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(fornecer $fornecer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(fornecer $fornecer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, fornecer $fornecer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(fornecer $fornecer)
    {
        //
    }
}
