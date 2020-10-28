<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\clinica\sistema\TelefonoFMA;
use App\Models\clinica\sistema\FichaMedicaA;

class TelefonoFMAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate(
            $request,
            [
                'ficha_medica_a_id' => 'required|integer|exists:ficha_medica_a,id',
                'numero' => 'nullable|digits_between:8,8'
            ]
        );

        try {
            DB::beginTransaction();

            $telefono = new TelefonoFMA();
            $telefono->numero = $request->numero;
            $telefono->ficha_medica_a_id = $request->ficha_medica_a_id;
            $telefono->save();

            DB::commit();

            return redirect()->route('historialFMA.show', $request->ficha_medica_a_id)->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('historialFMA.show', $request->ficha_medica_a_id)->with('danger', $th->getMessage());
            } else {
                return redirect()->route('historialFMA.show', $request->ficha_medica_a_id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\FichaMedicaA  $telefonoFMA
     * @return \Illuminate\Http\Response
     */
    public function show(FichaMedicaA $telefonoFMA)
    {
        try {
            return view('clinica.sistema.ficha_medica_a.telefono.create', compact('telefonoFMA'));
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\TelefonoFMA  $telefonoFMA
     * @return \Illuminate\Http\Response
     */
    public function edit(TelefonoFMA $telefonoFMA)
    {
        try {
            DB::beginTransaction();

            $telefonoFMA->delete();

            DB::commit();

            return redirect()->route('historialFMA.show', $telefonoFMA->ficha_medica_a_id)->with('success', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('historialFMA.show', $telefonoFMA->ficha_medica_a_id)->with('danger', $th->getMessage());
            } else {
                return redirect()->route('historialFMA.show', $telefonoFMA->ficha_medica_a_id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\TelefonoFMA  $telefonoFMA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TelefonoFMA $telefonoFMA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\TelefonoFMA  $telefonoFMA
     * @return \Illuminate\Http\Response
     */
    public function destroy(TelefonoFMA $telefonoFMA)
    {
        //
    }
}
