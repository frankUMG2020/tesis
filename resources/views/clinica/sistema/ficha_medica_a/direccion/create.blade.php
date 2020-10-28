@extends('adminlte::page')
@section('content_header')
    <h2>Dirección</h2>
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
          <h3 class="card-title">Nueva dirección para el paciente {{ $direccionFMA->persona->nombreCompleto() }}</h3>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('direccionFMA.store') }}" role="form">
              {{ csrf_field() }}
              <input name="ficha_medica_a_id" value="{{ $direccionFMA->id }}" type="hidden" value="DELETE">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="municipio_id">Municipio</label>
                    <br>
                    <select name="municipio_id" id="input-municipio_id" class="js-example-basic-single form-control-alternative{{ $errors->has('municipio_id') ? ' is-invalid' : '' }}">
                        <option style="color: black;" value="">Seleccionar uno por favor</option>
                        @foreach ($municipios as $municipio)
                            <option style="color: black;"
                            value="{{ $municipio->id }}"
                            {{ ($municipio->id == old('municipio_id')) ? 'selected' : '' }}>{{ $municipio->nombreCompleto()}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                  <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control form-control-alternative{{ $errors->has('direccion') ? ' is-invalid' : '' }} input-sm" placeholder="Escribir la dirección del paciente" value="{{ old('direccion') }}">
                  </div>
                </div>
              </div>
              <div class="row justify-content-between">
                <a href="{{ route('historialFMA.show', $direccionFMA->id) }}" class="btn btn-danger" >Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form> 
        </div>
      </div>
    </div>
  </div>
@endsection