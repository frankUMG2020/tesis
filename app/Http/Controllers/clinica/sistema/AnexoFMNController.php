<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\AnexoFMN;
use Illuminate\Http\Request;

class AnexoFMNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = AnexoFMN::get();

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
        $insert = new AnexoFMN();
        $insert->nombre = $request->nombre;
        $insert->path = $request->path;
        $insert->historial_fmn_id = $request->historial_fmn_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades Insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\AnexoFMN  $anexoFMN
     * @return \Illuminate\Http\Response
     */
    public function show(AnexoFMN $anexoFMN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\AnexoFMN  $anexoFMN
     * @return \Illuminate\Http\Response
     */
    public function edit(AnexoFMN $anexoFMN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\AnexoFMN  $anexoFMN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnexoFMN $anexoFMN)
    {
        $anexoFMN->nombre = $request->nombre;
        $anexoFMN->path = $request->path;
        $anexoFMN->historial_fmn_id = $request->historial_fmn_id;
        $anexoFMN->save();

        return response()->json(["Registro" => $anexoFMN, "Mensaje" => "Felicidades Actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\AnexoFMN  $anexoFMN
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnexoFMN $anexoFMN)
    {
        $anexoFMN->delete();

        return response()->json(["Registro" => $anexoFMN, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
