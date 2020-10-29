<?php

namespace App\Http\Controllers\clinica\catalogo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\clinica\catalogo\CategoriaExamen;

class CategoriaExamenController extends Controller
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
                $values = CategoriaExamen::search($request->buscar)->paginate(10);
            else
                $values = CategoriaExamen::paginate(10);

            return view('clinica.catalogo.categoria_examen.index', ['values' => $values]);
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
            return view('clinica.catalogo.categoria_examen.create');
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
            $insert = new CategoriaExamen();
            $insert->nombre = $request->nombre;
            $insert->save();

            return redirect()->route('categoriaExamen.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('categoriaExamen.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('categoriaExamen.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\CategoriaExamen  $categoriaExaman
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriaExamen $categoriaExaman)
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
     * @param  \App\Models\clinica\catalogo\CategoriaExamen  $categoriaExaman
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaExamen $categoriaExaman)
    {
        try {
            return view('clinica.catalogo.categoria_examen.edit', ['valor' => $categoriaExaman]);
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
     * @param  \App\Models\clinica\catalogo\CategoriaExamen  $categoriaExaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriaExamen $categoriaExaman)
    {
        $this->validate(
            $request,
            [
                'nombre' => 'required|max:20'.$categoriaExaman->id
            ]
        );
        try {
            $categoriaExaman->nombre = $request->nombre;

            if (!$categoriaExaman->isDirty())
                return redirect()->route('categoriaExamen.edit', $categoriaExaman->id)->with('warning', '¡No existe información nueva para actualizar!');

            $categoriaExaman->save();

            return redirect()->route('categoriaExamen.index')->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('categoriaExamen.edit', $categoriaExaman->id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('categoriaExamen.edit', $categoriaExaman->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\CategoriaExamen  $categoriaExamen
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriaExamen $categoriaExaman)
    {
        try {
            $categoriaExaman->delete();

            return redirect()->route('categoriaExamen.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
