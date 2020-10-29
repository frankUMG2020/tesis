<?php

namespace App\Http\Controllers\clinica\catalogo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\clinica\catalogo\TipoSangre;

class TipoSangreController extends Controller
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
                $values = TipoSangre::search($request->buscar)->paginate(10);
            else
                $values = TipoSangre::paginate(10);

            return view('clinica.catalogo.tipo_sangre.index', ['values' => $values]);
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
            return view('clinica.catalogo.tipo_sangre.create');
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
                'nombre' => 'required|max:20'
            ]
        );

        try {
            $insert = new TipoSangre();
            $insert->nombre = $request->nombre;
            $insert->save();

            return redirect()->route('tipoSangre.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('tipoSangre.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('tipoSangre.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\TipoSangre  $tipoSangre
     * @return \Illuminate\Http\Response
     */
    public function show(TipoSangre $tipoSangre)
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
     * @param  \App\Models\clinica\catalogo\TipoSangre  $tipoSangre
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoSangre $tipoSangre)
    {
        try {
            return view('clinica.catalogo.tipo_sangre.edit', compact('tipoSangre'));
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
     * @param  \App\Models\clinica\catalogo\TipoSangre  $tipoSangre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoSangre $tipoSangre)
    {
        $this->validate(
            $request,
            [
                'nombre' => 'required|max:20'.$tipoSangre->id
            ]
        );

        try {
            $tipoSangre->nombre = $request->nombre;

            if (!$tipoSangre->isDirty())
                return redirect()->route('tipoSangre.edit', $tipoSangre->id)->with('warning', '¡No existe información nueva para actualizar!');

            $tipoSangre->save();

            return redirect()->route('tipoSangre.index')->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if($th instanceof QueryException) {
                return redirect()->route('tipoSangre.edit', $tipoSangre->id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('tipoSangre.edit', $tipoSangre->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\TipoSangre  $tipoSangre
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoSangre $tipoSangre)
    {
        try {
            $tipoSangre->delete();

            return redirect()->route('tipoSangre.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
