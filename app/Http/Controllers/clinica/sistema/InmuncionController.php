<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\Inmuncion;
use Illuminate\Http\Request;

class InmuncionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = Inmuncion::get();

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
        $insert = new Inmuncion();
        $insert->restante = $request->restante;
        $insert->historial_fmn_id =  $request->historial_fmn_id;
        $insert->vacuna_id = $request->vacuna_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\Inmuncion  $inmuncion
     * @return \Illuminate\Http\Response
     */
    public function show(Inmuncion $inmuncion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\Inmuncion  $inmuncion
     * @return \Illuminate\Http\Response
     */
    public function edit(Inmuncion $inmuncion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\Inmuncion  $inmuncion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inmuncion $inmuncion)
    {
        $inmuncion->restante = $request->restante;
        $inmuncion->historial_fmn_id =  $request->historial_fmn_id;
        $inmuncion->vacuna_id = $request->vacuna_id;
        $inmuncion->save();

        return response()->json(["Registro" => $inmuncion, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\Inmuncion  $inmuncion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inmuncion $inmuncion)
    {
        $inmuncion->delete();

        return response()->json(["Registro" => $inmuncion, "Mensaje" => "Felicidades insertaste"]);
    }
}
