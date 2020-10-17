<?php

namespace App\Http\Controllers\clinica\catalogo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\clinica\catalogo\TipoCita;

class TipoCitaController extends Controller
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
                $values = TipoCita::search($request->buscar)->paginate(10);
            else
                $values = TipoCita::paginate(10);

            return view('clinica.catalogo.tipo_cita.index', ['values' => $values]);
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
            return view('clinica.catalogo.tipo_cita.create');
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
                'color' => 'required|max:30'
            ]
        );

        try {
            $insert = new TipoCita();
            $insert->nombre = $request->nombre;
            $insert->color = $request->color;
            $insert->save();

            return redirect()->route('tipoCita.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('tipoCita.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('tipoCita.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\catalogo\TipoCita  $tipoCita
     * @return \Illuminate\Http\Response
     */
    public function show(TipoCita $tipoCita)
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
     * @param  \App\Models\clinica\catalogo\TipoCita  $tipoCitum
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoCita $tipoCitum)
    {
        try {
            return view('clinica.catalogo.tipo_cita.edit', compact('tipoCitum'));
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
     * @param  \App\Models\clinica\catalogo\TipoCita  $tipoCitum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoCita $tipoCitum)
    {
        $this->validate(
            $request,
            [
                'nombre' => 'required|max:20'.$tipoCitum->id,
                'color' => 'required|max:30'.$tipoCitum->id
            ]
        );

        try {
            $tipoCitum->nombre = $request->nombre;
            $tipoCitum->color = $request->color;

            if (!$tipoCitum->isDirty())
                return redirect()->route('tipoCita.edit', $tipoCitum->id)->with('warning', '¡No existe información nueva para actualizar!');

            $tipoCitum->save();

            return redirect()->route('tipoCita.index')->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if($th instanceof QueryException) {
                return redirect()->route('tipoCita.edit', $tipoCitum->id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('tipoCita.edit', $tipoCitum->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\catalogo\TipoCita  $tipoCita
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoCita $tipoCitum)
    {
        try {
            $tipoCitum->delete();

            return redirect()->route('tipoCita.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
