<?php

namespace App\Http\Controllers\clinica\catalogo;

use App\Http\Controllers\Controller;
use App\Models\clinica\catalogo\TipoCita;
use Illuminate\Http\Request;

class TipoCitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = TipoCita::get();

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
        $insert = new TipoCita();
        $insert->nombre = $request->nombre;
        $insert->color = $request->color;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\TipoCita  $tipoCita
     * @return \Illuminate\Http\Response
     */
    public function show(TipoCita $tipoCita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\TipoCita  $tipoCita
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoCita $tipoCita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\catalogo\TipoCita  $tipoCita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoCita $tipoCita)
    {
        $tipoCita->nombre = $request->nombre;
        $tipoCita->color = $request->color;
        $tipoCita->save();

        return response()->json(["Registro" => $tipoCita, "Mensaje" => "Felicidades Actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\TipoCita  $tipoCita
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoCita $tipoCita)
    {
        $tipoCita->delete();

        return response()->json(["Registro" => $tipoCita, "Mensaje" => "Felicidades Eliminaste"]);

    }
}
