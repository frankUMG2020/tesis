<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\EnfermedadHistorial;
use Illuminate\Http\Request;

class EnfermedadHistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = EnfermedadHistorial::with('configuracion_enfermedad')->get();

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
        $insert = new EnfermedadHistorial();
        $insert->cantidad = $request->cantidad;
        $insert->historial_fmn_id = $request->historial_fmn_id;
        $insert->configuracion_enfermedad_id = $request->configuracion_enfermedad_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\EnfermedadHistorial  $enfermedadHistorial
     * @return \Illuminate\Http\Response
     */
    public function show(EnfermedadHistorial $enfermedadHistorial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\EnfermedadHistorial  $enfermedadHistorial
     * @return \Illuminate\Http\Response
     */
    public function edit(EnfermedadHistorial $enfermedadHistorial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\EnfermedadHistorial  $enfermedadHistorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnfermedadHistorial $enfermedadHistorial)
    {
        $enfermedadHistorial->cantidad = $request->cantidad;
        $enfermedadHistorial->historial_fmn_id = $request->historial_fmn_id;
        $enfermedadHistorial->configuracion_enfermedad_id = $request->configuracion_enfermedad_id;
        $enfermedadHistorial->save();

        return response()->json(["Registro" => $enfermedadHistorial, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\EnfermedadHistorial  $enfermedadHistorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnfermedadHistorial $enfermedadHistorial)
    {
        $enfermedadHistorial->delete();

        return response()->json(["Registro" => $enfermedadHistorial, "Mensaje" => "Felicidades eliminaste"]);
    }
}
