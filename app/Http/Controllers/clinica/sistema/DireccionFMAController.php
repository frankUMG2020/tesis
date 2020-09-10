<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\DireccionFMA;
use Illuminate\Http\Request;

class DireccionFMAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = DireccionFMA::with('municipio')->get();

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
        $insert = new DireccionFMA();
        $insert->direccion = $request->direccion;
        $insert->ficha_medica_a_id = $request->ficha_medica_a_id;
        $insert->municipio_id = $request->municipio_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\DireccionFMA  $direccionFMA
     * @return \Illuminate\Http\Response
     */
    public function show(DireccionFMA $direccionFMA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\DireccionFMA  $direccionFMA
     * @return \Illuminate\Http\Response
     */
    public function edit(DireccionFMA $direccionFMA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\DireccionFMA  $direccionFMA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DireccionFMA $direccionFMA)
    {
        $direccionFMA->direccion = $request->direccion;
        $direccionFMA->ficha_medica_a_id = $request->ficha_medica_a_id;
        $direccionFMA->municipio_id = $request->municipio_id;
        $direccionFMA->save();

        return response()->json(["Registro" => $direccionFMA, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\DireccionFMA  $direccionFMA
     * @return \Illuminate\Http\Response
     */
    public function destroy(DireccionFMA $direccionFMA)
    {
        $direccionFMA->delete();

        return response()->json(["Registro" => $direccionFMA, "Mensaje" => "Felicidades eliminaste"]);
    }
}
