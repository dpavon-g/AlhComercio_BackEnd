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

    public function createNegocio(Request $request)
    {
        $validated = $request->validate([
            'nombre'    => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono'  => 'required|string|max:20',
            'imagen'    => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = $request->user()->id;

        $negocio = Negocios::create($validated);

        return response()->json($negocio, 201, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
