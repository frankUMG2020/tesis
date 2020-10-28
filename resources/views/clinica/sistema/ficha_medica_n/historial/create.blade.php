@extends('adminlte::page')
@section('content_header')
    <h2>Agregar nuevo historial clinico</h2>
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
            <form method="POST" action="{{ route('historialFMN.store') }}"  role="form">
              {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <h2>Inmuciones</h2>
                            </div>
                            @foreach ($vacunas as $item)
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <div class="form-group">
                                        <input name="vacuna_id[]" type="hidden" value="{{ $item->id }}">
                                        <label for="cantidad_vacuna">{{ $item->nombre }}</label>
                                        <input type="number" name="cantidad_vacuna[]" id="cantidad_vacuna" class="form-control input-sm" placeholder="cantidad" value="0" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <h2>Enfermedades</h2>
                            </div>
                            @foreach ($enfermedades as $item)
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <div class="form-group">
                                        <input name="enfermedad_id[]" type="hidden" value="{{ $item->id }}">
                                        <label for="cantidad_enfermedad">{{ $item->nombre }}</label>
                                        <input type="number" name="cantidad_enfermedad[]" id="cantidad_enfermedad" class="form-control input-sm" placeholder="cantidad" value="0" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_uno">Titulo P1</label>
                            <textarea class="form-control" name="parametro_uno" id="parametro_uno" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_uno">Titulo Puno</label>
                            <textarea class="form-control" name="parametro_uno" id="parametro_uno" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_dos">Titulo Pdos</label>
                            <textarea class="form-control" name="parametro_dos" id="parametro_dos" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_tres">Titulo Ptres</label>
                            <textarea class="form-control" name="parametro_tres" id="parametro_tres" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_cuatro">Titulo Pcuatro</label>
                            <textarea class="form-control" name="parametro_cuatro" id="parametro_cuatro" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_seis">Titulo Pseis</label>
                            <textarea class="form-control" name="parametro_seis" id="parametro_seis" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="parametro_cinco">Titulo Pcinco</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 text-center">
                                <div class="form-group">
                                    <label for="edad">Edad</label>
                                    <input type="text" name="edad" id="edad" class="form-control input-sm" disabled placeholder="escribir la información en esta area" value="{{ $ficha_medica_n_id->persona->edadPersona() }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 text-center">
                                <div class="form-group">
                                    <label for="peso">Peso</label>
                                    <input type="text" name="peso" id="peso" class="form-control input-sm" placeholder="escribir la información en esta area" value="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="parametro_cinco" id="parametro_cinco" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_siete">Titulo Psiete</label>
                            <textarea class="form-control" name="parametro_siete" id="parametro_siete" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_ocho">Titulo Pocho</label>
                            <textarea class="form-control" name="parametro_ocho" id="parametro_ocho" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_nueve">Titulo Pnueve</label>
                            <textarea class="form-control" name="parametro_nueve" id="parametro_nueve" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_diez">Titulo Pdiez</label>
                            <textarea class="form-control" name="parametro_diez" id="parametro_diez" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_once">Titulo Ponce</label>
                            <textarea class="form-control" name="parametro_once" id="parametro_once" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_doce">Titulo Pdoce</label>
                            <textarea class="form-control" name="parametro_doce" id="parametro_doce" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_trece">Titulo Ptrece</label>
                            <textarea class="form-control" name="parametro_trece" id="parametro_trece" cols="15" placeholder="escribir la información en esta area" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-between">
                    <a href="{{ route('historialFMN.index') }}" class="btn btn-default" >Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form> 
        </div>
      </div>
    </div>
  </div>
@endsection