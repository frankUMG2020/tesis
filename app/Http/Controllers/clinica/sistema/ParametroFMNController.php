<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\ParametroFMA;
use App\Models\clinica\sistema\ParametroFMN;
use Illuminate\Http\Request;

class ParametroFMNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = ParametroFMN::get();

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
        $insert = new ParametroFMN();
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
        $insert->historial_fmn_id = $request->historial_fmn_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\ParametroFMN  $parametroFMN
     * @return \Illuminate\Http\Response
     */
    public function show(ParametroFMN $parametroFMN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\ParametroFMN  $parametroFMN
     * @return \Illuminate\Http\Response
     */
    public function edit(ParametroFMN $parametroFMN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\ParametroFMN  $parametroFMN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParametroFMN $parametroFMN)
    {
        $parametroFMN->parametro_uno = $request->parametro_uno;
        $parametroFMN->parametro_dos = $request->parametro_dos;
        $parametroFMN->parametro_tres = $request->parametro_tres;
        $parametroFMN->parametro_cuatro = $request->parametro_cuatro;
        $parametroFMN->parametro_seis = $request->parametro_seis;
        $parametroFMN->parametro_siete = $request->parametro_siete;
        $parametroFMN->parametro_ocho = $request->parametro_ocho;
        $parametroFMN->parametro_nueve = $request->parametro_nueve;
        $parametroFMN->parametro_diez = $request->parametro_diez;
        $parametroFMN->parametro_once = $request->parametro_once;
        $parametroFMN->parametro_doce = $request->parametro_doce;
        $parametroFMN->parametro_trece = $request->parametro_trece;
        $parametroFMN->historial_fmn_id = $request->historial_fmn_id;
        $parametroFMN->save();

        return response()->json(["Registro" => $parametroFMN, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\ParametroFMN  $parametroFMN
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParametroFMN $parametroFMN)
    {
        $parametroFMN->delete();

        return response()->json(["Registro" => $parametroFMN, "Mensaje" => "Felicidades eliminaste"]);
    }
}
