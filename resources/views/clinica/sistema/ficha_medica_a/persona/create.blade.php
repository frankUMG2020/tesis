@extends('adminlte::page')
@section('content_header')
    <h2>Ficha médica para adultos</h2>
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
    @elseif(Session::has('danger'))
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> ¡Error!</h5>
        {{Session::get('danger')}}
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
            <form method="POST" action="{{ route('fichaMedicaA.store') }}"  role="form">
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
                <div class="col-xs-12 col-sm-12 col-md-2">
                  <div class="form-group">
                    <label for="codigo_epps">Codigo EPSS</label>
                    <input type="text" name="codigo_epps" id="codigo_epps" class="form-control form-control-alternative{{ $errors->has('codigo_epps') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el codigo EPSS" value="{{ old('codigo_epps') }}">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <label for="cui">CUI: </label>
                      <input type="text" name="cui" id="cui" class="form-control form-control-alternative{{ $errors->has('cui') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el CUI de la persona" value="{{ old('cui') }}">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                  <div class="form-group">
                    <label for="tipo_sangre_id">Tipo de Sangre</label>
                    <br>
                    <select name="tipo_sangre_id" id="input-tipo_sangre_id" class="js-example-basic-single form-control-alternative{{ $errors->has('tipo_sangre_id') ? ' is-invalid' : '' }}">
                        <option style="color: black;" value="">Seleccionar uno por favor</option>
                        @foreach ($tipossangre as $tiposangre)
                            <option style="color: black;"
                            value="{{ $tiposangre->id }}"
                            {{ ($tiposangre->id == old('tipo_sangre_id')) ? 'selected' : '' }}>{{ $tiposangre->nombre}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="estado_civil">Estado Civil</label>
                  <br>
                  <select name="estado_civil" id="input-estado_civil" class="js-example-basic-single form-control-alternative{{ $errors->has('estado_civil') ? ' is-invalid' : '' }}">
                      <option style="color: black;" value="">Seleccionar uno por favor</option>
                      <option style="color: black;" value="Soltero">Soltero</option>
                      <option style="color: black;" value="Casado">Casado</option>
                      <option style="color: black;" value="Viudo">Viudo</option>
                      <option style="color: black;" value="Divorciado">Divorciado</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="profesion">Profesion</label>
                    <input type="text" name="profesion" id="profesion" class="form-control form-control-alternative{{ $errors->has('profesion') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir la profesion del paciente" value="{{ old('profesion') }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="remitido">Remitido por: </label>
                    <input type="text" name="remitido" id="remitido" class="form-control form-control-alternative{{ $errors->has('remitido') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el nombre de la persona que lo refirio" value="{{ old('remitido') }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="observacion">Observaciones: </label>
                    <input type="text" name="observacion" id="observacion" class="form-control form-control-alternative{{ $errors->has('observacion') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir las observaciones del paciente" value="{{ old('observacion') }}">
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
                <a href="{{ route('fichaMedicaA.index') }}" class="btn btn-default" >Cancelar</a>
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