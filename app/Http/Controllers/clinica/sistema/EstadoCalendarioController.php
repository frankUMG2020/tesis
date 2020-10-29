<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\clinica\sistema\EstadoCalendario;

class EstadoCalendarioController extends Controller
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
        $this->middleware('medico');
        $this->middleware('secretaria');
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
                $values = EstadoCalendario::search($request->buscar)->paginate(10);
            else
                $values = EstadoCalendario::paginate(10);

            return view('clinica.catalogo.estado_calendario.index', ['values' => $values]);
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
            return view('clinica.catalogo.estado_calendario.create');
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
                'nombre' => 'required|max:20',
            ]
        );
        try {
            $insert = new EstadoCalendario();
            $insert->nombre = $request->nombre;
            $insert->save();

            return redirect()->route('estadoCalendario.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('estadoCalendario.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('estadoCalendario.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\EstadoCalendario  $estadoCalendario
     * @return \Illuminate\Http\Response
     */
    public function show(EstadoCalendario $estadoCalendario)
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
     * @param  \App\Models\clinica\sistema\EstadoCalendario  $estadoCalendario
     * @return \Illuminate\Http\Response
     */
    public function edit(EstadoCalendario $estadoCalendario)
    {
        try {
            return view('clinica.catalogo.estado_calendario.edit', compact('estadoCalendario'));
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
     * @param  \App\Models\clinica\sistema\EstadoCalendario  $estadoCalendario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstadoCalendario $estadoCalendario)
    {
        $this->validate(
            $request,
            [
                'nombre' => 'required|max:20'.$estadoCalendario->id
            ]
        );

        try {
            $estadoCalendario->nombre = $request->nombre;

            if (!$estadoCalendario->isDirty())
                return redirect()->route('estadoCalendario.edit', $estadoCalendario->id)->with('warning', '¡No existe información nueva para actualizar!');

            $estadoCalendario->save();

            return redirect()->route('estadoCalendario.index')->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if($th instanceof QueryException) {
                return redirect()->route('estadoCalendario.edit', $estadoCalendario->id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('estadoCalendario.edit', $estadoCalendario->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\EstadoCalendario  $estadoCalendario
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstadoCalendario $estadoCalendario)
    {
        try {
            $estadoCalendario->delete();

            return redirect()->route('estadoCalendario.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
