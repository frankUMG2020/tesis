<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\TelefonoFMA;
use Illuminate\Http\Request;

class TelefonoFMAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = TelefonoFMA::get();

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
        $insert = new TelefonoFMA();
        $insert->numero = $request->numero;
        $insert->ficha_medica_a_id = $request->ficha_medica_a_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\TelefonoFMA  $telefonoFMA
     * @return \Illuminate\Http\Response
     */
    public function show(TelefonoFMA $telefonoFMA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\TelefonoFMA  $telefonoFMA
     * @return \Illuminate\Http\Response
     */
    public function edit(TelefonoFMA $telefonoFMA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\TelefonoFMA  $telefonoFMA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TelefonoFMA $telefonoFMA)
    {
        $telefonoFMA->numero = $request->numero;
        $telefonoFMA->ficha_medica_a_id = $request->ficha_medica_a_id;
        $telefonoFMA->save();

        return response()->json(["Registro" => $telefonoFMA, "Mensaje" => "Felicidades Actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\TelefonoFMA  $telefonoFMA
     * @return \Illuminate\Http\Response
     */
    public function destroy(TelefonoFMA $telefonoFMA)
    {
        $telefonoFMA->delete();

        return response()->json(["Registro" => $telefonoFMA, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
