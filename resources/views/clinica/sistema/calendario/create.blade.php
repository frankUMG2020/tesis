@extends('adminlte::page')
@section('content_header')
    <h2>Calendario</h2>
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
            <form method="POST" action="{{ route('calendarioFMA.store') }}" role="form">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="cita">Motivo de la cita</label>
                    <input type="text" name="cita" id="cita" class="form-control form-control-alternative{{ $errors->has('cita') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir el motivo de la cita" value="{{ old('cita') }}">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="ficha_medica_a_id">Paciente</label>
                    <br>
                    <select name="ficha_medica_a_id" id="input-ficha_medica_a_id" class="js-example-basic-single form-control-alternative{{ $errors->has('ficha_medica_a_id') ? ' is-invalid' : '' }}">
                        <option style="color: black;" value="">Seleccionar uno por favor</option>
                        @foreach ($pacientes as $paciente)
                            <option style="color: black;"
                            value="{{ $paciente->id }}"
                            {{ ($paciente->id == old('ficha_medica_a_id')) ? 'selected' : '' }}>{{ $paciente->persona->nombreCompleto()}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                  <div class="form-group">
                    <label for="tipo_cita_id">Tipo de cita</label>
                    <br>
                    <select name="tipo_cita_id" id="input-tipo_cita_id" class="js-example-basic-single form-control-alternative{{ $errors->has('tipo_cita_id') ? ' is-invalid' : '' }}">
                        <option style="color: black;" value="">Seleccionar uno por favor</option>
                        @foreach ($tipos as $tipo)
                            <option style="color: black;"
                            value="{{ $tipo->id }}"
                            {{ ($tipo->id == old('tipo_cita_id')) ? 'selected' : '' }}>{{ $tipo->nombre}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                  <div class="form-group">
                    <label for="fecha">Fecha para cita</label>
                    <input type="text" name="fecha" id="fecha" class="form-control form-control-alternative{{ $errors->has('fecha') ? ' is-invalid' : '' }} input-sm" placeholder="Fecha para cita" value="{{ old('fecha') }}">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                  <div class="form-group">
                    <label for="hora">Hora para cita</label>
                    <input type="text" name="hora" id="hora" class="form-control form-control-alternative{{ $errors->has('hora') ? ' is-invalid' : '' }} input-sm timepicker" placeholder="Hora para cita" value="{{ old('hora') }}">
                  </div>
                </div>
              </div>
              <div class="row justify-content-between">
                <a href="{{ route('calendarioFMA.index') }}" class="btn btn-danger" >Cancelar</a>
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
      

        $('.timepicker').timepicker({
            timeFormat: 'HH:mm:ss',
            interval: 30,
            maxHour: 20,
            maxTime: '23:59:00',
            startTime: '01:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
  </script> 
@endsection