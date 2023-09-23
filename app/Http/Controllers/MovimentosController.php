<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\movimentaçãoEstoque;
class MovimentosController extends Controller
{
    public function getAll(){
        $movimentos = movimentaçãoEstoque::count();

        if($movimentos==00){
            return response()->json([
                'message' => 'Nao tem nenhum movimento registado'
            ], 204);
        }
        return movimentaçãoEstoque::all();
    }

    public function getOne($id){
        $movimento = movimentaçãoEstoque::find($id);

        if(!$movimento){
            return response()->json([
                'message' => 'Movimento nao existe'
            ], 404);
        }
        return $movimento;
    }
}
