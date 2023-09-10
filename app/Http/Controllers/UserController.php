<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            if(User::create($request->all())){
                return response()->json([
                'message' => 'Usuario registado com sucesso'
                ],201);
            }

            return response()->json([
              'message' => 'Erro no registro do usuario'
            ],400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
