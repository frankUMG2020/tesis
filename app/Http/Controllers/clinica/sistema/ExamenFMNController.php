<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\ExamenFMN;
use Illuminate\Http\Request;

class ExamenFMNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = ExamenFMN::get();

        return response()->json(['Registro nuevo' => $values, 'Mensaje' => 'Felicidades consultastes']);
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
        $insert = new ExamenFMN();
        $insert->historial_fmn_id = $request->historial_fmn_id;
        $insert->examen_id = $request->examen_id;
        $insert->save();
        
        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades Insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\ExamenFMN  $examenFMN
     * @return \Illuminate\Http\Response
     */
    public function show(ExamenFMN $examenFMN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\ExamenFMN  $examenFMN
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamenFMN $examenFMN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\ExamenFMN  $examenFMN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamenFMN $examenFMN)
    {
        $examenFMN->historial_fmn_id = $request->historial_fmn_id;
        $examenFMN->examen_id = $request->examen_id;
        $examenFMN->save();

        return response()->json(["Registro" => $examenFMN, "Mensaje" => "Felicidades Actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\ExamenFMN  $examenFMN
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamenFMN $examenFMN)
    {
        $examenFMN->delete();

        return response()->json(["Registro" => $examenFMN, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
