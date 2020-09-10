<?php

namespace App\Http\Controllers\clinica\catalogo;

use App\Http\Controllers\Controller;
use App\Models\clinica\catalogo\TipoSangre;
use Illuminate\Http\Request;

class TipoSangreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = TipoSangre::get();

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
        $insert = new TipoSangre();
        $insert->nombre = $request->nombre;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\TipoSangre  $tipoSangre
     * @return \Illuminate\Http\Response
     */
    public function show(TipoSangre $tipoSangre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\TipoSangre  $tipoSangre
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoSangre $tipoSangre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\catalogo\TipoSangre  $tipoSangre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoSangre $tipoSangre)
    {
        $tipoSangre->nombre = $request->nombre;
        $tipoSangre->save();

        return response()->json(["Registro" => $tipoSangre, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\TipoSangre  $tipoSangre
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoSangre $tipoSangre)
    {
        $tipoSangre->delete();

        return response()->json(["Registro" => $tipoSangre, "Mensaje" => "Felicidades eliminaste"]);
    }
}
