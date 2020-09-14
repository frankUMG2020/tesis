<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\EstadoCalendario;
use Illuminate\Http\Request;

class EstadoCalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = EstadoCalendario::get();

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
        $insert = new EstadoCalendario();
        $insert->nombre = $request->nombre;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades Insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\EstadoCalendario  $estadoCalendario
     * @return \Illuminate\Http\Response
     */
    public function show(EstadoCalendario $estadoCalendario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\EstadoCalendario  $estadoCalendario
     * @return \Illuminate\Http\Response
     */
    public function edit(EstadoCalendario $estadoCalendario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\EstadoCalendario  $estadoCalendario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstadoCalendario $estadoCalendario)
    {
        $estadoCalendario->nombre = $estadoCalendario->nombre;
        $estadoCalendario->save();

        return response()->json(["Registro" => $estadoCalendario, "Mensaje" => "Felicidades Actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\EstadoCalendario  $estadoCalendario
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstadoCalendario $estadoCalendario)
    {
        $estadoCalendario->delete();

        return response()->json(["Registro" => $estadoCalendario, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
