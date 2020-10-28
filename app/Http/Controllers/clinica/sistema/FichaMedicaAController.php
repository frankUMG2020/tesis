<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\Persona;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\clinica\catalogo\Municipio;
use App\Models\clinica\catalogo\TipoSangre;
use App\Models\clinica\sistema\TelefonoFMA;
use App\Models\clinica\sistema\DireccionFMA;
use App\Models\clinica\sistema\FichaMedicaA;

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
                $values = FichaMedicaA::buscar($request->buscar)->paginate(12);
            else
                $values = FichaMedicaA::paginate(12);

            return view('clinica.sistema.ficha_medica_a.persona.index', ['values' => $values]);
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', $th->getMessage());
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
            $municipios = Municipio::all();

            return view('clinica.sistema.ficha_medica_a.persona.create', compact('tipossangre', 'municipios'));
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('fichaMedicaA.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('fichaMedicaA.index')->with('danger', $th->getMessage());
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
                'sexo' => 'required|starts_with:'.Persona::Femenino.','.Persona::Masculino,
                'fecha_nacimiento' => 'required|date_format:d-m-Y',

                'fecha' => 'required|date_format:d-m-Y',
                'estado_civil' => 'required|starts_with:'.FichaMedicaA::Soltero.','.FichaMedicaA::Casado.','.FichaMedicaA::Viudo.','.FichaMedicaA::Divorciado,
                'profesion' => 'nullable|max:100',
                'remitido' => 'nullable|max:100',
                'observacion' => 'nullable|max:200',
                'codigo_epps' => 'nullable|max:20',
                'cui' => 'nullable|digits_between:13,13',
                'tipo_sangre_id' => 'required|integer|exists:tipo_sangre,id',
                'municipio_id' => 'required|integer|exists:municipio,id',
                'direccion' => 'required|max:200',

                'telefono_uno' => 'nullable|digits_between:8,8',
                'telefono_dos' => 'nullable|digits_between:8,8',
                'telefono_tres' => 'nullable|digits_between:8,8',

                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
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

            $foto = $request->file('foto');
            $nombre = null;
            if (!is_null($foto)) {
                $nombre = Storage::disk('foto_fma')->put('/', $foto);
            }

            $ficha = new FichaMedicaA();
            $ficha->fecha = date('Y-m-d', strtotime($request->fecha));
            $ficha->estado_civil = $request->estado_civil;
            $ficha->profesion = $request->profesion;
            $ficha->foto = $nombre;
            $ficha->remitido = $request->remitido;
            $ficha->observacion = $request->observacion;
            $ficha->codigo_epps = $request->codigo_epps;
            $ficha->cui = $request->cui;
            $ficha->tipo_sangre_id = $request->tipo_sangre_id;
            $ficha->persona_id = $persona->id;
            $ficha->save();

            $direccion = new DireccionFMA();
            $direccion->direccion = $request->direccion;
            $direccion->municipio_id = $request->municipio_id;
            $direccion->ficha_medica_a_id = $ficha->id;
            $direccion->save();

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
                $telefono->ficha_medica_a_id = $ficha->id;
                $telefono->save();
            }

            $image = $request->file('foto');
            $nueva = Storage::disk('foto_fma')->put('/', $image);
            $ficha->foto = $nueva;
            $ficha->save();

            DB::commit();

            return redirect()->route('fichaMedicaA.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('fichaMedicaA.index')->with('danger', $th->getMessage());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\sistema\FichaMedicaA  $fichaMedicaA
     * @return \Illuminate\Http\Response
     */
    public function edit(FichaMedicaA $fichaMedicaA)
    {
        try {
            $tipossangre = TipoSangre::all();

            return view('clinica.sistema.ficha_medica_a.persona.edit', compact('tipossangre', 'fichaMedicaA'));
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('fichaMedicaA.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('fichaMedicaA.index')->with('danger', $th->getMessage());
            }
        }
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
        $this->validate(
            $request,
            [
                'nombre_uno' => 'required|max:20',
                'nombre_dos' => 'max:30',
                'apellido_uno' => 'required|max:20',
                'apellido_dos' => 'max:30',
                'sexo' => 'required_with:' . Persona::Femenino . ',' . Persona::Masculino,
                'fecha_nacimiento' => 'required|date_format:d-m-Y',

                'fecha' => 'required|date_format:d-m-Y',
                'estado_civil' => 'required_with:' . FichaMedicaA::Soltero . ',' . FichaMedicaA::Casado . ',' . FichaMedicaA::Viudo . ',' . FichaMedicaA::Divorciado,
                'profesion' => 'nullable|max:100',
                'remitido' => 'nullable|max:100',
                'observacion' => 'nullable|max:200',
                'codigo_epps' => 'nullable|max:20',
                'cui' => 'required|max:100',
                'tipo_sangre_id' => 'required|integer|exists:tipo_sangre,id',
            ]
        );

        try {
            DB::beginTransaction();

            $foto = $request->file('foto');
            $nombre = null;
            if (!is_null($foto)) {

                $existe = Storage::disk('foto_fma')->exists($fichaMedicaA->foto);

                if($existe) {
                    Storage::disk('foto_fma')->delete($fichaMedicaA->foto);
                }

                $nombre = Storage::disk('foto_fma')->put('/', $foto);
                $fichaMedicaA->foto = $nombre;
            }

            $fichaMedicaA->fecha = date('Y-m-d', strtotime($request->fecha));
            $fichaMedicaA->estado_civil = $request->estado_civil;
            $fichaMedicaA->profesion = $request->profesion;
            $fichaMedicaA->remitido = $request->remitido;
            $fichaMedicaA->observacion = $request->observacion;
            $fichaMedicaA->codigo_epps = $request->codigo_epps;
            $fichaMedicaA->cui = $request->cui;
            $fichaMedicaA->tipo_sangre_id = $request->tipo_sangre_id;

            $persona = Persona::find($fichaMedicaA->persona_id);
            $persona->nombre_uno = $request->nombre_uno;
            $persona->nombre_dos = $request->nombre_dos;
            $persona->apellido_uno = $request->apellido_uno;
            $persona->apellido_dos = $request->apellido_dos;
            $persona->sexo = $request->sexo;
            $persona->fecha_nacimiento = date('Y-m-d', strtotime($request->fecha_nacimiento));


            if (!$fichaMedicaA->isDirty() && !$persona->isDirty())
                return redirect()->route('fichaMedicaA.edit', $fichaMedicaA->id)->with('warning', '¡No existe información nueva para actualizar!');

            $persona->save();
            $fichaMedicaA->save();

            DB::commit();

            return redirect()->route('fichaMedicaA.index')->with('success', '¡Registro modificado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('fichaMedicaA.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('fichaMedicaA.index')->with('danger', $th->getMessage());
            }
        }
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
            DB::beginTransaction();

                if($fichaMedicaA->historiales_fma->count() > 0) {
                    $fichaMedicaA->delete();
                } else {
                    TelefonoFMA::where('ficha_medica_a_id', $fichaMedicaA->id)->forceDelete();
                    DireccionFMA::where('ficha_medica_a_id', $fichaMedicaA->id)->forceDelete();
                    $fichaMedicaA->forceDelete();
                }

            DB::commit();

            return redirect()->route('fichaMedicaA.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('fichaMedicaA.index')->with('danger', 'No puede eliminar al paciente que tiene historial registrado');
            } else {
                return redirect()->route('fichaMedicaA.index')->with('danger', $th->getMessage());
            }
        }
    }
}
