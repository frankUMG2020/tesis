<?php

namespace App\Http\Controllers\clinica\seguridad;

use App\Http\Controllers\Controller;
use App\Models\clinica\seguridad\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = Usuario::get();

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
        $insert = new Usuario();
        $insert->nombre_completo = $request->nombre_completo;
        $insert->email = $request->email;
        $insert->password = $request->password;
        $insert->activo = $request->activo;
        $insert->persona_id = $request->persona_id;
        $insert->rol_id = $request->rol_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades Insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\seguridad\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\seguridad\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\seguridad\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $usuario->nombre_completo = $request->nombre_completo;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        $usuario->activo = $request->activo;
        $usuario->persona_id = $request->persona_id;
        $usuario->rol_id = $request->rol_id;
        $usuario->save();

        return response()->json(["Registro" => $usuario, "Mensaje" => "Felicidades Actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\seguridad\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return response()->json(["Registro" => $usuario, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
