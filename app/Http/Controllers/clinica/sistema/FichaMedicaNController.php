<?php

namespace App\Http\Controllers\clinica\sistema;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\FichaMedicaN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FichaMedicaNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = FichaMedicaN::get();

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
        $insert = new FichaMedicaN();
        $insert->fecha = date('Y-m-d', strtotime($request->fecha));
        $insert->padre = $request->padre;
        $insert->madre = $request->madre;
        $insert->referido = $request->referido;
        $insert->email = $request->email;
        $insert->lugar_nacimiento = $request->lugar_nacimiento;
        $insert->foto = null;
        $insert->municipio_id = $request->municipio_id;
        $insert->persona_id = $request->persona_id;
        $insert->parto_id = $request->parto_id;
        $insert->alimentacion_id = $request->alimentacion_id;
        $insert->save();

        $image = $request->file('foto');
        $nueva = Storage::disk('foto_fmn')->put('/', $image);
        $insert->foto = $nueva;
        $insert->save();

        return response()->json(["Registro" => $insert, "Mensaje" => "Felicidades insertaste"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\FichaMedicaN  $fichaMedicaN
     * @return \Illuminate\Http\Response
     */
    public function show(FichaMedicaN $fichaMedicaN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\FichaMedicaN  $fichaMedicaN
     * @return \Illuminate\Http\Response
     */
    public function edit(FichaMedicaN $fichaMedicaN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\FichaMedicaN  $fichaMedicaN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FichaMedicaN $fichaMedicaN)
    {
        $fichaMedicaN->fecha = $request->fecha;
        $fichaMedicaN->padre = $request->padre;
        $fichaMedicaN->madre = $request->madre;
        $fichaMedicaN->referido = $request->referido;
        $fichaMedicaN->email = $request->email;
        $fichaMedicaN->lugar_nacimiento = $request->lugar_nacimiento;
        $fichaMedicaN->foto = $request->foto;
        $fichaMedicaN->municipio_id = $request->municipio_id;
        $fichaMedicaN->persona_id = $request->persona_id;
        $fichaMedicaN->parto_id = $request->parto_id;
        $fichaMedicaN->alimentacion_id = $request->alimentacion_id;
        $fichaMedicaN->save();

        return response()->json(["Registro" => $fichaMedicaN, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\FichaMedicaN  $fichaMedicaN
     * @return \Illuminate\Http\Response
     */
    public function destroy(FichaMedicaN $fichaMedicaN)
    {
        $fichaMedicaN->delete();

        return response()->json(["Registro" => $fichaMedicaN, "Mensaje" => "Felicidades eliminaste"]);
    }
}
