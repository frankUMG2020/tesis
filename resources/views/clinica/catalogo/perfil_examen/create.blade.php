@extends('adminlte::page')
@section('content_header')
    <h2>Perfiles de los Exámenes</h2>
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
            <form method="POST" action="{{ route('perfilExamen.store') }}"  role="form">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="perfil_id">Perfil</label>
                    <select name="perfil_id" id="input-perfil_id" class="js-example-basic-single form-control form-control-alternative{{ $errors->has('perfil_id') ? ' is-invalid' : '' }}">
                        <option style="color: black;" value="">Seleccionar uno por favor</option>
                        @foreach ($perfiles as $valor_select)
                            <option style="color: black;"
                            value="{{ $valor_select->id }}"
                            {{ ($valor_select->id == old('perfil_id')) ? 'selected' : '' }}>{{ $valor_select->nombre }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="examen_id">Examenes</label>
                    <select name="examen_id" id="input-examen_id" class="js-example-basic-single form-control form-control-alternative{{ $errors->has('examen_id') ? ' is-invalid' : '' }}">
                        <option style="color: black;" value="">Seleccionar uno por favor</option>
                        @foreach ($examenes as $valor_select)
                            <option style="color: black;"
                            value="{{ $valor_select->id }}"
                            {{ ($valor_select->id == old('examen_id')) ? 'selected' : '' }}>{{ $valor_select->nombre }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row justify-content-between">
                <a href="{{ route('perfilExamen.index') }}" class="btn btn-default" >Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form> 
        </div>
      </div>
    </div>
  </div>
@endsection