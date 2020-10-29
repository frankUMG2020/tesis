<?php

namespace App\Http\Controllers\clinica\seguridad;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\clinica\seguridad\Rol;
use App\Models\clinica\sistema\Persona;
use Illuminate\Database\QueryException;
use App\Models\clinica\seguridad\Usuario;

class UsuarioController extends Controller
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
        $this->middleware('medico');
        $this->middleware('secretaria');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->has('buscar'))
                $values = Usuario::search($request->buscar)->orderBy('created_at', 'DESC')->paginate(15);
            else
                $values = Usuario::orderBy('created_at', 'DESC')->paginate(15);

            return view('clinica.seguridad.usuario.index ', ['values' => $values]);
        } catch (\Exception $th) {
            if ($th instanceof QueryException)
                return redirect()->route('home')->with('danger', 'Error en la base de datos');
            else
                return redirect()->route('home')->with('danger', $th->getMessage());
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
            $roles = Rol::all();

            return view('clinica.seguridad.usuario.create', compact('roles'));
        } catch (\Exception $th) {
            if ($th instanceof QueryException)
                return redirect()->route('usuario.index')->with('danger', 'Error en la base de datos');
            else
                return redirect()->route('usuario.index')->with('danger', $th->getMessage());
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
                'sexo' => 'required|starts_with:' . Persona::Femenino . ',' . Persona::Masculino,
                'fecha_nacimiento' => 'required|date_format:d-m-Y',
                
                'email' => 'required|max:50|email|unique:usuario,email',
                'rol_id' => 'required|integer|exists:rol,id',
                'password' => 'required|min:6|max:15'
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

            $usuario = new Usuario();
            $usuario->email = $request->email;
            $usuario->password = $request->password;
            $usuario->rol_id = $request->rol_id;
            $usuario->nombre_completo = "{$persona->nombre_uno} {$persona->nombre_dos} {$persona->apellido_uno} {$persona->apellido_dos}";
            $usuario->persona_id = $persona->id;
            $usuario->activo = true;
            $usuario->save();

            DB::commit();

            return redirect()->route('usuario.index')->with('success', '¡El registro fue creado exitosamente!');
        } catch (\Exception $th) {
            DB::rollback();
            if ($th instanceof QueryException)
                return redirect()->route('usuario.create')->with('danger', $th->getMessage());
            else
                return redirect()->route('usuario.create')->with('danger', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinica\seguridad\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        try {
            DB::beginTransaction();

            if ($usuario->activo) {
                $message = '¡El registro fue desactivado exitosamente!';
                $usuario->activo = false;
            } else {
                $message = '¡El registro fue activado exitosamente!';
                $usuario->activo = true;
            }

            $usuario->save();

            DB::commit();

            return redirect()->route('usuario.index')->with('success', $message);
        } catch (\Exception $th) {
            DB::rollback();
            if ($th instanceof QueryException)
                return redirect()->route('usuario.index')->with('danger', 'Error en la base de datos');
            else
                return redirect()->route('usuario.index')->with('danger', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinica\seguridad\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        try {
            $roles = Rol::all();
            $persona = Persona::find($usuario->persona_id);

            return view('clinica.seguridad.usuario.edit', ['usuario' => $usuario, 'persona' => $persona, 'roles' => $roles]);
        } catch (\Exception $th) {
            if ($th instanceof QueryException)
                return redirect()->route('usuario.index')->with('danger', 'Error en la base de datos');
            else
                return redirect()->route('usuario.index')->with('danger', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clinica\seguridad\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $this->validate(
            $request,
            [
                'nombre_uno' => 'required|max:20',
                'nombre_dos' => 'max:30',
                'apellido_uno' => 'required|max:20',
                'apellido_dos' => 'max:30',
                'sexo' => 'required|starts_with:' . Persona::Femenino . ',' . Persona::Masculino,
                'fecha_nacimiento' => 'required|date_format:d-m-Y',

                'email' => 'required|max:50|email|unique:usuario,email,' .  $usuario->id,
                'rol_id' => 'required|integer|exists:rol,id',
                'password' => 'min:6|max:15'
            ]
        );

        try {

            DB::beginTransaction();

            $persona = Persona::find($usuario->persona_id);
            $persona->nombre_uno = $request->nombre_uno;
            $persona->nombre_dos = $request->nombre_dos;
            $persona->apellido_uno = $request->apellido_uno;
            $persona->apellido_dos = $request->apellido_dos;
            $persona->sexo = $request->sexo;
            $persona->fecha_nacimiento = date('Y-m-d', strtotime($request->fecha_nacimiento));
            $persona->save();

            $usuario->email = $request->email;
            if (isset($request->password) && !is_null($request->password) && empty($request->password)) {
                $usuario->password = $request->password;
            }
            $usuario->rol_id = $request->rol_id;
            $usuario->nombre_completo = "{$persona->nombre_uno} {$persona->nombre_dos} {$persona->apellido_uno} {$persona->apellido_dos}";
            $usuario->save();

            DB::commit();

            return redirect()->route('usuario.index')->with('success', '¡El registro fue actualizado exitosamente!');
        } catch (\Exception $th) {
            DB::rollback();
            if ($th instanceof QueryException)
                return redirect()->route('usuario.create')->with('danger', 'Error en la base de datos');
            else
                return redirect()->route('usuario.create')->with('danger', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinica\seguridad\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        try {
            $usuario->delete();

            return redirect()->route('usuario.index')->with('info', '¡El registro fue eliminado exitosamente!');
        } catch (\Exception $th) {
            if ($th instanceof QueryException)
                return redirect()->route('usuario.index')->with('danger', 'Error en la base de datos');
            else
                return redirect()->route('usuario.index')->with('danger', $th->getMessage());
        }
    }
}
