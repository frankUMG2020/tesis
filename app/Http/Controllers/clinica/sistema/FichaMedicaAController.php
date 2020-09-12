<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\FichaMedicaA;
use Illuminate\Http\Request;

class FichaMedicaAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = FichaMedicaA::get();

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
        $insert = new FichaMedicaA();
        $insert->fecha = $request->fecha;
        $insert->estado_civil = $request->estado_civil;
        $insert->profesion = $request->profesion;
        $insert->foto = $request->foto;
        $insert->remitido = $request->remitido;
        $insert->observacion = $request->observacion;
        $insert->codigo_epps = $request->codigo_epps;
        $insert->cui = $request->cui;
        $insert->tipo_sangre_id = $request->tipo_sande_id;
        $insert->persona_id = $request->persona_id;
        $insert->save();
        
        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\FichaMedicaA  $fichaMedicaA
     * @return \Illuminate\Http\Response
     */
    public function show(FichaMedicaA $fichaMedicaA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\FichaMedicaA  $fichaMedicaA
     * @return \Illuminate\Http\Response
     */
    public function edit(FichaMedicaA $fichaMedicaA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\FichaMedicaA  $fichaMedicaA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FichaMedicaA $fichaMedicaA)
    {
        $fichaMedicaA->fecha = $request->fecha;
        $fichaMedicaA->estado_civil = $request->estado_civil;
        $fichaMedicaA->profesion = $request->profesion;
        $fichaMedicaA->foto = $request->foto;
        $fichaMedicaA->remitido = $request->remitido;
        $fichaMedicaA->observacion = $request->observacion;
        $fichaMedicaA->codigo_epps = $request->codigo_epps;
        $fichaMedicaA->cui = $request->cui;
        $fichaMedicaA->tipo_sangre_id = $request->tipo_sangre_id;
        $fichaMedicaA->persona_id = $request->perosna_id;
        $fichaMedicaA->save();

        return response()->json(["Registro" => $fichaMedicaA, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\FichaMedicaA  $fichaMedicaA
     * @return \Illuminate\Http\Response
     */
    public function destroy(FichaMedicaA $fichaMedicaA)
    {
        $fichaMedicaA->delete();

        return response()->json(["Registro" => $fichaMedicaA, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
