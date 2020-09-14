<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\ETFMA;
use Illuminate\Http\Request;

class ETFMAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = ETFMA::get();

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
        $insert = new ETFMA();
        $insert->evolucion = $request->evolucion;
        $insert->tratamiento = $request->tratamiento;
        $insert->parametros_fma_id = $request->parametros_fma_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades Insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\ETFMA  $eTFMA
     * @return \Illuminate\Http\Response
     */
    public function show(ETFMA $eTFMA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\ETFMA  $eTFMA
     * @return \Illuminate\Http\Response
     */
    public function edit(ETFMA $eTFMA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\ETFMA  $eTFMA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ETFMA $eTFMA)
    {
        $eTFMA->evolucion = $request->evolucion;
        $eTFMA->tratamiento = $request->tratamiento;
        $eTFMA->parametros_fma_id = $request->parametros_fma_id;
        $eTFMA->save();

        return response()->json(["Registro" => $eTFMA, "Mensaje" => "Felicidades Actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\ETFMA  $eTFMA
     * @return \Illuminate\Http\Response
     */
    public function destroy(ETFMA $eTFMA)
    {
        $eTFMA->delete();

        return response()->json(["Registro" => $eTFMA, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
