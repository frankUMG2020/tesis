@extends('adminlte::page')
@section('content_header')
    <h2>Teléfono</h2>
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
          <h3 class="card-title">Nuevo teléfono para el paciente {{ $telefonoFMA->persona->nombreCompleto() }}</h3>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('telefonoFMA.store') }}" role="form">
              {{ csrf_field() }}
              <input name="ficha_medica_a_id" value="{{ $telefonoFMA->id }}" type="hidden" value="DELETE">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="numero">Número</label>
                    <input type="text" name="numero" id="numero" class="form-control form-control-alternative{{ $errors->has('numero') ? ' is-invalid' : '' }} input-sm" placeholder="numero" value="{{ old('numero') }}">
                  </div>
                </div>
              </div>
              <div class="row justify-content-between">
                <a href="{{ route('historialFMA.show', $telefonoFMA->id) }}" class="btn btn-danger" >Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form> 
        </div>
      </div>
    </div>
  </div>
@endsection