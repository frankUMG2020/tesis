<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\clinica\sistema\InstruccionPerfil;

class InstruccionPerfilController extends Controller
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
                $values = InstruccionPerfil::search($request->buscar)->paginate(10);
            else
                $values = InstruccionPerfil::paginate(10);

            return view('clinica.catalogo.instruccion_perfil.index', ['values' => $values]);
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        } 
        $values = InstruccionPerfil::get();

        return response()->json(["Registro" => $values, "Mensaje" => "Felicidades accediste a datos"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('clinica.catalogo.instruccion_perfil.create');
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
                'descripcion' => 'required|max:100',
            ]
        );
        try {
            $insert = new InstruccionPerfil();
            $insert->descripcion = $request->descripcion;
            $insert->save();

            return redirect()->route('instruccionPerfil.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('instruccionPerfil.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('instruccionPerfil.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\InstruccionPerfil  $instruccionPerfil
     * @return \Illuminate\Http\Response
     */
    public function show(InstruccionPerfil $instruccionPerfil)
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
     * @param  \App\Models\clinica\sistema\InstruccionPerfil  $instruccionPerfil
     * @return \Illuminate\Http\Response
     */
    public function edit(InstruccionPerfil $instruccionPerfil)
    {
        try {
            return view('clinica.catalogo.instruccion_perfil.edit', compact('instruccionPerfil'));
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
     * @param  \App\Models\clinica\sistema\InstruccionPerfil  $instruccionPerfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstruccionPerfil $instruccionPerfil)
    {
        $this->validate(
            $request,
            [
                'descripcion' => 'required|max:100'.$instruccionPerfil->id
            ]
        );

        try {
            $instruccionPerfil->descripcion = $request->descripcion;

            if (!$instruccionPerfil->isDirty())
                return redirect()->route('instruccionPerfil.edit', $instruccionPerfil->id)->with('warning', '¡No existe información nueva para actualizar!');

            $instruccionPerfil->save();

            return redirect()->route('instruccionPerfil.index')->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if($th instanceof QueryException) {
                return redirect()->route('instruccionPerfil.edit', $instruccionPerfil->id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('instruccionPerfil.edit', $instruccionPerfil->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\InstruccionPerfil  $instruccionPerfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstruccionPerfil $instruccionPerfil)
    {
        try {
            $instruccionPerfil->delete();

            return redirect()->route('instruccionPerfil.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
