@extends('adminlte::page')
@section('content_header')
    <h2>Perfiles de los Exámenes</h2>
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
          <h3 class="card-title">Editar registro</h3>
        </div>
        
        <div class="card-body">           
            <form method="POST" action="{{ route('perfilExamen.update', $valor->id) }}"  role="form">
              {{ csrf_field() }}
              <input name="_method" type="hidden" value="PATCH">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="perfil_id">Perfiles </label>
                    <select name="perfil_id" id="input-perfil_id" class="js-example-basic-single form-control form-control-alternative{{ $errors->has('perfil_id') ? ' is-invalid' : '' }}">
                        <option style="color: black;" value="">Seleccionar uno por favor</option>
                        @foreach ($perfiles as $valor_select)
                            <option style="color: black;"
                            value="{{ $valor_select->id }}"
                            {{ ($valor_select->id == old('perfil_id', $valor->perfil_id)) ? 'selected' : '' }}>{{ $valor_select->nombre }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="examen_id">Exámenes</label>
                    <select name="examen_id" id="input-examen_id" class="js-example-basic-single form-control form-control-alternative{{ $errors->has('examen_id') ? ' is-invalid' : '' }}">
                        <option style="color: black;" value="">Seleccionar uno por favor</option>
                        @foreach ($examenes as $valor_select)
                            <option style="color: black;"
                            value="{{ $valor_select->id }}"
                            {{ ($valor_select->id == old('examen_id', $valor->examen_id)) ? 'selected' : '' }}>{{ $valor_select->nombre }}</option>
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