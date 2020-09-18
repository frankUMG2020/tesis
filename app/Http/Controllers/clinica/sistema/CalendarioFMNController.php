<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\CalendarioFMN;
use Illuminate\Http\Request;

class CalendarioFMNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = CalendarioFMN::get();

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
        $insert = new CalendarioFMN();
        $insert->cita = $request->cita;
        $insert->fecha = date('Y-m-d', strtotime($request->fecha));
        $insert->hora = $request->hora;
        $insert->ficha_medica_n_id = $request->ficha_medica_n_id;
        $insert->estado_calendario_id = $request->estado_calendario_id;
        $insert->tipo_cita_id = $request->tipo_cita_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades Insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\CalendarioFMN  $calendarioFMN
     * @return \Illuminate\Http\Response
     */
    public function show(CalendarioFMN $calendarioFMN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\CalendarioFMN  $calendarioFMN
     * @return \Illuminate\Http\Response
     */
    public function edit(CalendarioFMN $calendarioFMN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\CalendarioFMN  $calendarioFMN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalendarioFMN $calendarioFMN)
    {
        $calendarioFMN->cita = $request->cita;
        $calendarioFMN->fecha = date('Y-m-d', strtotime($request->fecha));
        $calendarioFMN->hora = $request->hora;
        $calendarioFMN->ficha_medica_n_id = $request->ficha_medica_n_id;
        $calendarioFMN->estado_calendario_id = $request->estado_calendario_id;
        $calendarioFMN->tipo_cita_id = $request->tipo_cita_id;
        $calendarioFMN->save();

        return response()->json(["Registro" => $calendarioFMN, "Mensaje" => "Felicidades Actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\CalendarioFMN  $calendarioFMN
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalendarioFMN $calendarioFMN)
    {
        $calendarioFMN->delete();

        return response()->json(["Registro" => $calendarioFMN, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
