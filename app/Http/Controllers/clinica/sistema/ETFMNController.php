<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\ETFMN;
use Illuminate\Http\Request;

class ETFMNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = ETFMN::get();

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
        $insert = new ETFMN();
        $insert->evolucion = $request->evolucion;
        $insert->tratamiento = $request->tratamiento;
        $insert->parametros_fmn_id = $request->parametros_fmn_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades Insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\ETFMN  $eTFMN
     * @return \Illuminate\Http\Response
     */
    public function show(ETFMN $eTFMN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\ETFMN  $eTFMN
     * @return \Illuminate\Http\Response
     */
    public function edit(ETFMN $eTFMN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\ETFMN  $eTFMN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ETFMN $eTFMN)
    {
        $eTFMN->evolucion = $request->evolucion;
        $eTFMN->tratamiento = $request->tratamiento;
        $eTFMN->parametros_fmn_id = $request->parametros_fmn_id;
        $eTFMN->save();

        return response()->json(["Registro" => $eTFMN, "Mensaje" => "Felicidades Actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\ETFMN  $eTFMN
     * @return \Illuminate\Http\Response
     */
    public function destroy(ETFMN $eTFMN)
    {
        $eTFMN->delete();

        return response()->json(["Registro" => $eTFMN, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
