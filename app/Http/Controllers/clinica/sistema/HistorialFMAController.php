<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\HistorialFMA;
use Illuminate\Http\Request;

class HistorialFMAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = HistorialFMA::get();

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
        $insert = new HistorialFMA();
        $insert->codigo = $request->codigo;
        $insert->correlativo = $request->correlativo;
        $insert->edad = $request->edad;
        $insert->peso = $request->peso;
        $insert->talla = $request->talla;
        $insert->pulso = $request->pulso;
        $insert->temperatura = $request->temperatura;
        $insert->p_a = $request->p_a;
        $insert->respiracion = $request->respiracion;
        $insert->so_dos = $request->so_dos;
        $insert->ficha_medica_a_id = $request->ficha_medica_a_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\HistorialFMA  $historialFMA
     * @return \Illuminate\Http\Response
     */
    public function show(HistorialFMA $historialFMA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\HistorialFMA  $historialFMA
     * @return \Illuminate\Http\Response
     */
    public function edit(HistorialFMA $historialFMA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\HistorialFMA  $historialFMA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistorialFMA $historialFMA)
    {
        $historialFMA->codigo = $request->codigo;
        $historialFMA->correlativo = $request->correlativo;
        $historialFMA->edad = $request->edad;
        $historialFMA->peso = $request->peso;
        $historialFMA->talla = $request->talla;
        $historialFMA->pulso = $request->pulso;
        $historialFMA->temperatura = $request->temperatura;
        $historialFMA->p_a = $request->p_a;
        $historialFMA->respiracion = $request->respiracion;
        $historialFMA->so_dos = $request->so_dos;
        $historialFMA->ficha_medica_a_id = $request->ficha_medica_a_id;
        $historialFMA->save();

        return response()->json(["Registro" => $historialFMA, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\HistorialFMA  $historialFMA
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistorialFMA $historialFMA)
    {
        $historialFMA->delete();

        return response()->json(["Registro" => $historialFMA, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
