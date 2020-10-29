<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\clinica\catalogo\Municipio;
use App\Models\clinica\sistema\DireccionFMA;
use App\Models\clinica\sistema\FichaMedicaA;

class DireccionFMAController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('administrador');
        //$this->middleware('medico');
        $this->middleware('secretaria')->only('edit');
    }

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
                'municipio_id' => 'required|integer|exists:municipio,id',
                'direccion' => 'required|max:200',
            ]
        );

        try {
            DB::beginTransaction();

            $direccion = new DireccionFMA();
            $direccion->direccion = $request->direccion;
            $direccion->municipio_id = $request->municipio_id;
            $direccion->ficha_medica_a_id = $request->ficha_medica_a_id;
            $direccion->save();

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
     * @param  \App\Models\clinica\sistema\FichaMedicaA  $direccionFMA
     * @return \Illuminate\Http\Response
     */
    public function show(FichaMedicaA $direccionFMA)
    {
        try {
            $municipios = Municipio::all();

            return view('clinica.sistema.ficha_medica_a.direccion.create', compact('direccionFMA', 'municipios'));
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
     * @param  \App\Models\clinica\sistema\DireccionFMA  $direccionFMA
     * @return \Illuminate\Http\Response
     */
    public function edit(DireccionFMA $direccionFMA)
    {
        try {
            DB::beginTransaction();

            $direccionFMA->delete();

            DB::commit();

            return redirect()->route('historialFMA.show', $direccionFMA->ficha_medica_a_id)->with('success', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('historialFMA.show', $direccionFMA->ficha_medica_a_id)->with('danger', $th->getMessage());
            } else {
                return redirect()->route('historialFMA.show', $direccionFMA->ficha_medica_a_id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\DireccionFMA  $direccionFMA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DireccionFMA $direccionFMA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\DireccionFMA  $direccionFMA
     * @return \Illuminate\Http\Response
     */
    public function destroy(DireccionFMA $direccionFMA)
    {
        //
    }
}
