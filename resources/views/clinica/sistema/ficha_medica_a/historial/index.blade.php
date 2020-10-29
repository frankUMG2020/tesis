@extends('adminlte::page')
@section('content_header')
    <h2>
      Historial clinico
      <a href="{{ route('historialFMA.create_historial', $historialFMA->id) }}" class="btn btn-info">Nuevo</a>       
    </h2>

    @if(Session::has('success'))
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
        <h5><i class="icon fas fa-exclamation-triangle"></i> ¡Advertencia!</h5>
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
  <div class="col-md-3">

  <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-circle" width="100" height="100" src="{{ is_null($historialFMA->foto) ? asset('img/user.png') : asset('storage/foto_fma/'.$historialFMA->foto) }}" alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{ $historialFMA->persona->nombreCompleto() }}</h3>

        <p class="text-muted text-center">Ingresó {{ $historialFMA->fechaFormato() }}</p>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Código EPPS</b> <a class="float-right">{{ $historialFMA->codigo_epps }}</a>
          </li>
          <li class="list-group-item">
            <b>CUI</b> <a class="float-right">{{ $historialFMA->cui }}</a>
          </li>
          <li class="list-group-item">
            <b>Sexo</b> <a class="float-right">{{ $historialFMA->persona->sexo }}</a>
          </li>
          <li class="list-group-item">
            <b>Fecha de nacimiento</b> <a class="float-right">{{ $historialFMA->persona->fechaFormato() }}</a>
          </li>
          <li class="list-group-item">
            <b>Edad</b> <a class="float-right">{{ "{$historialFMA->persona->edadPersona()} años" }}</a>
          </li>
          <li class="list-group-item">
            <b>Estado Civil</b> <a class="float-right">{{ $historialFMA->estado_civil }}</a>
          </li>
        </ul>

        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
      </div>
  </div>

  <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Información</h3>
      </div>

      <div class="card-body">

        <strong><i class="fas fa-ambulance mr-1"></i> Tipo de Sangre</strong>
        <p class="text-muted">{{ $historialFMA->tipo_sangre->nombre }}</p>
        <hr>

        <strong><i class="fas fa-book mr-1"></i> Teléfono</strong> <a class="btn btn-xs btn-success pull-right" href="{{ route('telefonoFMA.show', $historialFMA->id) }}"><i class="fas fa-plus"></i></a>
        @foreach ($historialFMA->telefonos as $item)
          <p class="text-muted">{{ $item->numero }}<a class="btn btn-xs" href="{{ route('telefonoFMA.edit', $item->id) }}" style="color: red"><i class="fas fa-trash ml-3"></i></a> </p> 
        @endforeach
        <hr>
        <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección </strong> <a class="btn btn-xs btn-success pull-right" href="{{ route('direccionFMA.show', $historialFMA->id) }}"><i class="fas fa-plus"></i></a>
        @foreach ($historialFMA->direcciones as $item)
          <p class="text-muted">{{ $item->municipio->nombreCompleto() . ", " . $item->direccion }}<a class="btn btn-xs" href="{{ route('direccionFMA.edit', $item->id) }}" style="color: red"><i class="fas fa-trash ml-3"></i></a> </p>  
        @endforeach

        <hr>

        <strong><i class="far fa-file-alt mr-1"></i> Notas</strong>
        <p class="text-muted"><strong>Profesión </strong>{{ $historialFMA->profesion }}</p>
        <p class="text-muted"><strong>Remitido </strong>{{ $historialFMA->remitido }}</p>

        <strong><i class="far fa-bell mr-1"></i> Observación</strong>
        <p class="text-muted">{{ $historialFMA->observacion }}</p>
      </div>
  </div>
</div>

<div class="col-md-9">
<div class="card">
    <div class="card-header p-2">
      <h3>Información de historiales clinicos</h3>
      <ul class="nav nav-pills">
        @foreach ($historiales as $key => $item)
          <li class="nav-item"><a class="{{ $key == 0 ? 'nav-link active' : 'nav-link' }}" href="{{ "#historial$item->id" }}" data-toggle="tab">{{ $item->codigo }}</a></li>
        @endforeach
      </ul>
    </div><!-- /.card-header -->
    <div class="card-body">
    <div class="tab-content">
      @foreach ($historiales as $key => $item)
        <div class="{{ $key == 0 ? 'active tab-pane' : 'tab-pane' }}" id="{{ "historial$item->id" }}">
          <h3 class="text-center">Código del historial {{ $item->codigo }}</h3>
          <h5 class="text-center">{{ date('d/m/Y h:i:s', strtotime($item->created_at)) }}</h5>
          <div class="text-center">
            <form action="{{ route('historialFMA.destroy', $item) }}" method="post">
              {{csrf_field()}}
              <input name="_method" type="hidden" value="DELETE">
              <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash-alt"></i> Eliminar el historial {{ $item->codigo }}</button>
            </form>
          </div>          
          <hr>
          <form method="POST" action="{{ route('historialFMA.update', $item) }}"  role="form">
              {{ csrf_field() }}
              <input name="_method" type="hidden" value="PATCH">
              <input name="parametros_fma_id" type="hidden" value="{{ $item->parametro->id }}">
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <label for="parametro_uno">1. Antecedentes Familiares, Personales, Patologicos, No Patologicos, Vacunaciones, Ginecobstetricos.</label>
                          <textarea class="form-control" name="parametro_uno" id="parametro_uno" cols="15" placeholder="escribir la información en esta area" rows="5">{{ $item->parametro->parametro_uno }}</textarea>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <label for="parametro_dos">2. Motivo de Consulta e Historia.</label>
                          <textarea class="form-control" name="parametro_dos" id="parametro_dos" cols="15" placeholder="escribir la información en esta area" rows="5">{{ $item->parametro->parametro_dos }}</textarea>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <label for="parametro_tres">3. Aparatos y Sistemas.</label>
                          <textarea class="form-control" name="parametro_tres" id="parametro_tres" cols="15" placeholder="escribir la información en esta area" rows="5">{{ $item->parametro->parametro_tres }}</textarea>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <label for="parametro_cuatro">4. Examenes y Medicación Previos.</label>
                          <textarea class="form-control" name="parametro_cuatro" id="parametro_cuatro" cols="15" placeholder="escribir la información en esta area" rows="5">{{ $item->parametro->parametro_cuatro }}</textarea>
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
                                  <input type="text" name="edad" id="edad" class="form-control input-sm" disabled value="{{ old('edad', $item->edad) }}" placeholder="escribir la información en esta area">
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                              <div class="form-group">
                                  <label for="peso">Peso</label>
                                  <input type="text" name="peso" id="peso" class="form-control input-sm" value="{{ old('peso', $item->peso) }}" placeholder="escribir la información en esta area" value="0">
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                              <div class="form-group">
                                  <label for="talla">Talla</label>
                                  <input type="text" name="talla" id="talla" class="form-control input-sm" value="{{ old('talla', $item->talla) }}" placeholder="escribir la información en esta area" value="0">
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                              <div class="form-group">
                                  <label for="pulso">Pulso</label>
                                  <input type="text" name="pulso" id="pulso" class="form-control input-sm" value="{{ old('pulso', $item->pulso) }}" placeholder="escribir la información en esta area" value="0">
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                              <div class="form-group">
                                  <label for="temperatura">Temperatura</label>
                                  <input type="text" name="temperatura" id="temperatura" class="form-control input-sm" value="{{ old('temperatura', $item->temperatura) }}" placeholder="escribir la información en esta area" value="0">
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                              <div class="form-group">
                                  <label for="p_a">PA</label>
                                  <input type="text" name="p_a" id="p_a" class="form-control input-sm" value="{{ old('p_a', $item->p_a) }}" placeholder="escribir la información en esta area" value="0">
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                              <div class="form-group">
                                  <label for="respiracion">Respiración</label>
                                  <input type="text" name="respiracion" id="respiracion" class="form-control input-sm" value="{{ old('respiracion', $item->respiracion) }}" placeholder="escribir la información en esta area" value="0">
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                              <div class="form-group">
                                  <label for="so_dos">SO2</label>
                                  <input type="text" name="so_dos" id="so_dos" class="form-control input-sm" value="{{ old('so_dos', $item->so_dos) }}" placeholder="escribir la información en esta area" value="0">
                              </div>
                          </div>                          
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <label for="parametro_seis">6. Actitud, Piel.</label>
                          <textarea class="form-control" name="parametro_seis" id="parametro_seis" cols="15" placeholder="escribir la información en esta area" rows="5">{{ $item->parametro->parametro_seis }}</textarea>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <label for="parametro_siete">7. Craneo, Cara, Cuello, Garganta.</label>
                          <textarea class="form-control" name="parametro_siete" id="parametro_siete" cols="15" placeholder="escribir la información en esta area" rows="5">{{ $item->parametro->parametro_uno }}</textarea>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <label for="parametro_ocho">8. Torax, Region Cardiaca, Aparato Respiratorio.</label>
                          <textarea class="form-control" name="parametro_ocho" id="parametro_ocho" cols="15" placeholder="escribir la información en esta area" rows="5">{{ $item->parametro->parametro_ocho }}</textarea>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <label for="parametro_nueve">9. Abdomen.</label>
                          <textarea class="form-control" name="parametro_nueve" id="" cols="15" placeholder="escribir la información en esta area" rows="5">{{ $item->parametro->parametro_nueve }}</textarea>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <label for="parametro_diez">10. Genito-Urinario.</label>
                          <textarea class="form-control" name="parametro_diez" id="parametro_diez" cols="15" placeholder="escribir la información en esta area" rows="5">{{ $item->parametro->parametro_diez }}</textarea>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <label for="parametro_once">11. Miembros.</label>
                          <textarea class="form-control" name="parametro_once" id="parametro_once" cols="15" placeholder="escribir la información en esta area" rows="5">{{ $item->parametro->parametro_once }}</textarea>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <label for="parametro_doce">12. Sistema Nervioso.</label>
                          <textarea class="form-control" name="parametro_doce" id="parametro_doce" cols="15" placeholder="escribir la información en esta area" rows="5">{{ $item->parametro->parametro_doce }}</textarea>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <label for="parametro_trece">13. Ginecologico y/o Rectal.</label>
                          <textarea class="form-control" name="parametro_trece" id="parametro_trece" cols="15" placeholder="escribir la información en esta area" rows="5">{{ $item->parametro->parametro_trece }}</textarea>
                      </div>
                  </div>
              </div>
              
              <div class="row justify-content-between">
                  <button type="submit" class="btn btn-block btn-warning">Actualizar</button>
              </div>
          </form>           
        </div>
      @endforeach
    </div>
    </div>
</div>
</div>
</div>
@endsection