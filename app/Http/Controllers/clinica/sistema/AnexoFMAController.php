<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\clinica\sistema\AnexoFMA;

class AnexoFMAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = AnexoFMA::get();

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
        $insert = new AnexoFMA();
        $insert->nombre = $request->nombre;

        $image = $request->file('path');
        $nueva = Storage::disk('anexo_fma')->put('/', $image);
        $insert->path = $nueva;
        
        $insert->historial_fma_id = $request->historial_fma_id;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades Insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\AnexoFMA  $anexoFMA
     * @return \Illuminate\Http\Response
     */
    public function show(AnexoFMA $anexoFMA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\AnexoFMA  $anexoFMA
     * @return \Illuminate\Http\Response
     */
    public function edit(AnexoFMA $anexoFMA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\AnexoFMA  $anexoFMA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnexoFMA $anexoFMA)
    {
        $anexoFMA->nombre = $request->nombre;

        $image = $request->file('path');
        $nueva = Storage::disk('anexo_fmn')->put('/', $image);
        $anexoFMA->path = $nueva;

        $anexoFMA->historial_fma_id = $request->path;
        $anexoFMA->save();

        return response()->json(["Registro" => $anexoFMA, "Mensaje" => "Felicidades Actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\AnexoFMA  $anexoFMA
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnexoFMA $anexoFMA)
    {
        $anexoFMA->delete();

        return response()->json(["Registro" => $anexoFMA, "Mensaje" => "Felicidades Eliminaste"]);
    }
}
