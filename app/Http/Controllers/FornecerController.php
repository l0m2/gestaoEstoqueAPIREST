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
    public function show($id)
    {     
        $fornecer = fornecer::find($id);
        if(!$fornecer){
            return response()->json([
          'message' => 'Fornecedor nao existe'
            ], 404);
        }

        return $fornecer;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(fornecer $fornecer)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $fornecer = fornecer::find($id);
        if(!$fornecer){
            return response()->json([
          'message' => 'Fornecedor nao existe'
            ], 404);
        }

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
                $validated = $validator->validated();
                
                $update = $fornecer->update([
                 'firstname' => $validated['firstname'],
                 'lastname' => $validated['lastname'],
                 'contacto' => $validated['contacto'],
                 'endereco' => $validated['endereco']
                ]);

            if($update){
               return response()->json([
                'message' => 'Dados do Fornecedor Atualizados'
               ], 200);
            }
            return response()->json([
                'message'=> 'Erro na atualizacao do Fornecedor'
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      $fornecer = fornecer::find($id);
      if(!$fornecer){
        return response()->json([
         'message' => 'Fornecedor nao existe'
        ],404);
      } 

      if($fornecer->delete()){
        return response()->json([
            'message' => 'fornecedor apagado'
        ], 200);
      }
      return response()->json([
       'message' => 'Nao foi possivel apagar o Fornecedor'
      ],400);
    }
}
