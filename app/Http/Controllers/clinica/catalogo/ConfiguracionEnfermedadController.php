<?php

namespace App\Http\Controllers\clinica\catalogo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\clinica\catalogo\ConfiguracionEnfermedad;

class ConfiguracionEnfermedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if (isset($request->buscar))
                $values = ConfiguracionEnfermedad::search($request->buscar)->paginate(10);
            else
                $values = ConfiguracionEnfermedad::paginate(10);

            return view('clinica.catalogo.configuracion_enfermedad.index', ['values' => $values]);
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
            return view('clinica.catalogo.configuracion_enfermedad.create');
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
            $insert = new ConfiguracionEnfermedad();
            $insert->nombre = $request->nombre;
            $insert->save();

            return redirect()->route('configuracionEnfermedad.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('configuracionEnfermedad.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('configuracionEnfermedad.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\ConfiguracionEnfermedad  $configuracionEnfermedad
     * @return \Illuminate\Http\Response
     */
    public function show(ConfiguracionEnfermedad $configuracionEnfermedad)
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
     * @param  \App\Models\clinica\catalogo\ConfiguracionEnfermedad  $configuracionEnfermedad
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfiguracionEnfermedad $configuracionEnfermedad)
    {
        try {
            return view('clinica.catalogo.configuracion_enfermedad.edit', compact('configuracionEnfermedad'));
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
     * @param  \App\Models\clinica\catalogo\ConfiguracionEnfermedad  $configuracionEnfermedad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConfiguracionEnfermedad $configuracionEnfermedad)
    {
        $this->validate(
            $request,
            [
                'nombre' => 'required|max:20',
            ]
        );
        try {
            $configuracionEnfermedad->nombre = $request->nombre;

            if (!$configuracionEnfermedad->isDirty())
                return redirect()->route('configuracionEnfermedad.edit', $configuracionEnfermedad->id)->with('warning', '¡No existe información nueva para actualizar!');

            $configuracionEnfermedad->save();

            return redirect()->route('configuracionEnfermedad.index')->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if($th instanceof QueryException) {
                return redirect()->route('configuracionEnfermedad.edit', $configuracionEnfermedad->id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('configuracionEnfermedad.edit', $configuracionEnfermedad->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\ConfiguracionEnfermedad  $configuracionEnfermedad
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfiguracionEnfermedad $configuracionEnfermedad)
    {
        try {
            $configuracionEnfermedad->delete();

            return redirect()->route('configuracionEnfermedad.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
