<?php

namespace App\Http\Controllers\clinica\catalogo;

use App\Http\Controllers\Controller;
use App\Models\clinica\catalogo\Alimentacion;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AlimentacionController extends Controller
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
                $values = Alimentacion::search($request->buscar)->paginate(10);
            else
                $values = Alimentacion::paginate(10);

            return view('clinica.catalogo.alimentacion.index', ['values' => $values]);
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
            return view('clinica.catalogo.alimentacion.create');
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
            $insert = new Alimentacion();
            $insert->nombre = $request->nombre;
            $insert->save();

            return redirect()->route('alimentacion.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('alimentacion.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('alimentacion.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\Alimentacion  $alimentacion
     * @return \Illuminate\Http\Response
     */
    public function show(Alimentacion $alimentacion)
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
     * @param  \App\Models\clinica\catalogo\Alimentacion  $alimentacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Alimentacion $alimentacion)
    {
        try {
            return view('clinica.catalogo.alimentacion.edit', compact('alimentacion'));
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
     * @param  \App\Models\clinica\catalogo\Alimentacion  $alimentacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alimentacion $alimentacion)
    {
        $this->validate(
            $request,
            [
                'nombre' => 'required|max:20'.$alimentacion->id
            ]
        );

        try {
            $alimentacion->nombre = $request->nombre;

            if (!$alimentacion->isDirty())
                return redirect()->route('alimentacion.edit', $alimentacion->id)->with('warning', '¡No existe información nueva para actualizar!');

            $alimentacion->save();

            return redirect()->route('alimentacion.index')->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if($th instanceof QueryException) {
                return redirect()->route('alimentacion.edit', $alimentacion->id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('alimentacion.edit', $alimentacion->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\Alimentacion  $alimentacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alimentacion $alimentacion)
    {
        try {
            $alimentacion->delete();

            return redirect()->route('alimentacion.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
