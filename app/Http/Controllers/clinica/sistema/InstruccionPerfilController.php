<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\InstruccionPerfil;
use Illuminate\Http\Request;

class InstruccionPerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = InstruccionPerfil::get();

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
        $insert = new InstruccionPerfil();
        $insert->descripcion = $request->descripcion;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\InstruccionPerfil  $instruccionPerfil
     * @return \Illuminate\Http\Response
     */
    public function show(InstruccionPerfil $instruccionPerfil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\InstruccionPerfil  $instruccionPerfil
     * @return \Illuminate\Http\Response
     */
    public function edit(InstruccionPerfil $instruccionPerfil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\InstruccionPerfil  $instruccionPerfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstruccionPerfil $instruccionPerfil)
    {
        $instruccionPerfil->descripcion = $request->descripcion;
        $instruccionPerfil->save();

        return response()->json(["Registro" => $instruccionPerfil, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\InstruccionPerfil  $instruccionPerfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstruccionPerfil $instruccionPerfil)
    {
        $instruccionPerfil->delete();

        return response()->json(["Registro" => $instruccionPerfil, "Mensaje" => "Felicidades eliminaste"]);
    }
}
