<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\ParametroFMA;
use Illuminate\Http\Request;

class ParametroFMAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = ParametroFMA::get();

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
        $insert = new ParametroFMA();
        $insert->parametro_uno = $request->parametro_uno;
        $insert->parametro_dos = $request->parametro_dos;
        $insert->parametro_tres = $request->parametro_tres;
        $insert->parametro_cuatro = $request->parametro_cuatro;
        $insert->parametro_seis = $request->parametro_seis;
        $insert->parametro_siete = $request->parametro_siete;
        $insert->parametro_ocho = $request->parametro_ocho;
        $insert->parametro_nueve = $request->parametro_nueve;
        $insert->parametro_diez = $request->parametro_diez;
        $insert->parametro_once = $request->parametro_once;
        $insert->parametro_doce = $request->parametro_doce;
        $insert->parametro_trece = $request->parametro_trece;
        $insert->historial_fma_id = $request->historial_fma_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\ParametroFMA  $parametroFMA
     * @return \Illuminate\Http\Response
     */
    public function show(ParametroFMA $parametroFMA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\ParametroFMA  $parametroFMA
     * @return \Illuminate\Http\Response
     */
    public function edit(ParametroFMA $parametroFMA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\ParametroFMA  $parametroFMA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParametroFMA $parametroFMA)
    {
        $parametroFMA->parametro_uno = $request->parametro_uno;
        $parametroFMA->parametro_dos = $request->parametro_dos;
        $parametroFMA->parametro_tres = $request->parametro_tres;
        $parametroFMA->parametro_cuatro = $request->parametro_cuatro;
        $parametroFMA->parametro_seis = $request->parametro_seis;
        $parametroFMA->parametro_siete = $request->parametro_siete;
        $parametroFMA->parametro_ocho = $request->parametro_ocho;
        $parametroFMA->parametro_nueve = $request->parametro_nueve;
        $parametroFMA->parametro_diez = $request->parametro_diez;
        $parametroFMA->parametro_once = $request->parametro_once;
        $parametroFMA->parametro_doce = $request->parametro_doce;
        $parametroFMA->parametro_trece = $request->parametro_trece;
        $parametroFMA->historial_fma_id = $request->historial_fma_id;
        $parametroFMA->save();

        return response()->json(["Registro" => $parametroFMA, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\ParametroFMA  $parametroFMA
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParametroFMA $parametroFMA)
    {
        $parametroFMA->delete();

        return response()->json(["Registro" => $parametroFMA, "Mensaje" => "Felicidades eliminaste"]);
    }
}
