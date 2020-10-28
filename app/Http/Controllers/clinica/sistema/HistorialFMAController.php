<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\clinica\sistema\FichaMedicaA;
use App\Models\clinica\sistema\HistorialFMA;
use App\Models\clinica\sistema\ParametroFMA;

class HistorialFMAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = HistorialFMA::get();

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

    public function create_historial(FichaMedicaA $ficha_medica_a_id)
    {
        try {
            return view('clinica.sistema.ficha_medica_a.historial.create', compact('ficha_medica_a_id'));
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('historialFMA.show', $ficha_medica_a_id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('historialFMA.show', $ficha_medica_a_id)->with('danger', $th->getMessage());
            }
        }
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
                'peso' => 'required|numeric',
                'talla' => 'required|numeric',
                'pulso' => 'required|numeric',
                'temperatura' => 'required|numeric',
                'p_a' => 'required|numeric',
                'respiracion' => 'required|numeric',
                'so_dos' => 'required|numeric',

                'parametro_uno' => 'nullable|max:2500',
                'parametro_dos' => 'nullable|max:2500',
                'parametro_tres' => 'nullable|max:2500',
                'parametro_cuatro' => 'nullable|max:2500',
                'parametro_seis' => 'nullable|max:2500',
                'parametro_siete' => 'nullable|max:2500',
                'parametro_ocho' => 'nullable|max:2500',
                'parametro_nueve' => 'nullable|max:2500',
                'parametro_diez' => 'nullable|max:2500',
                'parametro_once' => 'nullable|max:2500',
                'parametro_doce' => 'nullable|max:2500',
                'parametro_trece' => 'nullable|max:2500',

                'ficha_medica_a_id' => 'required|integer|exists:ficha_medica_a,id'
            ]
        );

        try {
            DB::beginTransaction();

                $ficha = FichaMedicaA::find($request->ficha_medica_a_id);
                $generar = HistorialFMA::where('ficha_medica_a_id', $ficha->id)->whereYear('created_at', date('Y'))->get()->last();

                $correlativo = is_null($generar) ? 1 : $generar->correlativo + 1;
                if(!is_null($ficha->codigo_epps) && !empty($ficha->codigo_epps)) {
                    $codigo = $ficha->codigo_epps .'-'. str_pad(strval($correlativo), 3, "0", STR_PAD_LEFT) . '-' . date('Y');
                } else {
                    $codigo = str_pad(strval($correlativo), 3, "0", STR_PAD_LEFT) . '-' . date('Y');
                }

                $historial = new HistorialFMA();
                $historial->correlativo = $correlativo;
                $historial->codigo = $codigo;
                $historial->edad = $ficha->persona->edadPersona();
                $historial->peso = $request->peso;
                $historial->talla = $request->talla;
                $historial->pulso = $request->pulso;
                $historial->temperatura = $request->temperatura;
                $historial->p_a = $request->p_a;
                $historial->respiracion = $request->respiracion;
                $historial->so_dos = $request->so_dos;
                $historial->ficha_medica_a_id = $ficha->id;
                $historial->save();

                $parametro = new ParametroFMA();
                $parametro->parametro_uno = $request->parametro_uno;
                $parametro->parametro_dos = $request->parametro_dos;
                $parametro->parametro_tres = $request->parametro_tres;
                $parametro->parametro_cuatro = $request->parametro_cuatro;
                $parametro->parametro_seis = $request->parametro_seis;
                $parametro->parametro_siete = $request->parametro_siete;
                $parametro->parametro_ocho = $request->parametro_ocho;
                $parametro->parametro_nueve = $request->parametro_nueve;
                $parametro->parametro_diez = $request->parametro_diez;
                $parametro->parametro_once = $request->parametro_once;
                $parametro->parametro_doce = $request->parametro_doce;
                $parametro->parametro_trece = $request->parametro_trece;
                $parametro->historial_fma_id = $historial->id;
                $parametro->save();


            DB::commit();

            return redirect()->route('historialFMA.show', $ficha->id)->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('historialFMA.show', $ficha->id)->with('danger', $th->getMessage());
            } else {
                return redirect()->route('historialFMA.show', $ficha->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\FichaMedicaA  $historialFMA
     * @return \Illuminate\Http\Response
     */
    public function show(FichaMedicaA $historialFMA)
    {
        try {
            $historiales = HistorialFMA::with('parametro')->where('ficha_medica_a_id', $historialFMA->id)->orderByDesc('created_at')->paginate(10);
            return view('clinica.sistema.ficha_medica_a.historial.index', compact('historialFMA', 'historiales'));
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', $th->getMessage());
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\HistorialFMA  $historialFMA
     * @return \Illuminate\Http\Response
     */
    public function edit(HistorialFMA $historialFMA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\HistorialFMA  $historialFMA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistorialFMA $historialFMA)
    {
        $this->validate(
            $request,
            [
                'peso' => 'required|numeric',
                'talla' => 'required|numeric',
                'pulso' => 'required|numeric',
                'temperatura' => 'required|numeric',
                'p_a' => 'required|numeric',
                'respiracion' => 'required|numeric',
                'so_dos' => 'required|numeric',

                'parametro_uno' => 'nullable|max:2500',
                'parametro_dos' => 'nullable|max:2500',
                'parametro_tres' => 'nullable|max:2500',
                'parametro_cuatro' => 'nullable|max:2500',
                'parametro_seis' => 'nullable|max:2500',
                'parametro_siete' => 'nullable|max:2500',
                'parametro_ocho' => 'nullable|max:2500',
                'parametro_nueve' => 'nullable|max:2500',
                'parametro_diez' => 'nullable|max:2500',
                'parametro_once' => 'nullable|max:2500',
                'parametro_doce' => 'nullable|max:2500',
                'parametro_trece' => 'nullable|max:2500',

                'parametros_fma_id' => 'required|integer|exists:parametros_fma,id'
            ]
        );

        try {
            DB::beginTransaction();

            $ficha = FichaMedicaA::find($historialFMA->ficha_medica_a_id);

            $historialFMA->edad = $ficha->persona->edadPersona();
            $historialFMA->peso = $request->peso;
            $historialFMA->talla = $request->talla;
            $historialFMA->pulso = $request->pulso;
            $historialFMA->temperatura = $request->temperatura;
            $historialFMA->p_a = $request->p_a;
            $historialFMA->respiracion = $request->respiracion;
            $historialFMA->so_dos = $request->so_dos;
            $historialFMA->save();

            $parametro = ParametroFMA::find($request->parametros_fma_id);
            $parametro->parametro_uno = $request->parametro_uno;
            $parametro->parametro_dos = $request->parametro_dos;
            $parametro->parametro_tres = $request->parametro_tres;
            $parametro->parametro_cuatro = $request->parametro_cuatro;
            $parametro->parametro_seis = $request->parametro_seis;
            $parametro->parametro_siete = $request->parametro_siete;
            $parametro->parametro_ocho = $request->parametro_ocho;
            $parametro->parametro_nueve = $request->parametro_nueve;
            $parametro->parametro_diez = $request->parametro_diez;
            $parametro->parametro_once = $request->parametro_once;
            $parametro->parametro_doce = $request->parametro_doce;
            $parametro->parametro_trece = $request->parametro_trece;
            $parametro->save();

            DB::commit();

            return redirect()->route('historialFMA.show', $ficha->id)->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('historialFMA.show', $ficha->id)->with('danger', $th->getMessage());
            } else {
                return redirect()->route('historialFMA.show', $ficha->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\HistorialFMA  $historialFMA
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistorialFMA $historialFMA)
    {
        try {
            DB::beginTransaction();

            ParametroFMA::where('historial_fma_id', $historialFMA->id)->forceDelete();
            $historialFMA->forceDelete();

            DB::commit();

            return redirect()->route('historialFMA.show', $historialFMA->ficha_medica_a_id)->with('success', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('historialFMA.show', $historialFMA->ficha_medica_a_id)->with('danger', $th->getMessage());
            } else {
                return redirect()->route('historialFMA.show', $historialFMA->ficha_medica_a_id)->with('danger', $th->getMessage());
            }
        }      
    }
}
