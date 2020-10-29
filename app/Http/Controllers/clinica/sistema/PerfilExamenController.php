<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\Perfil;
use App\Models\clinica\catalogo\Examen;
use Illuminate\Database\QueryException;
use App\Models\clinica\sistema\PerfilExamen;

class PerfilExamenController extends Controller
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
                $values = PerfilExamen::search($request->buscar)->paginate(10);
            else
                $values = PerfilExamen::paginate(10);

            return view('clinica.catalogo.perfil_examen.index', ['values' => $values]);
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        } 
        $values = PerfilExamen::get();

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
            $perfiles = Perfil::all();
            $examenes = Examen::all();

            return view('clinica.catalogo.perfil_examen.create', compact('perfiles', 'examenes'));
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
                'perfil_id' => 'required|integer|exists:perfil,id',
                'examen_id' => 'required|integer|exists:examen,id',
            ]
        );

        try {
            $insert = new PerfilExamen();
            $insert->perfil_id = $request->perfil_id;
            $insert->examen_id = $request->examen_id;            
            $insert->save();

            return redirect()->route('perfilExamen.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('perfilExamen.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('perfilExamen.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\PerfilExamen  $perfilExaman
     * @return \Illuminate\Http\Response
     */
    public function show(PerfilExamen $perfilExaman)
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
     * @param  \App\Models\clinica\sistema\PerfilExamen  $perfilExaman
     * @return \Illuminate\Http\Response
     */
    public function edit(PerfilExamen $perfilExaman)
    {
        try {
            $perfiles = Perfil::all();
            $examenes = Examen::all();

            return view('clinica.catalogo.perfil_examen.edit', ['valor' => $perfilExaman, 'perfiles' => $perfiles, 'examenes' => $examenes]);
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
     * @param  \App\Models\clinica\sistema\PerfilExamen  $perfilExaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PerfilExamen $perfilExaman)
    {
        $this->validate(
            $request,
            [
                'perfil_id' => 'required|integer|exists:perfil,id'.$perfilExaman->id,
                'examen_id' => 'required|integer|exists:examen,id'.$perfilExaman->id,
            ]
        );
        
        try {
            $perfilExaman->perfil_id = $request->perfil_id;
            $perfilExaman->examen_id = $request->examen_id;

            if (!$perfilExaman->isDirty())
                return redirect()->route('perfilExamen.edit', $perfilExaman->id)->with('warning', '¡No existe información nueva para actualizar!');
            
            $perfilExaman->save();

            return redirect()->route('perfilExamen.index')->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('perfilExamen.edit', $perfilExaman->id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('perfilExamen.edit', $perfilExaman->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\PerfilExamen  $perfilExaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerfilExamen $perfilExaman)
    {
        try {
            $perfilExaman->delete();

            return redirect()->route('perfilExamen.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
