<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\clinica\catalogo\Vacuna;
use App\Models\clinica\sistema\HistorialFMN;
use Illuminate\Database\QueryException;
use App\Models\clinica\sistema\Inmuncion;

class InmuncionController extends Controller
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
        $this->middleware('secretaria')->only('destroy');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if (isset($request->buscar))
                $values = Inmuncion::search($request->buscar)->paginate(10);
            else
                $values = Inmuncion::paginate(10);

            return view('clinica.catalogo.inmuncion.index', ['values' => $values]);
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
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
            $historial_fmn = HistorialFMN::all();
            $vacunas = Vacuna::all();

            return view('clinica.catalogo.inmuncion.create', compact('historial_fmn', 'vacunas'));
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
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
                'restante' => 'required|max:20',
                'historial_fmn_id' => 'required|integer|exists:historial_fmn,id',
                'vacuna_id' => 'required|integer|exists:vacuna,id',
            ]
        );

        try {
            $insert = new Inmuncion();
            $insert->restante = $request->restante;
            $insert->historial_fmn_id = $request->historial_fmn_id;
            $insert->vacuna_id = $request->vacuna_id;
            $insert->save();

            return redirect()->route('inmuncion.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('inmuncion.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('inmuncion.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\Inmuncion  $inmuncion
     * @return \Illuminate\Http\Response
     */
    public function show(Inmuncion $inmuncion)
    {
        try {
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
     * @param  \App\Models\clinica\sistema\Inmuncion  $inmuncion
     * @return \Illuminate\Http\Response
     */
    public function edit(Inmuncion $inmuncion)
    {
        try {
            $historial = HistorialFMN::all();
            $vacunas = Vacuna::all();

            return view('clinica.catalogo.inmuncion.edit', ['valor' => $inmuncion, 'historial' => $historial, 'vacunas' => $vacunas]);
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\Inmuncion  $inmuncion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inmuncion $inmuncion)
    {
        $this->validate(
            $request,
            [
                'restante' => 'required|max:20'.$inmuncion->id,
                'historial_fmn_id' => 'required|integer|exists:historial_fmn,id'.$inmuncion->id,
                'vacuna_id' => 'required|integer|exists:vacuna_id,id'.$inmuncion->id,
            ]
        );
        
        try {
            $inmuncion->nombre = $request->nombre;
            $inmuncion->historial_fmn_id = $request->historial_fmn_id;
            $inmuncion->vacuna_id = $request->vacuna_id;

            if (!$inmuncion->isDirty())
                return redirect()->route('inmuncion.edit', $inmuncion->id)->with('warning', '¡No existe información nueva para actualizar!');

            $inmuncion->save();

            return redirect()->route('inmuncion.index')->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('inmuncion.edit', $inmuncion->id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('inmuncion.edit', $inmuncion->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\Inmuncion  $inmuncion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inmuncion $inmuncion)
    {
        try {
            $inmuncion->delete();

            return redirect()->route('inmuncion.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
