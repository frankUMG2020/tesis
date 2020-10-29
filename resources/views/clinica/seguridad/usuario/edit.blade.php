@extends('adminlte::page')
@section('content_header')
    <h2>Usuario</h2>
    @if (count($errors) > 0)
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> ¡Error!</h5>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div> 
    @elseif(Session::has('success'))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
        {{Session::get('success')}}
      </div>
    @elseif(Session::has('warning'))
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> ¡Advertencia!</h5>
        {{Session::get('warning')}}
      </div>
    @elseif(Session::has('danger'))
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> ¡Error!</h5>
        {{Session::get('danger')}}
      </div>
    @elseif(Session::has('info'))
      <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> ¡Información!</h5>
        {{Session::get('info')}}
      </div>
    @endif         
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Nuevo registro</h3>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('usuario.update', $usuario) }}" action="/media" enctype="multipart/form-data" role="form">
              {{ csrf_field() }}
              <input name="_method" type="hidden" value="PATCH">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="nombre_uno">Primer nombre del usuario</label>
                    <input type="text" name="nombre_uno" id="nombre_uno" class="form-control form-control-alternative{{ $errors->has('nombre_uno') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el primer nombre" value="{{ old('nombre_uno', $persona->nombre_uno) }}">
                  </div>
                </div>                
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="nombre_dos">Segundo nombre del usuario</label>
                    <input type="text" name="nombre_dos" id="nombre_dos" class="form-control form-control-alternative{{ $errors->has('nombre_dos') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el segundo nombre" value="{{ old('nombre_dos', $persona->nombre_dos) }}">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="apellido_uno">Primer apellido del usuario</label>
                    <input type="text" name="apellido_uno" id="apellido_uno" class="form-control form-control-alternative{{ $errors->has('apellido_uno') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el primer apellido" value="{{ old('apellido_uno', $persona->apellido_uno) }}">
                  </div>
                </div>                
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="apellido_dos">Segundo apellido del usuario</label>
                    <input type="text" name="apellido_dos" id="apellido_dos" class="form-control form-control-alternative{{ $errors->has('apellido_dos') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el segundo apellido" value="{{ old('apellido_dos', $persona->apellido_dos) }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento del Usuario</label>
                    <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control form-control-alternative{{ $errors->has('fecha_nacimiento') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir la fecha de nacimiento del paciente" value="{{ old('fecha_nacimiento', $persona->fechaFormato()) }}">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                  <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <br>
                    <select name="sexo" id="input-sexo" class="js-example-basic-single form-control-alternative{{ $errors->has('sexo') ? ' is-invalid' : '' }}">
                        <option style="color: black;" value="">Seleccionar uno por favor</option>
                        <option style="color: black;" value="Masculino" {{ ("Masculino" == old('sexo', $persona->sexo)) ? 'selected' : '' }}>Masculino</option>
                        <option style="color: black;" value="Femenino" {{ ("Femenino" == old('sexo', $persona->sexo)) ? 'selected' : '' }}>Femenino</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4">
                  <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="text" name="email" id="email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir correo electrónico del usuario" value="{{ old('email', $usuario->email) }}">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                  <div class="form-group">
                    <label for="rol_id">Rol</label>
                    <br>
                    <select name="rol_id" id="input-rol_id" class="js-example-basic-single form-control-alternative{{ $errors->has('rol_id') ? ' is-invalid' : '' }}">
                        <option style="color: black;" value="">Seleccionar uno por favor</option>
                        @foreach ($roles as $rol)
                            <option style="color: black;"
                            value="{{ $rol->id }}"
                            {{ ($rol->id == old('rol_id', $usuario->rol_id)) ? 'selected' : '' }}>{{ $rol->nombre}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir la contraseña" value="{{ old('password') }}">
                  </div>
                </div>
              </div>
              <div class="row justify-content-between">
                <a href="{{ route('usuario.index') }}" class="btn btn-danger" >Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form> 
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
      $('#fecha').datepicker({  
        format: 'dd-mm-yyyy'
      });  
      $('#fecha_nacimiento').datepicker({  
        format: 'dd-mm-yyyy'
      });  
  </script> 
@endsection