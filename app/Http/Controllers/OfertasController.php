<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Oferta;
use App\Models\OfertaActivada;

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

    public function deleteOferta(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        $ofertaId = $request->query('id');
        $oferta = Oferta::find($ofertaId);

        if (!$oferta) {
            return response()->json(['error' => 'Oferta no encontrada'], 404);
        }

        $negocio = $oferta->negocio;
        if (!$negocio || $negocio->user_id !== $user->id) {
            return response()->json(['error' => 'No tienes permisos para eliminar esta oferta'], 403);
        }

        $oferta->delete();

        return response()->json(['message' => 'Oferta eliminada correctamente'], 200);
    }
     
    public function activarOferta(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
        $ofertaId = $request->query('id');
        $oferta = Oferta::find($ofertaId);
        if (!$oferta) {
            return response()->json(['error' => 'Oferta no encontrada'], 404);
        }
        $diferencia = $oferta->precio_original - $oferta->precio_oferta;
        if ($diferencia < 0) {
            $diferencia = 0;
        }

        $user->coins = ($user->coins ?? 0) + $diferencia;
        $user->save();

        OfertaActivada::create([
            'oferta_id' => $oferta->id,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'Oferta activada y coins sumadas correctamente',
            'coins' => $user->coins,
            'diferencia' => $diferencia
        ], 200);
    }
}
