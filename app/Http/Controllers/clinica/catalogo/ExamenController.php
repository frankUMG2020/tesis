<?php

namespace App\Http\Controllers\clinica\catalogo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\clinica\catalogo\CategoriaExamen;
use App\Models\clinica\catalogo\Examen;
use App\Models\clinica\catalogo\Laboratorio;
use Illuminate\Database\QueryException;

class ExamenController extends Controller
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
                $values = Examen::search($request->buscar)->paginate(10);
            else
                $values = Examen::paginate(10);

            return view('clinica.catalogo.examen.index', ['values' => $values]);
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
            $categorias = CategoriaExamen::all();
            $laboratorios = Laboratorio::all();

            return view('clinica.catalogo.examen.create', compact('categorias', 'laboratorios'));
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
                'laboratorio_id' => 'required|integer|exists:laboratorio,id',
                'categoria_examen_id' => 'required|integer|exists:categoria_examen,id',
            ]
        );

        try {
            $insert = new Examen();
            $insert->nombre = $request->nombre;
            $insert->laboratorio_id = $request->laboratorio_id;
            $insert->categoria_examen_id = $request->categoria_examen_id;
            $insert->save();

            return redirect()->route('examen.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('examen.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('examen.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\Examen  $examan
     * @return \Illuminate\Http\Response
     */
    public function show(Examen $examan)
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
     * @param  \App\Models\clinica\catalogo\Examen  $examan
     * @return \Illuminate\Http\Response
     */
    public function edit(Examen $examan)
    {
        try {
            $categorias = CategoriaExamen::all();
            $laboratorios = Laboratorio::all();

            return view('clinica.catalogo.examen.edit', ['valor' => $examan, 'categorias' => $categorias, 'laboratorios' => $laboratorios]);
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
     * @param  \App\Models\clinica\catalogo\Examen  $examan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Examen $examan)
    {
        $this->validate(
            $request,
            [
                'nombre' => 'required|max:20'.$examan->id,
                'laboratorio_id' => 'required|integer|exists:laboratorio,id'.$examan->id,
                'categoria_examen_id' => 'required|integer|exists:categoria_examen,id'.$examan->id,
            ]
        );
        
        try {
            $examan->nombre = $request->nombre;
            $examan->laboratorio_id = $request->laboratorio_id;
            $examan->categoria_examen_id = $request->categoria_examen_id;

            if (!$examan->isDirty())
                return redirect()->route('examen.edit', $examan->id)->with('warning', '¡No existe información nueva para actualizar!');

            $examan->save();

            return redirect()->route('examen.index')->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('examen.edit', $examan->id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('examen.edit', $examan->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\Examen  $examan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examen $examan)
    {
        try {
            $examan->delete();

            return redirect()->route('examen.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
