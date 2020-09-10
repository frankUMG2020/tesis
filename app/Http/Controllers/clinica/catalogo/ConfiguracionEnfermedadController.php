<?php

namespace App\Http\Controllers\clinica\catalogo;

use App\Http\Controllers\Controller;
use App\Models\clinica\catalogo\ConfiguracionEnfermedad;
use Illuminate\Http\Request;

class ConfiguracionEnfermedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = ConfiguracionEnfermedad::get();
        
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
        $insert = new ConfiguracionEnfermedad();
        $insert->nombre = $request->nombre;
        $insert->save();
        
        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\ConfiguracionEnfermedad  $configuracionEnfermedad
     * @return \Illuminate\Http\Response
     */
    public function show(ConfiguracionEnfermedad $configuracionEnfermedad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\ConfiguracionEnfermedad  $configuracionEnfermedad
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfiguracionEnfermedad $configuracionEnfermedad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\catalogo\ConfiguracionEnfermedad  $configuracionEnfermedad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConfiguracionEnfermedad $configuracionEnfermedad)
    {
        $configuracionEnfermedad->nombre = $request->nombre;
        $configuracionEnfermedad->save();

        return response()->json(["Registro" => $configuracionEnfermedad, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\ConfiguracionEnfermedad  $configuracionEnfermedad
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfiguracionEnfermedad $configuracionEnfermedad)
    {
        $configuracionEnfermedad->delete();

        return response()->json(["Registro" => $configuracionEnfermedad, "Mensaje" => "Felicidades eliminaste"]);
    }
}
