<?php

namespace App\Http\Controllers\clinica\catalogo;

use App\Http\Controllers\Controller;
use App\Models\clinica\catalogo\CategoriaExamen;
use Illuminate\Http\Request;

class CategoriaExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = CategoriaExamen::with('examenes')->orderBy('nombre')->get();

        return response()->json(["Registro" => $values, "Mensaje" => "Felicidades accediste a datos"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert = new CategoriaExamen();
        $insert->nombre = $request->nombre;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\CategoriaExamen  $categoriaExamen
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriaExamen $categoriaExamen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\CategoriaExamen  $categoriaExamen
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaExamen $categoriaExamen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\catalogo\CategoriaExamen  $categoriaExamen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriaExamen $categoriaExamen)
    {
        $categoriaExamen->nombre = $request->nombre;
        $categoriaExamen->save();

        return response()->json(["Registro" => $categoriaExamen, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\CategoriaExamen  $categoriaExamen
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriaExamen $categoriaExamen)
    {
        $categoriaExamen->delete();
        
        return response()->json(["Registro" => $categoriaExamen, "Mensaje" => "Felicidades eliminaste"]);
    }
}
