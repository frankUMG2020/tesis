<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\Persona;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\clinica\catalogo\TipoSangre;
use App\Models\clinica\sistema\FichaMedicaA;
use App\Models\clinica\sistema\TelefonoFMA;

class FichaMedicaAController extends Controller
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
                $values = FichaMedicaA::search($request->buscar)->paginate(12);
            else
                $values = FichaMedicaA::paginate(12);

            return view('clinica.sistema.ficha_medica_a.persona.index', ['values' => $values]);
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
            $tipossangre = TipoSangre::all();

            return view('clinica.sistema.ficha_medica_a.persona.create', compact('tipossangre'));
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
                'nombre_uno' => 'required|max:20',
                'nombre_dos' => 'max:30',
                'apellido_uno' => 'required|max:20',
                'apellido_dos' => 'max:30',
                'sexo' => 'required_with:'.Persona::Femenino.','.Persona::Masculino,
                'fecha_nacimiento' => 'required|date_format:d-m-Y',

                'fecha' => 'required|date_format:d-m-Y',
                'estado_civil' => 'required_with:'.FichaMedicaA::Soltero.','.FichaMedicaA::Casado.','.FichaMedicaA::Viudo.','.FichaMedicaA::Divorciado,
                'profesion' => 'nullable|max:100',
                'remitido' => 'nullable|max:100',
                'observacion' => 'nullable|max:200|',
                'codigo_epps' => 'nullable|max:20|',
                'cui' => 'required|max:100',
                'tipo_sangre_id' => 'required|integer|exists:tipo_sangre,id',
                'persona_id' => 'required|integer|exists:persona,id',

                'telefono_uno' => 'nullable|digits_between:8,8',
                'telefono_dos' => 'nullable|digits_between:8,8',
                'telefono_tres' => 'nullable|digits_between:8,8',
            ]
        );

        try {
            DB::beginTransaction();

            $persona = new Persona();
            $persona->nombre_uno = $request->nombre_uno;
            $persona->nombre_dos = $request->nombre_dos;
            $persona->apellido_uno = $request->apellido_uno;
            $persona->apellido_dos = $request->apellido_dos;
            $persona->sexo = $request->sexo;
            $persona->fecha_nacimiento = date('Y-m-d', strtotime($request->fecha_nacimiento));
            $persona->save();

            $ficha = new FichaMedicaA();
            $ficha->fecha = date('Y-m-d', strtotime($request->fecha));
            $ficha->estado_civil = $request->estado_civil;
            $ficha->profesion = $request->profesion;
            $ficha->foto = null;
            $ficha->remitido = $request->remitido;
            $ficha->observacion = $request->observacion;
            $ficha->codigo_epps = $request->codigo_epps;
            $ficha->cui = $request->cui;
            $ficha->tipo_sangre_id = $request->tipo_sangre_id;
            $ficha->persona_id = $persona->id;
            $ficha->save();

            if(!is_null($request->telefono_uno)) {
                $telefono = new TelefonoFMA();
                $telefono->numero = $request->telefono_uno;
                $telefono->ficha_medica_a_id = $ficha->id;
                $telefono->save();
            }

            if (!is_null($request->telefono_dos)) {
                $telefono = new TelefonoFMA();
                $telefono->numero = $request->telefono_dos;
                $telefono->ficha_medica_a_id = $ficha->id;
                $telefono->save();
            }

            if (!is_null($request->telefono_tres)) {
                $telefono = new TelefonoFMA();
                $telefono->numero = $request->telefono_tres;
                $telefono->ficha_medica_n_id = $ficha->id;
                $telefono->save();
            }

            /*
            $image = $request->file('foto');
            $nueva = Storage::disk('foto_fma')->put('/', $image);
            $ficha->foto = $nueva;
            $ficha->save();
            */

            DB::commit();

            return redirect()->route('fichaMedicaA.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('fichaMedicaA.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('fichaMedicaA.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\FichaMedicaA  $fichaMedicaA
     * @return \Illuminate\Http\Response
     */
    public function show(FichaMedicaA $fichaMedicaA)
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
     * @param  \App\Models\clinica\sistema\FichaMedicaA  $fichaMedicaA
     * @return \Illuminate\Http\Response
     */
    public function edit(FichaMedicaA $fichaMedicaA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\sistema\FichaMedicaA  $fichaMedicaA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FichaMedicaA $fichaMedicaA)
    {
        $fichaMedicaA->fecha = date('Y-m-d', strtotime($request->fecha));
        $fichaMedicaA->estado_civil = $request->estado_civil;
        $fichaMedicaA->profesion = $request->profesion;
        $fichaMedicaA->foto = null;
        $fichaMedicaA->remitido = $request->remitido;
        $fichaMedicaA->observacion = $request->observacion;
        $fichaMedicaA->codigo_epps = $request->codigo_epps;
        $fichaMedicaA->cui = $request->cui;
        $fichaMedicaA->tipo_sangre_id = $request->tipo_sangre_id;
        $fichaMedicaA->persona_id = $request->persona_id;
        $fichaMedicaA->save();

        $image = $request->file('foto');
        $nueva = Storage::disk('foto_fmn')->put('/', $image);
        $fichaMedicaA->foto = $nueva;
        $fichaMedicaA->save();

        return response()->json(["Registro" => $fichaMedicaA, "Mensaje" => "Felicidades actualizaste"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\FichaMedicaA  $fichaMedicaA
     * @return \Illuminate\Http\Response
     */
    public function destroy(FichaMedicaA $fichaMedicaA)
    {
        try {
            $fichaMedicaA->delete();

            return redirect()->route('ficha$fichaMedicaA.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
