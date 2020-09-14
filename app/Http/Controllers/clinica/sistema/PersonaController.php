<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = Persona::get();

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
        $insert = new Persona();
        $insert->nombre_uno = $request->nombre_uno;
        $insert->nombre_dos = $request->nombre_dos;
        $insert->apellido_uno = $request->apellido_uno;
        $insert->apellido_dos = $request->apellido_dos;
        $insert->sexo = $request->sexo;
        $insert->fecha_nacimiento = date('Y-m-d', strtotime($request->fecha_nacimiento));
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        $persona->nombre_uno = $request->nombre_uno;
        $persona->nombre_dos = $request->nombre_dos;
        $persona->apellido_uno = $request->apellido_uno;
        $persona->apellido_dos = $request->apellido_dos;
        $persona->sexo = $request->sexo;
        $persona->fecha_nacimiento = date('Y-m-d', strtotime($request->fecha_nacimiento));
        $persona->save();

        return response()->json(["Registro" => $persona, "Mensaje" => "Felicidades Actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();

        return response()->json(["Registro" => $persona, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
