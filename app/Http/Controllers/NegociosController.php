<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Negocios;

class NegociosController extends Controller
{
    public function getNegocios(){
        $negocios = Negocios::all();
        return response()->json($negocios, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function createNegocio(Request $request){
        $user = $request->user()->id;
        $negocio = new Negocios();
        $negocio->nombre = $request->input('nombre');
        $negocio->direccion = $request->input('direccion');
        $negocio->telefono = $request->input('telefono');
        $negocio->imagen = $request->input('imagen');
        $negocio->user_id = $user;
        $negocio->save();


        return response()->json($negocio, 201, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
