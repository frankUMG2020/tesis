<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\InstruccionPerfil;
use App\Models\clinica\sistema\Perfil;
use Illuminate\Database\QueryException;

class PerfilController extends Controller
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
                $values = Perfil::search($request->buscar)->paginate(10);
            else
                $values = Perfil::paginate(10);

            return view('clinica.catalogo.perfil.index', ['values' => $values]);
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
            $instruccionPerfil = InstruccionPerfil::all();

            return view('clinica.catalogo.perfil.create', compact('instruccionPerfil'));
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
                'instruccion_perfil_id' => 'required|integer|exists:instruccion_perfil,id',
            ]
        );

        try {
            $insert = new Perfil();
            $insert->nombre = $request->nombre;
            $insert->instruccion_perfil_id = $request->instruccion_perfil_id;
            $insert->save();

            return redirect()->route('perfil.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('perfil.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('perfil.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        try {
            $instruccionPerfil = InstruccionPerfil::all();

            return view('clinica.catalogo.perfil.edit', ['valor' => $perfil, 'instruccionPerfil' => $instruccionPerfil]);
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
     * @param  \App\Models\clinica\sistema\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        $this->validate(
            $request,
            [
                'nombre' => 'required|max:20'.$perfil->id,
                'instruccion_perfil_id' => 'required|integer|exists:instruccion_perfil,id'.$perfil->id,    
            ]
        );

        try {
            $perfil->nombre = $request->nombre;
            $perfil->instruccion_perfil_id = $request->instruccion_perfil_id;

            if (!$perfil->isDirty())
                return redirect()->route('perfil.edit', $perfil->id)->with('warning', '¡No existe información nueva para actualizar!');

            $perfil->save();

            return redirect()->route('perfil.index')->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('perfil.edit', $perfil->id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('perfil.edit', $perfil->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        try {
            $perfil->delete();

            return redirect()->route('perfil.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
