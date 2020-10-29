<?php

namespace App\Http\Controllers\clinica\catalogo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\clinica\catalogo\Parto;
use Illuminate\Database\QueryException;

class PartoController extends Controller
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
                $values = Parto::search($request->buscar)->paginate(10);
            else
                $values = Parto::paginate(10);

            return view('clinica.catalogo.parto.index', ['values' => $values]);
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
            return view('clinica.catalogo.parto.create');
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
                'nombre' => 'required|max:15|unique:parto,nombre'
            ]
        );

        try {
            $insert = new Parto();
            $insert->nombre = $request->nombre;
            $insert->save();

            return redirect()->route('parto.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('parto.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('parto.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\Parto  $parto
     * @return \Illuminate\Http\Response
     */
    public function show(Parto $parto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\Parto  $parto
     * @return \Illuminate\Http\Response
     */
    public function edit(Parto $parto)
    {
        try {
            return view('clinica.catalogo.parto.edit', compact('parto'));
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
     * @param  \App\Models\clinica\catalogo\Parto  $parto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parto $parto)
    {
        $this->validate(
            $request,
            [
                'nombre' => 'required|max:15|unique:parto,nombre,id,'.$parto->id
            ]
        );

        try {
            $parto->nombre = $request->nombre;

            if (!$parto->isDirty())
                return redirect()->route('parto.edit', $parto->id)->with('warning', '¡No existe información nueva para actualizar!');

            $parto->save();

            return redirect()->route('parto.index')->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if($th instanceof QueryException) {
                return redirect()->route('parto.edit', $parto->id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('parto.edit', $parto->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\Parto  $parto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parto $parto)
    {
        try {
            $parto->delete();

            return redirect()->route('parto.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
