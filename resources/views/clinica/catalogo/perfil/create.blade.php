@extends('adminlte::page')
@section('content_header')
    <h2>Perfil</h2>
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
            <form method="POST" action="{{ route('perfil.store') }}"  role="form">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-alternative{{ $errors->has('nombre') ? ' is-invalid' : '' }} input-sm" placeholder="Nombre" value="{{ old('nombre') }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="instruccion_perfil_id">Instruccion Perfil</label>
                    <select name="instruccion_perfil_id" id="input-instruccion_perfil_id" class="js-example-basic-single form-control form-control-alternative{{ $errors->has('instruccion_perfil_id') ? ' is-invalid' : '' }}">
                        <option style="color: black;" value="">Seleccionar uno por favor</option>
                        @foreach ($instruccionPerfil as $valor_select)
                            <option style="color: black;"
                            value="{{ $valor_select->id }}"
                            {{ ($valor_select->id == old('instruccion_perfil_id')) ? 'selected' : '' }}>{{ $valor_select->descripcion }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row justify-content-between">
                <a href="{{ route('perfil.index') }}" class="btn btn-default" >Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form> 
        </div>
      </div>
    </div>
  </div>
@endsection