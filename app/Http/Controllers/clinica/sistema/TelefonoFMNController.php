<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\TelefonoFMN;
use Illuminate\Http\Request;

class TelefonoFMNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = TelefonoFMN::get();

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
        $insert = new TelefonoFMN();
        $insert->numero = $request->numero;
        $insert->ficha_medica_n_id = $request->ficha_medica_n_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\TelefonoFMN  $telefonoFMN
     * @return \Illuminate\Http\Response
     */
    public function show(TelefonoFMN $telefonoFMN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\TelefonoFMN  $telefonoFMN
     * @return \Illuminate\Http\Response
     */
    public function edit(TelefonoFMN $telefonoFMN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\TelefonoFMN  $telefonoFMN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TelefonoFMN $telefonoFMN)
    {
        $telefonoFMN->numero = $request->numero;
        $telefonoFMN->ficha_medica_n_id = $request->ficha_medica_n_id;
        $telefonoFMN->save();

        return response()->json(["Registro" => $telefonoFMN, "Mensaje" => "Felicidades Actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\TelefonoFMN  $telefonoFMN
     * @return \Illuminate\Http\Response
     */
    public function destroy(TelefonoFMN $telefonoFMN)
    {
        $telefonoFMN->delete();

        return response()->json(["Registro" => $telefonoFMN, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
