<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\PerfilExamen;

class PerfilExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = PerfilExamen::get();

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
        $existe = PerfilExamen::where('perfil_id', $request->perfil_id)->where('examen_id', $request->examen_id)->first();
        
        if(!is_null($existe))
            return response()->json(["Mensaje" => "Ya existe"]);


        $insert = new PerfilExamen();
        $insert->perfil_id = $request->perfil_id;
        $insert->examen_id = $request->examen_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\PerfilExamen  $perfilExamen
     * @return \Illuminate\Http\Response
     */
    public function show(PerfilExamen $perfilExamen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\PerfilExamen  $perfilExamen
     * @return \Illuminate\Http\Response
     */
    public function edit(PerfilExamen $perfilExamen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\PerfilExamen  $perfilExamen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PerfilExamen $perfilExamen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\PerfilExamen  $perfilExamen
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerfilExamen $perfilExamen)
    {
        $perfilExamen->delete();

        return response()->json(["Registro" => $perfilExamen, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
