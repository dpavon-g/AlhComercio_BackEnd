<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Oferta;

class OfertasController extends Controller
{
    public function createOferta(Request $request)
    {
        $validated = $request->validate([
            'nombre'          => 'required|string|max:255',
            'precio_original' => 'required|numeric',
            'precio_oferta'   => 'required|numeric',
            'imagen'          => 'nullable|string|max:255',
            'negocio_id'      => 'required|integer|exists:negocios,id',
        ]);

        $oferta = Oferta::create($validated);

        return response()->json($oferta, 201, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
