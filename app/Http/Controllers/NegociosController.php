<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Negocio;

class NegociosController extends Controller
{
    public function getNegocios(){
        $negocios = Negocio::all();
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

        $negocio = Negocio::create($validated);

        return response()->json($negocio, 201, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function getNegocioByID(Request $request)
    {
        $id = $request->query('id');
        $negocio = Negocio::find($id);

        if (!$negocio) {
            return response()->json(['error' => 'Negocio no encontrado'], 404);
        }

        $data = $negocio->toArray();
        $data['ofertas'] = $negocio->ofertas()->get()->toArray();

        $user = $request->user();
        $data['admin'] = $user && $negocio->user_id == $user->id;

        return response()->json($data, 201, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function deleteNegocio(Request $request)
    {
        $id = $request->query('id');
        $negocio = Negocio::find($id);

        if (!$negocio) {
            return response()->json(['error' => 'Negocio no encontrado'], 404);
        }

        if ($request->user()->id !== $negocio->user_id) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $negocio->delete();
        
        return response()->json(['message' => 'Negocio eliminado correctamente'], 200);
    }
}
