<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\DireccionFMN;
use Illuminate\Http\Request;

class DireccionFMNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = DireccionFMN::with('municipio')->get();

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
        $insert = new DireccionFMN();
        $insert->direccion = $request->direccion;
        $insert->ficha_medica_n_id = $request->ficha_medica_n_id;
        $insert->municipio_id = $request->municipio_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\DireccionFMN  $direccionFMN
     * @return \Illuminate\Http\Response
     */
    public function show(DireccionFMN $direccionFMN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\DireccionFMN  $direccionFMN
     * @return \Illuminate\Http\Response
     */
    public function edit(DireccionFMN $direccionFMN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\DireccionFMN  $direccionFMN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DireccionFMN $direccionFMN)
    {
        $direccionFMN->direccion = $request->direccion;
        $direccionFMN->ficha_medica_n_id = $request->ficha_medica_n_id;
        $direccionFMN->municipio_id = $request->municipio_id;
        $direccionFMN->save();

        return response()->json(["Registro" => $direccionFMN, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\DireccionFMN  $direccionFMN
     * @return \Illuminate\Http\Response
     */
    public function destroy(DireccionFMN $direccionFMN)
    {
        $direccionFMN->delete();

        return response()->json(["Registro" => $direccionFMN, "Mensaje" => "Felicidades eliminaste"]);
    }
}
