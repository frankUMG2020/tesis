@extends('adminlte::page')
@section('content_header')
    <h2>
      Ficha médica para adultos
      <a href="{{ route('fichaMedicaA.create') }}" class="btn btn-info">Nuevo</a>       
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
    <div class="col-12">
      <div class="card">
        <div class="card-header py-4">
          <h3 class="card-title">Información registrada</h3>

          <div class="card-tools">
            <form action="{{ route('fichaMedicaA.index') }}" method="get" role="search">
              {{ csrf_field() }}
              <div class="input-group input-group-sm" style="width: 450px;">
                <input type="text" name="buscar" class="form-control float-right" placeholder="Buscar">
  
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        
        <div class="card-body table-responsive p-0">
          <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch">
              @if($values->count())  
                @foreach($values as $value)  
                  <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="card card-primary card-outline">
                      <div class="card-body box-profile">
                        <div class="text-center">
                          <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/user.png') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $value->persona->nombreCompleto() }}</h3>

                        <p class="text-muted text-center">{{ $value->persona->sexo }}</p>
                        <p class="text-muted text-center">{{ $value->persona->fechaFormato() }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item">
                            <b>Parto</b> <a class="float-right">{{ $value->fichaMedicaA->profesion }}</a>
                          </li>
                          <li class="list-group-item">
                            <b>Alimentación</b> <a class="float-right">{{ $value->tipoSangre->nombre }}</a>
                          </li>
                          <li class="list-group-item">
                            <b>Edad</b> <a class="float-right">{{ "{$value->persona->edadPersona()} años" }}</a>
                          </li>
                        </ul>

                        <h6 class="text-right">Fecha de ingreso: {{ $value->fechaFormato() }}</h6>
                      </div>
                      <div class="card-footer">
                        <div class="text-right">
                          <form action="{{ route('fichaMedicaA.destroy', $value) }}" method="post">
                            <a class="btn btn-sm btn-warning" href="{{ route('fichaMedicaA.edit', $value) }}" ><i class="fas fa-pencil-alt"></i> Editar</a>
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash-alt"></i> Eliminar</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach 
              @else
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="callout callout-danger"><h5>Mensaje</h5><p>¡No hay información para mostrar!</p></div>
                </div>
              @endif
            </div>
          </div>
        </div>
        <div class="card-footer py-4">
          <nav class="d-flex justify-content-end" aria-label="...">
              {{ $values->links() }}
          </nav>                        
        </div>
      </div>
      
    </div>
  </div>
@endsection