@extends('adminlte::page')
@section('content_header')
    <h2>Exámen</h2>
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
            <form method="POST" action="{{ route('examen.update', $valor->id) }}"  role="form">
              {{ csrf_field() }}
              <input name="_method" type="hidden" value="PATCH">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-alternative{{ $errors->has('nombre') ? ' is-invalid' : '' }} input-sm" placeholder="Nombre" value="{{ old('nombre', $valor->nombre) }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="categoria_examen_id">Categoría para el exámen</label>
                    <select name="categoria_examen_id" id="input-categoria_examen_id" class="js-example-basic-single form-control form-control-alternative{{ $errors->has('categoria_examen_id') ? ' is-invalid' : '' }}">
                        <option style="color: black;" value="">Seleccionar uno por favor</option>
                        @foreach ($categorias as $valor_select)
                            <option style="color: black;"
                            value="{{ $valor_select->id }}"
                            {{ ($valor_select->id == old('categoria_examen_id', $valor->categoria_examen_id)) ? 'selected' : '' }}>{{ $valor_select->nombre }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="laboratorio_id">Laboratorios</label>
                    <select name="laboratorio_id" id="input-laboratorio_id" class="js-example-basic-single form-control form-control-alternative{{ $errors->has('laboratorio_id') ? ' is-invalid' : '' }}">
                        <option style="color: black;" value="">Seleccionar uno por favor</option>
                        @foreach ($laboratorios as $valor_select)
                            <option style="color: black;"
                            value="{{ $valor_select->id }}"
                            {{ ($valor_select->id == old('laboratorio_id', $valor->laboratorio_id)) ? 'selected' : '' }}>{{ $valor_select->nombre }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row justify-content-between">
                <a href="{{ route('examen.index') }}" class="btn btn-default" >Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form> 
        </div>
      </div>
    </div>
  </div>
@endsection