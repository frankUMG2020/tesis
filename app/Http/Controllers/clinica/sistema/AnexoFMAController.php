<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\AnexoFMA;
use Illuminate\Http\Request;

class AnexoFMAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = AnexoFMA::get();

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
        $insert = new AnexoFMA();
        $insert->nombre = $request->nombre;
        $insert->path = $request->path;
        $insert->historial_fma_id = $request->historial_fma_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades Insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\AnexoFMA  $anexoFMA
     * @return \Illuminate\Http\Response
     */
    public function show(AnexoFMA $anexoFMA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\AnexoFMA  $anexoFMA
     * @return \Illuminate\Http\Response
     */
    public function edit(AnexoFMA $anexoFMA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\AnexoFMA  $anexoFMA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnexoFMA $anexoFMA)
    {
        $anexoFMA->nombre = $request->nombre;
        $anexoFMA->path = $request->path;
        $anexoFMA->historial_fma_id = $request->path;
        $anexoFMA->save();

        return response()->json(["Registro" => $anexoFMA, "Mensaje" => "Felicidades Actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\AnexoFMA  $anexoFMA
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnexoFMA $anexoFMA)
    {
        $anexoFMA->delete();

        return response()->json(["Registro" => $anexoFMA, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
