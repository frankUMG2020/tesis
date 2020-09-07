<?php

namespace App\Http\Controllers\clinica\catalogo;

use App\Http\Controllers\Controller;
use App\Models\clinica\catalogo\Alimentacion;
use Illuminate\Http\Request;

class AlimentacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = Alimentacion::all();

        return response()->json(["Registro" => $values, "Mensaje" => "Felicidades"]);
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
        $data = Alimentacion::create($request->all());

        return response()->json(["Registro" => $data, "Mensaje" => "Felicidades"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\Alimentacion  $alimentacion
     * @return \Illuminate\Http\Response
     */
    public function show(Alimentacion $alimentacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\Alimentacion  $alimentacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Alimentacion $alimentacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\catalogo\Alimentacion  $alimentacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alimentacion $alimentacion)
    {
        $alimentacion->nombre = $request->nombre;
        $alimentacion->save();

        return response()->json(["Registro" => $alimentacion, "Mensaje" => "Felicidades"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\Alimentacion  $alimentacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alimentacion $alimentacion)
    {
        $alimentacion->delete();

        return response()->json(["Registro" => $alimentacion, "Mensaje" => "Felicidades"]);
    }
}
