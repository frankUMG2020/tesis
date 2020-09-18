<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\HistorialFMA;
use App\Models\clinica\sistema\HistorialFMN;
use Illuminate\Http\Request;

class HistorialFMNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = HistorialFMN::get();

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
        $insert = new HistorialFMN();
        $insert->codigo = $request->codigo;
        $insert->correlativo = $request->correlativo;
        $insert->edad = $request->edad;
        $insert->peso = $request->peso;
        $insert->descripcion = $request->descripcion;
        $insert->ficha_medica_n_id = $request->ficha_medica_n_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\HistorialFMN  $historialFMN
     * @return \Illuminate\Http\Response
     */
    public function show(HistorialFMN $historialFMN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\HistorialFMN  $historialFMN
     * @return \Illuminate\Http\Response
     */
    public function edit(HistorialFMN $historialFMN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\HistorialFMN  $historialFMN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistorialFMN $historialFMN)
    {
        $historialFMN->codigo = $request->codigo;
        $historialFMN->correlativo = $request->correlativo;
        $historialFMN->edad = $request->edad;
        $historialFMN->peso = $request->peso;
        $historialFMN->descripcion = $request->descripcion;
        $historialFMN->ficha_medica_n_id = $request->ficha_medica_n_id;
        $historialFMN->save();

        return response()->json(["Registro" => $historialFMN, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\HistorialFMN  $historialFMN
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistorialFMN $historialFMN)
    {
        $historialFMN->delete();

        return response()->json(["Registro" => $historialFMN, "Mensaje" => "Felicidades actualizaste"]);
    }
}
