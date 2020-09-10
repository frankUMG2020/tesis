<?php

namespace App\Http\Controllers\clinica\catalogo;

use App\Http\Controllers\Controller;
use App\Models\clinica\catalogo\Parto;
use Illuminate\Http\Request;

class PartoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = Parto::get();

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
        $insert = new Parto();
        $insert->nombre = $request->nombre;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\Parto  $parto
     * @return \Illuminate\Http\Response
     */
    public function show(Parto $parto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\Parto  $parto
     * @return \Illuminate\Http\Response
     */
    public function edit(Parto $parto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\catalogo\Parto  $parto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parto $parto)
    {
        $parto->nombre = $request->nombre;
        $parto->save();

        return response()->json(["Registro" => $parto, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\Parto  $parto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parto $parto)
    {
        $parto->delete();

        return response()->json(["Registro" => $parto, "Mensaje" => "Felicidades eliminaste"]);
    }
}
