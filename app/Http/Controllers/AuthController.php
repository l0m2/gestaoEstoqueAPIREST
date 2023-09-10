<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request){
   $validator = Validator::make(
    $request->all(),[
        'email' => 'required|string|email|max:255', 
        'password' => 'required|string|min:6',
    ]
   );
   if($validator->fails()){
    return response()->json([
        'message' => 'Erro na validacao dos dados'
    ], 400);
   }
   else{
    if(Auth::attempt($request->only('email','password'))){
       return response()->json([
        'message' => 'Acesso autorizado',
        'token' => $request->user()->createToken($request->email)->plainTextToken
       ],200);
    }
    return response()->json([
        'message' => 'Acesso negado'
    ],401);
   }

    }
    
}
