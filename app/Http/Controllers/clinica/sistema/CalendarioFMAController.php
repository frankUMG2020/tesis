<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\CalendarioFMA;
use Illuminate\Http\Request;

class CalendarioFMAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = CalendarioFMA::get();

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
        $insert = new CalendarioFMA();
        $insert->cita = $request->cita;
        $insert->fecha =date('Y-m-d', strtotime($request->fecha));
        $insert->hora = $request->hora;
        $insert->ficha_medica_a_id = $request->ficha_medica_a_id;
        $insert->estado_calendario_id = $request->estado_calendario_id;
        $insert->tipo_cita_id = $request->tipo_cita_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades Insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\CalendarioFMA  $calendarioFMA
     * @return \Illuminate\Http\Response
     */
    public function show(CalendarioFMA $calendarioFMA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\CalendarioFMA  $calendarioFMA
     * @return \Illuminate\Http\Response
     */
    public function edit(CalendarioFMA $calendarioFMA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\CalendarioFMA  $calendarioFMA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalendarioFMA $calendarioFMA)
    {
        $calendarioFMA->cita = $request->cita;
        $calendarioFMA->fecha =date('Y-m-d', strtotime($request->fecha));
        $calendarioFMA->hora = $request->hora;
        $calendarioFMA->ficha_medica_a_id = $request->ficha_medica_a_id;
        $calendarioFMA->estado_calendario_id = $request->estado_calendario_id;
        $calendarioFMA->tipo_cita_id = $request->tipo_cita_id;
        $calendarioFMA->save();

        return response()->json(["Registro" => $calendarioFMA, "Mensaje" => "Felicidades Insertaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\CalendarioFMA  $calendarioFMA
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalendarioFMA $calendarioFMA)
    {
        $calendarioFMA->delete();

        return response()->json(["Registro" => $calendarioFMA, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
