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
          <h3 class="card-title">Nuevo historial para el paciente: {{ $ficha_medica_a_id->persona->nombreCompleto() }}</h3>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('historialFMA.store') }}"  role="form">
              {{ csrf_field() }}
              <input name="ficha_medica_a_id" type="hidden" value="{{ $ficha_medica_a_id->id }}">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_uno">1. Antecedentes Familiares, Personales, Patologicos, No Patologicos, Vacunaciones, Gineconsetricos.</label>
                            <textarea class="form-control" name="parametro_uno" id="parametro_uno" cols="15" placeholder="escribir la información en esta area" rows="5">{{ old('parametro_uno') }}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_dos">2. Motivo de Consulta e Historia.</label>
                            <textarea class="form-control" name="parametro_dos" id="parametro_dos" cols="15" placeholder="escribir la información en esta area" rows="5">{{ old('parametro_dos') }}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_tres">3. Aparatos y Sistemas.</label>
                            <textarea class="form-control" name="parametro_tres" id="parametro_tres" cols="15" placeholder="escribir la información en esta area" rows="5">{{ old('parametro_tres') }}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_cuatro">4. Examenes y Medicación Previos.</label>
                            <textarea class="form-control" name="parametro_cuatro" id="parametro_cuatro" cols="15" placeholder="escribir la información en esta area" rows="5">{{ old('parametro_cuatro') }}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <center>
                                    <label>Examen Físico</label>
                                </center>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="parametro_cinco">5. Datos Generales.</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                                <div class="form-group">
                                    <label for="edad">Edad</label>
                                    <input type="text" name="edad" id="edad" class="form-control input-sm" disabled value="{{ old('edad', $ficha_medica_a_id->persona->edadPersona(), 0) }}" placeholder="escribir la información en esta area">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                                <div class="form-group">
                                    <label for="peso">Peso</label>
                                    <input type="text" name="peso" id="peso" class="form-control input-sm" value="{{ old('peso', 0) }}" placeholder="escribir la información en esta area" value="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                                <div class="form-group">
                                    <label for="talla">Talla</label>
                                    <input type="text" name="talla" id="talla" class="form-control input-sm" value="{{ old('talla', 0) }}" placeholder="escribir la información en esta area" value="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                                <div class="form-group">
                                    <label for="pulso">Pulso</label>
                                    <input type="text" name="pulso" id="pulso" class="form-control input-sm" value="{{ old('pulso', 0) }}" placeholder="escribir la información en esta area" value="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                                <div class="form-group">
                                    <label for="temperatura">Temperatura</label>
                                    <input type="text" name="temperatura" id="temperatura" class="form-control input-sm" value="{{ old('temperatura', 0) }}" placeholder="escribir la información en esta area" value="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                                <div class="form-group">
                                    <label for="p_a">PA</label>
                                    <input type="text" name="p_a" id="p_a" class="form-control input-sm" value="{{ old('p_a', 0) }}" placeholder="escribir la información en esta area" value="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                                <div class="form-group">
                                    <label for="respiracion">Respiración</label>
                                    <input type="text" name="respiracion" id="respiracion" class="form-control input-sm" value="{{ old('respiracion', 0) }}" placeholder="escribir la información en esta area" value="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                                <div class="form-group">
                                    <label for="so_dos">SO2</label>
                                    <input type="text" name="so_dos" id="so_dos" class="form-control input-sm" value="{{ old('so_dos', 0) }}" placeholder="escribir la información en esta area" value="0">
                                </div>
                            </div>                          
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_seis">6. Actitud, Piel.</label>
                            <textarea class="form-control" name="parametro_seis" id="parametro_seis" cols="15" placeholder="escribir la información en esta area" rows="5">{{ old('parametro_seis') }}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_siete">7. Craneo, Cara, Cuello, Garganta.</label>
                            <textarea class="form-control" name="parametro_siete" id="parametro_siete" cols="15" placeholder="escribir la información en esta area" rows="5">{{ old('parametro_siete') }}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_ocho">8. Torax, Region Cardiaca, Aparato Respiratorio.</label>
                            <textarea class="form-control" name="parametro_ocho" id="parametro_ocho" cols="15" placeholder="escribir la información en esta area" rows="5">{{ old('parametro_ocho') }}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_nueve">9. Abdomen.</label>
                            <textarea class="form-control" name="parametro_nueve" id="parametro_nueve" cols="15" placeholder="escribir la información en esta area" rows="5">{{ old('parametro_nueve') }}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_diez">10. Genito-Urinario.</label>
                            <textarea class="form-control" name="parametro_diez" id="parametro_diez" cols="15" placeholder="escribir la información en esta area" rows="5">{{ old('parametro_diez') }}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_once">11. Miembros.</label>
                            <textarea class="form-control" name="parametro_once" id="parametro_once" cols="15" placeholder="escribir la información en esta area" rows="5">{{ old('parametro_once') }}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_doce">12. Sistema Nervioso.</label>
                            <textarea class="form-control" name="parametro_doce" id="parametro_doce" cols="15" placeholder="escribir la información en esta area" rows="5">{{ old('parametro_doce') }}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="parametro_trece">13. Ginecologico y/o Rectal.</label>
                            <textarea class="form-control" name="parametro_trece" id="parametro_trece" cols="15" placeholder="escribir la información en esta area" rows="5">{{ old('parametro_trece') }}</textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-between">
                    <a href="{{ route('historialFMA.show', $ficha_medica_a_id->id) }}" class="btn btn-danger" >Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form> 
        </div>
      </div>
    </div>
  </div>
@endsection