<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\ExamenFMA;
use Illuminate\Http\Request;

class ExamenFMAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = ExamenFMA::get();

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
        $insert = new ExamenFMA();
        $insert->historial_fma_id = $request->historial_fma_id;
        $insert->examen_id = $request->examen_id;
        $insert->save();

        return response()->json(['Registro nuevo' => $insert, 'Mensaje' => 'Felicidades Insertaste']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\ExamenFMA  $examenFMA
     * @return \Illuminate\Http\Response
     */
    public function show(ExamenFMA $examenFMA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\ExamenFMA  $examenFMA
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamenFMA $examenFMA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\ExamenFMA  $examenFMA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamenFMA $examenFMA)
    {
        $examenFMA->historial_fma_id = $request->examen_fma_id;
        $examenFMA->examen_id = $request->examen_id;
        $examenFMA->save();

        return response()->json(['Registro nuevo' => $examenFMA, 'Mensaje' => 'Felicidades Actualizaste']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\ExamenFMA  $examenFMA
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamenFMA $examenFMA)
    {
        $examenFMA->delete();

        return response()->json(['Registro nuevo' => $examenFMA, 'Mensaje' => 'Felicidades Eliminaste']);
    }
}
