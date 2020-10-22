<?php

namespace App\Http\Controllers\clinica\sistema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\clinica\catalogo\Parto;
use App\Models\clinica\sistema\Persona;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\clinica\catalogo\Municipio;
use App\Models\clinica\sistema\TelefonoFMN;
use App\Models\clinica\sistema\FichaMedicaN;
use App\Models\clinica\catalogo\Alimentacion;

class FichaMedicaNController extends Controller
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
                $values = FichaMedicaN::search($request->buscar)->paginate(12);
            else
                $values = FichaMedicaN::paginate(12);

            return view('clinica.sistema.ficha_medica_n.persona.index', ['values' => $values]);
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
            $municipios = Municipio::all();
            $partos = Parto::all();
            $alimentaciones = Alimentacion::all();

            return view('clinica.sistema.ficha_medica_n.persona.create', compact('municipios', 'partos', 'alimentaciones'));
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
                'padre' => 'max:100',
                'madre' => 'max:100',
                'referido' => 'max:100',
                'email' => 'nullable|max:50|email',
                'lugar_nacimiento' => 'max:100',
                'municipio_id' => 'required|integer|exists:municipio,id',
                'parto_id' => 'required|integer|exists:parto,id',
                'alimentacion_id' => 'required|integer|exists:alimentacion,id',

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

            $ficha = new FichaMedicaN();
            $ficha->fecha = date('Y-m-d', strtotime($request->fecha));
            $ficha->padre = $request->padre;
            $ficha->madre = $request->madre;
            $ficha->referido = $request->referido;
            $ficha->email = $request->email;
            $ficha->lugar_nacimiento = $request->lugar_nacimiento;
            $ficha->foto = null;
            $ficha->municipio_id = $request->municipio_id;
            $ficha->persona_id = $persona->id;
            $ficha->parto_id = $request->parto_id;
            $ficha->alimentacion_id = $request->alimentacion_id;
            $ficha->save();
            
            if(!is_null($request->telefono_uno)) {
                $telefono = new TelefonoFMN();
                $telefono->numero = $request->telefono_uno;
                $telefono->ficha_medica_n_id = $ficha->id;
                $telefono->save();
            }

            if (!is_null($request->telefono_dos)) {
                $telefono = new TelefonoFMN();
                $telefono->numero = $request->telefono_dos;
                $telefono->ficha_medica_n_id = $ficha->id;
                $telefono->save();
            }

            if (!is_null($request->telefono_tres)) {
                $telefono = new TelefonoFMN();
                $telefono->numero = $request->telefono_tres;
                $telefono->ficha_medica_n_id = $ficha->id;
                $telefono->save();
            }

            /*$image = $request->file('foto');
            $nueva = Storage::disk('foto_fmn')->put('/', $image);
            $insert->foto = $nueva;
            $insert->save();*/

            DB::commit();

            return redirect()->route('fichaMedicaN.index')->with('success', '¡Registro creado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('fichaMedicaN.index')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('fichaMedicaN.index')->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\sistema\FichaMedicaN  $fichaMedicaN
     * @return \Illuminate\Http\Response
     */
    public function show(FichaMedicaN $fichaMedicaN)
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
     * @param  \App\Models\clinica\sistema\FichaMedicaN  $fichaMedicaN
     * @return \Illuminate\Http\Response
     */
    public function edit(FichaMedicaN $fichaMedicaN)
    {
        try {
            return view('clinica.sistema.fichaMedicaN.edit', compact('fichaMedicaN'));
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
     * @param  \App\Models\clinica\sistema\FichaMedicaN  $fichaMedicaN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FichaMedicaN $fichaMedicaN)
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
                'padre' => 'max:100',
                'madre' => 'max:100',
                'referido' => 'max:100',
                'email' => 'nullable|max:50|email',
                'lugar_nacimiento' => 'max:100',
                'municipio_id' => 'required|integer|exists:municipio,id',
                'parto_id' => 'required|integer|exists:parto,id',
                'alimentacion_id' => 'required|integer|exists:alimentacion,id',

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
            

            $fichaMedicaN->fecha = date('Y-m-d', strtotime($request->fecha));
            $fichaMedicaN->padre = $request->padre;
            $fichaMedicaN->madre = $request->madre;
            $fichaMedicaN->referido = $request->referido;
            $fichaMedicaN->email = $request->email;
            $fichaMedicaN->lugar_nacimiento = $request->lugar_nacimiento;
            $fichaMedicaN->foto = null;
            $fichaMedicaN->municipio_id = $request->municipio_id;
            $fichaMedicaN->persona_id = $persona->id;
            $fichaMedicaN->parto_id = $request->parto_id;
            $fichaMedicaN->alimentacion_id = $request->alimentacion_id;


            if(!is_null($request->telefono_uno)) {
                $telefonouno = new TelefonoFMN();
                $telefonouno->numero = $request->telefono_uno;
                $telefonouno->ficha_medica_n_id = $fichaMedicaN->id;
                
            }

            if (!is_null($request->telefono_dos)) {
                $telefonodos = new TelefonoFMN();
                $telefonodos->numero = $request->telefono_dos;
                $telefonodos->fichaMedicaN_medica_n_id = $fichaMedicaN->id;
                
            }

            if (!is_null($request->telefono_tres)) {
                $telefonotres = new TelefonoFMN();
                $telefonotres->numero = $request->telefono_tres;
                $telefonotres->fichaMedicaN_medica_n_id = $fichaMedicaN->id;
                
            }

            /*$image = $request->file('foto');
            $nueva = Storage::disk('foto_fmn')->put('/', $image);
            $insert->foto = $nueva;
            $insert->save();*/

            DB::commit();
            if (!$fichaMedicaN->isDirty())
                return redirect()->route('fichaMedicaN.edit', $fichaMedicaN->id)->with('warning', '¡No existe información nueva para actualizar!');

            $persona->save();
            $fichaMedicaN->save();
            $telefonouno->save();
            $telefonodos->save();
            $telefonotres->save();

            return redirect()->route('fichaMedicaN.index')->with('success', '¡Registro actualizado satisfactoriamente!');
        } catch (\Exception $th) {
            if($th instanceof QueryException) {
                return redirect()->route('fichaMedicaN.edit', $fichaMedicaN->id)->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('fichaMedicaN.edit', $fichaMedicaN->id)->with('danger', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\sistema\FichaMedicaN  $fichaMedicaN
     * @return \Illuminate\Http\Response
     */
    public function destroy(FichaMedicaN $fichaMedicaN)
    {
        try {
            $fichaMedicaN->delete();

            return redirect()->route('fichaMedicaN.index')->with('info', '¡Registro eliminado satisfactoriamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException) {
                return redirect()->route('home')->with('danger', 'Error de base de datos');
            } else {
                return redirect()->route('home')->with('danger', $th->getMessage());
            }
        }
    }
}
