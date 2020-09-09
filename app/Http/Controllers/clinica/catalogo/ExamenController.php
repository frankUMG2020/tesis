<?php

namespace App\Http\Controllers\clinica\catalogo;

use App\Http\Controllers\Controller;
use App\Models\clinica\catalogo\Examen;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = Examen::with('laboratorio', 'categoria_examen')->get();

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
        $insert = new Examen();
        $insert->nombre = $request->nombre;
        $insert->laboratorio_id = $request->laboratorio_id;
        $insert->categoria_examen_id = $request->categoria_examen_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\Examen  $examen
     * @return \Illuminate\Http\Response
     */
    public function show(Examen $examen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\Examen  $examen
     * @return \Illuminate\Http\Response
     */
    public function edit(Examen $examen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\catalogo\Examen  $examen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Examen $examen)
    {
        $examen->nombre = $request->nombre;
        $examen->laboratorio_id = $request->laboratorio_id;
        $examen->categoria_examen_id = $request->categoria_examen_id;
        $examen->save();
        
        return response()->json(["Registro" => $examen, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\Examen  $examen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examen $examen)
    {
        $examen->delete();

        return response()->json(["Registro" => $examen, "Mensaje" => "Felicidades eliminaste"]);
    }
}
