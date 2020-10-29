<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\clinica\catalogo\TipoCita;
use App\Models\clinica\sistema\FichaMedicaA;
use App\Models\clinica\sistema\CalendarioFMA;
use App\Models\clinica\sistema\EstadoCalendario;

class CalendarioFMAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $values = CalendarioFMA::orderByDesc('created_at')->paginate(12);
            
            return view('clinica.sistema.calendario.index', ['values' => $values]);
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', $th->getMessage());
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $pacientes = FichaMedicaA::all();
            $tipos = TipoCita::all();

            return view('clinica.sistema.calendario.create', compact('pacientes', 'tipos'));
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('calendarioFMA.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('calendarioFMA.index')->with('danger', $th->getMessage());
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
                'cita' => 'required|max:75',
                'fecha' => 'required|date_format:d-m-Y',
                'hora' => 'required|date_format:H:i:s',
                'ficha_medica_a_id' => 'required|integer|exists:ficha_medica_a,id',
                'tipo_cita_id' => 'required|integer|exists:tipo_cita,id'
            ]
        );

        try {
            DB::beginTransaction();

            $insert = new CalendarioFMA();
            $insert->cita = $request->cita;
            $insert->fecha = date('Y-m-d', strtotime($request->fecha));
            $insert->hora = $request->hora;
            $insert->ficha_medica_a_id = $request->ficha_medica_a_id;
            $insert->tipo_cita_id = $request->tipo_cita_id;
            $insert->estado_calendario_id = 1;
            $insert->save();

            DB::commit();

            return redirect()->route('calendarioFMA.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('calendarioFMA.create')->with('danger', $th->getMessage());
            } else {
                return redirect()->route('calendarioFMA.create')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\CalendarioFMA  $calendarioFMA
     * @return \Illuminate\Http\Response
     */
    public function show(CalendarioFMA $calendarioFMA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\CalendarioFMA  $calendarioFMA
     * @return \Illuminate\Http\Response
     */
    public function edit(CalendarioFMA $calendarioFMA)
    {
        try {
            $pacientes = FichaMedicaA::all();
            $tipos = TipoCita::all();
            $estados = EstadoCalendario::all();

            return view('clinica.sistema.calendario.edit', compact('pacientes', 'tipos', 'calendarioFMA', 'estados'));
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('calendarioFMA.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('calendarioFMA.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\CalendarioFMA  $calendarioFMA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalendarioFMA $calendarioFMA)
    {
        $this->validate(
            $request,
            [
                'cita' => 'required|max:75',
                'fecha' => 'required|date_format:d-m-Y',
                'hora' => 'required|date_format:H:i:s',
                'ficha_medica_a_id' => 'required|integer|exists:ficha_medica_a,id',
                'tipo_cita_id' => 'required|integer|exists:tipo_cita,id',
                'estado_calendario_id' => 'required|integer|exists:estado_calendario,id'
            ]
        );

        try {
            DB::beginTransaction();

            $calendarioFMA->cita = $request->cita;
            $calendarioFMA->fecha = date('Y-m-d', strtotime($request->fecha));
            $calendarioFMA->hora = $request->hora;
            $calendarioFMA->ficha_medica_a_id = $request->ficha_medica_a_id;
            $calendarioFMA->tipo_cita_id = $request->tipo_cita_id;
            $calendarioFMA->estado_calendario_id = $request->estado_calendario_id;

            if (!$calendarioFMA->isDirty())
                return redirect()->route('calendarioFMA.edit', $calendarioFMA->id)->with('warning', '¡No existe información nueva para actualizar!');

            $calendarioFMA->save();

            DB::commit();

            return redirect()->route('calendarioFMA.index')->with('success', '¡Registro modificado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('calendarioFMA.index')->with('danger', $th->getMessage());
            } else {
                return redirect()->route('calendarioFMA.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\CalendarioFMA  $calendarioFMA
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalendarioFMA $calendarioFMA)
    {
        try {
            DB::beginTransaction();

            $calendarioFMA->delete();

            DB::commit();

            return redirect()->route('calendarioFMA.index')->with('success', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('calendarioFMA.index')->with('danger', $th->getMessage());
            } else {
                return redirect()->route('calendarioFMA.index')->with('danger', $th->getMessage());
            }
        }
    }
}
