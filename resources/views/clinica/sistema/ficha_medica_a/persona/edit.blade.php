@extends('adminlte::page')
@section('content_header')
    <h2>Estado Calendario</h2>
    @if(Session::has('warning'))
      <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-exclamation-triangle"></i> ¡Advertencia!</h5>
          {{Session::get('warning')}}
      </div>
    @endif
    @if(Session::has('danger'))
      <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-exclamation-triangle"></i> ¡Advertencia!</h5>
          {{Session::get('danger')}}
      </div>
    @endif
    
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
          <form method="POST" action="{{ route('fichaMedicaN.store') }}"  role="form">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                  <label for="nombre_uno">Primer nombre del paciente</label>
                  <input type="text" name="nombre_uno" id="nombre_uno" class="form-control form-control-alternative{{ $errors->has('nombre_uno') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el primer nombre" value="{{ old('nombre_uno') }}">
                </div>
              </div>                
              <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                  <label for="nombre_dos">Segundo nombre del paciente</label>
                  <input type="text" name="nombre_dos" id="nombre_dos" class="form-control form-control-alternative{{ $errors->has('nombre_dos') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el segundo nombre" value="{{ old('nombre_dos') }}">
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                  <label for="apellido_uno">Primer apellido del paciente</label>
                  <input type="text" name="apellido_uno" id="apellido_uno" class="form-control form-control-alternative{{ $errors->has('apellido_uno') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el primer apellido" value="{{ old('apellido_uno') }}">
                </div>
              </div>                
              <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                  <label for="apellido_dos">Segundo apellido del paciente</label>
                  <input type="text" name="apellido_dos" id="apellido_dos" class="form-control form-control-alternative{{ $errors->has('apellido_dos') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el segundo apellido" value="{{ old('apellido_dos') }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="fecha_nacimiento">Fecha de Nacimiento del Paciente</label>
                  <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control form-control-alternative{{ $errors->has('fecha_nacimiento') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir la fecha de nacimiento del paciente" value="{{ old('fecha_nacimiento') }}">
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="sexo">Sexo</label>
                  <br>
                  <select name="sexo" id="input-sexo" class="js-example-basic-single form-control-alternative{{ $errors->has('sexo') ? ' is-invalid' : '' }}">
                      <option style="color: black;" value="">Seleccionar uno por favor</option>
                      <option style="color: black;" value="Masculino">Masculino</option>
                      <option style="color: black;" value="Femenino">Femenino</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-2">
                <div class="form-group">
                  <label for="fecha">Fecha de ingreso</label>
                  <input type="text" name="fecha" id="fecha" class="form-control form-control-alternative{{ $errors->has('fecha') ? ' is-invalid' : '' }} input-sm" placeholder="Fecha de ingreso del paciente" value="{{ old('fecha') }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="padre">Nombre del padre</label>
                  <input type="text" name="padre" id="padre" class="form-control form-control-alternative{{ $errors->has('padre') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el nombre del padre" value="{{ old('padre') }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="madre">Nombre de la madre</label>
                  <input type="text" name="madre" id="madre" class="form-control form-control-alternative{{ $errors->has('madre') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el nombre de la madre" value="{{ old('madre') }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="referido">Referido por:</label>
                  <input type="text" name="referido" id="referido" class="form-control form-control-alternative{{ $errors->has('referido') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el nombre de la persona que lo refirio" value="{{ old('referido') }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                  <label for="municipio_id">Departamentos y Municipios</label>
                  <br>
                  <select name="municipio_id" id="input-municipio_id" class="js-example-basic-single form-control-alternative{{ $errors->has('municipio_id') ? ' is-invalid' : '' }}">
                      <option style="color: black;" value="">Seleccionar uno por favor</option>
                      @foreach ($municipios as $municipio)
                          <option style="color: black;"
                          value="{{ $municipio->id }}"
                          {{ ($municipio->id == old('municipio_id')) ? 'selected' : '' }}>{{ $municipio->nombreCompleto() }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-9">
                <div class="form-group">
                  <label for="lugar_nacimiento">Lugar de nacimiento</label>
                  <input type="text" name="lugar_nacimiento" id="lugar_nacimiento" class="form-control form-control-alternative{{ $errors->has('lugar_nacimiento') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el lugar de nacimiento" value="{{ old('lugar_nacimiento') }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="email">Correo electrónico</label>
                  <input type="text" name="email" id="email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el correo electrónico de contacto" value="{{ old('email') }}">
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-2">
                <div class="form-group">
                  <label for="parto_id">Parto</label>
                  <br>
                  <select name="parto_id" id="input-parto_id" class="js-example-basic-single form-control-alternative{{ $errors->has('parto_id') ? ' is-invalid' : '' }}">
                      <option style="color: black;" value="">Seleccionar uno por favor</option>
                      @foreach ($partos as $parto)
                          <option style="color: black;"
                          value="{{ $parto->id }}"
                          {{ ($parto->id == old('parto_id')) ? 'selected' : '' }}>{{ $parto->nombre}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-2">
                <div class="form-group">
                  <label for="alimentacion_id">Alimentación</label>
                  <br>
                  <select name="alimentacion_id" id="input-alimentacion_id" class="js-example-basic-single form-control-alternative{{ $errors->has('alimentacion_id') ? ' is-invalid' : '' }}">
                      <option style="color: black;" value="">Seleccionar uno por favor</option>
                      @foreach ($alimentaciones as $alimentacion)
                          <option style="color: black;"
                          value="{{ $alimentacion->id }}"
                          {{ ($alimentacion->id == old('alimentacion_id')) ? 'selected' : '' }}>{{ $alimentacion->nombre}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-2">
                <div class="form-group">
                  <label for="telefono_uno">Teléfono 1</label>
                  <input type="text" name="telefono_uno" id="telefono_uno" class="form-control form-control-alternative{{ $errors->has('telefono_uno') ? ' is-invalid' : '' }} input-sm" placeholder="Número de teléfono" value="{{ old('telefono_uno') }}">
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-2">
                <div class="form-group">
                  <label for="telefono_dos">Teléfono 2</label>
                  <input type="text" name="telefono_dos" id="telefono_dos" class="form-control form-control-alternative{{ $errors->has('telefono_dos') ? ' is-invalid' : '' }} input-sm" placeholder="Número de teléfono" value="{{ old('telefono_dos') }}">
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-2">
                <div class="form-group">
                  <label for="telefono_tres">Teléfono 3</label>
                  <input type="text" name="telefono_tres" id="telefono_tres" class="form-control form-control-alternative{{ $errors->has('telefono_tres') ? ' is-invalid' : '' }} input-sm" placeholder="Número de teléfono" value="{{ old('telefono_tres') }}">
                </div>
              </div>
            </div>
            <div class="row justify-content-between">
              <a href="{{ route('fichaMedicaN.index') }}" class="btn btn-default" >Cancelar</a>
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