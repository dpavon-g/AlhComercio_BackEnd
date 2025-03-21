<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Negocios;

class APIsController extends Controller
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
        //
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

    public function getEstablecimientos(){

        // $establecimientos = [
        //     [
        //         'id' => 1,
        //         'nombre' => 'Bendito Bocado',
        //         'direccion' => 'Av. Isaac Peral, S/N, 29130 Alhaurín de la Torre, Málaga',
        //         'telefono' => '951 62 30 12',
        //         'Imagen' => 'https://benditobocado.com/wp-content/uploads/2022/01/2-1.jpg'
        //     ],
        //     [
        //         'id' => 2,
        //         'nombre' => 'Vadepizza',
        //         'direccion' => 'Av. las Americas, 3, 29130 Alhaurín de la Torre, Málaga',
        //         'telefono' => '952 96 24 03',
        //         'Imagen' => 'https://tb-static.uber.com/prod/image-proc/processed_images/0cbddb8bb25b8868dc03e25b80b0d827/3ac2b39ad528f8c8c5dc77c59abb683d.jpeg'
        //     ],
        //     [
        //         'id' => 3,
        //         'nombre' => 'Visual Market Los Vegas Tu Óptica a Precio Justo',
        //         'direccion' => 'Av. de los Vegas, 12, Cruz de Humilladero, 29006 Málaga',
        //         'telefono' => '952 02 60 26',
        //         'Imagen' => 'https://lh3.googleusercontent.com/p/AF1QipPdjgCRLKzxsh14FyQT_75VZw1jBTBXK7HFCV_3=s680-w680-h510'
        //     ]
        // ];
        $negocios = Negocios::all();
        return response()->json($negocios, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
