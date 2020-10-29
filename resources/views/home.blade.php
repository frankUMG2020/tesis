@extends('adminlte::page')
@section('content_header')
    <h2>Dashboard</h2>
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
      <div class="card-body">
        <div id='calendar'></div>
      </div>
    </div>
  </div>
</div>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
          lang: 'es',
          events : [
              @foreach($data as $calendario)
              {
                  title : '{{ $calendario->cita }}',
                  start : '{{ $calendario->fecha }}',
                  @if($calendario->estado_calendario_id == 1)
                    url : '{{ route('calendarioFMA.edit', $calendario) }}', 
                  @endif
                  textColor: 'white',
                  backgroundColor: '{{ $calendario->tipo_cita->color }}',
                  borderColor: 'black'
              },
              @endforeach
          ],
            eventDidMount: function(info) {
    console.log(info.event.extendedProps);
    // {description: "Lecture", department: "BioChemistry"}
  }
        })
    });
</script>
@endsection

