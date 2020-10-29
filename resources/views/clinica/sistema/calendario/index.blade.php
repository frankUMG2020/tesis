@extends('adminlte::page')
@section('content_header')
    <h2>
      Calendario
      <a href="{{ route('calendarioFMA.create') }}" class="btn btn-info">Nuevo</a>       
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
        <div class="card-header py-4">
          <h3 class="card-title">Información registrada</h3>
        </div>
        
        <div class="card-body table-responsive p-0">
          <table class="table table-head-fixed">
            <thead>
              <tr>
                <th>#</th>
                <th>Paciente</th>
                <th>Cita</th>
                <th>Fecha para cita</th>
                <th>Hora para cita</th>
                <th>Tipo de Cita</th>
                <th>Estado</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              @if($values->count())  
                @foreach($values as $value)  
                <tr>
                  <td>{{$value->id}}</td>
                  <td>{{$value->ficha_medica_a->persona->nombreCompleto()}}</td>
                  <td>{{$value->cita}}</td>
                  <td>{{ date('d/m/Y', strtotime($value->fecha)) }}</td>
                  <td>{{$value->hora}}</td>
                  <td><span class="right badge" style="{{ "color: white; background: ".$value->tipo_cita->color.";" }}">{{$value->tipo_cita->nombre}}</span></td>
                  <td>{{$value->estado_calendario->nombre}}</td>
                  <td>
                      @if ($value->estado_calendario->id == 1)
                            <form action="{{ route('calendarioFMA.destroy', $value) }}" method="post">
                            <a class="btn btn-outline-warning" href="{{ route('calendarioFMA.edit', $value) }}" ><span class="fa fa-pencil-alt"></span></a>
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-outline-danger" type="submit"><span class="fa fa-trash-alt"></span></button>
                            </form>                          
                      @endif
                  </td>                  
               </tr>
               @endforeach 
               @else
               <tr>
                <td colspan="8">
                  <div class="callout callout-danger"><h5>Mensaje</h5><p>¡No hay información para mostrar!</p></div>
                </td>
              </tr>
              @endif
            </tbody>
          </table>
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