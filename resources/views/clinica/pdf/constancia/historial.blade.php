<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ficha clínica</title>
    <style>
        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 10px;
            font-style: normal;
        }
        img {
			height:42px;
        }
        .page-break {
            page-break-after: always;
        }
        .table { 
            border-style: solid; 
            border-top-width: 3px; 
            border-right-width: 3px; 
            border-bottom-width: 3px; 
            border-left-width: 3px;
            border-color: black;
            border-spacing: 0;
            border-collapse: collapse;
        } 
        .table_dos { 
            border-spacing: 0;
            border-collapse: collapse;
        } 
        td {
            padding-left: 20px;
            padding-right: 20px;
            vertical-align: middle;
        }
        textarea {
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            background-color: #d7d7db; 
            color: black;
        }
        li {
            font-size: 8px;
        }
        .des {
            font-size: 9px;
        }
    </style>
</head>
<body style="text-transform: uppercase;">
    <header>
        <table class="table" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" colspan="3">
                    <h1><strong>ficha clínica</strong></h1>
                </td>                
            </tr>
            <tr>
                <td align="left" colspan="3">
                    <p style="text-decoration: underline;">Fecha de impresión: {{ date('d/m/Y h:i:s a') }}</p> 
                </td>                 
            </tr>
            <tr>
                <td align="left" width="20%">
                    <small>código epps</small>
                    <p style="text-decoration: underline;">{{ $ficha->codigo_epps }}</p> 
                </td> 
                <td align="left" rowspan="3" width="60%">
                    <small>paciente</small>
                    <p style="text-decoration: underline; text-align: center;"><strong>{{ $ficha->persona->nombreCompleto() }}</strong></p> 
                </td>    
                <td align="left" width="20%">
                    <small>estado civil</small>
                    <p style="text-decoration: underline;">{{ $ficha->estado_civil }}</p> 
                </td>             
            </tr>
            <tr>
                <td align="left" width="20%">
                    <small>cui</small>
                    <p style="text-decoration: underline;">{{ $ficha->cui }}</p> 
                </td>   
                <td align="left" width="20%">
                    <small>tipo de sangre</small>
                    <p style="text-decoration: underline;">{{ $ficha->tipo_sangre->nombre }}</p> 
                </td>             
            </tr>
            <tr>
                <td align="left" width="20%">
                    <p><small>fecha de nacimiento</small></p>
                    <p style="text-decoration: underline;">{{ $ficha->persona->fechaFormato() }}</p> 
                </td>    
                <td align="left" width="20%">
                    <small>edad</small>
                    <p style="text-decoration: underline;">{{ $ficha->persona->edadPersona() }}</p> 
                </td>           
            </tr>
            @if ($ficha->direcciones->count() > 0 || $ficha->telefonos->count() > 0)
                <tr>
                    <td align="left" colspan="2">
                        <small>direcciones</small>
                        @foreach ($ficha->direcciones as $historial)
                            <p style="text-decoration: underline;">{{ $historial->municipio->nombreCompleto().', '.$historial->direccion }}</p> 
                        @endforeach
                    </td>   
                    <td align="left">
                        <small>teléfonos</small>
                        @foreach ($ficha->telefonos as $historial)
                            <p style="text-decoration: underline;">{{ $historial->numero }}</p> 
                        @endforeach
                    </td>         
                </tr>
            @endif
            <tr>
                <td align="left" colspan="3">
                    <small>observaciones</small>
                    <textarea>{!! $ficha->observacion !!}</textarea>
                </td>              
            </tr>
            <tr>
                <td align="rigth" colspan="3">
                    <br>
                    <p><font size="7px"><strong>remitido por: {{ $ficha->remitido }}</strong></font></p>
                </td>              
            </tr>
        </table>
    </header>
    @foreach ($historiales as $historial)
        <table width="100%" border="1" cellspacing="1" cellpadding="1">
            <tr align="center">
                <td colspan="2"><strong>anamnesis - código {{ $historial->codigo }}</strong></td>
            </tr>             
            <tr>
                <td>
                    <small>1) Ancedentes Familiares, Personales, Patológicos, No. Patológicos, Vacunaciones, Ginecolostétricos, etc...</small>
                </td>
                <td  class="des" align="left" width="80%">
                    {!! $historial->parametro->parametro_uno !!}
                </td>
            </tr>
            <tr>
                <td>
                    <small>2) motivo de consulta e historia</small>
                </td>
                <td  class="des" align="left" width="80%">
                    {!! $historial->parametro->parametro_dos !!}
                </td>
            </tr>
            <tr>
                <td>
                    <small>3) Aparatos y sistemas</small>
                </td>
                <td  class="des" align="left" width="80%">
                    {!! $historial->parametro->parametro_tres !!}
                </td>
            </tr>
            <tr>
                <td>
                    <small>4) Exámenes y medicación previos</small>
                </td>
                <td  class="des" align="left" width="80%">
                    {!! $historial->parametro->parametro_cuatro !!}
                </td>
            </tr>
            <tr>
                <td>
                    <small>5) datos generales</small>
                </td>
                <td  class="des" align="center" width="80%">
                    <h1><strong>examen fisico</strong></h1>
                    <table class="table_dos" width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="des" align="center"><p style="text-decoration: underline;">{{ $historial->edad }}</p></td>
                            <td class="des" align="center"><p style="text-decoration: underline;">{{ $historial->peso }}</p></td>
                            <td class="des" align="center"><p style="text-decoration: underline;">{{ $historial->talla }}</p></td>
                            <td class="des" align="center"><p style="text-decoration: underline;">{{ $historial->pulso }}</p></td>
                            <td class="des" align="center"><p style="text-decoration: underline;">{{ $historial->temperatura }}</p></td>
                            <td class="des" align="center"><p style="text-decoration: underline;">{{ $historial->p_a }}</p></td>
                            <td class="des" align="center"><p style="text-decoration: underline;">{{ $historial->respiracion }}</p></td>
                            <td class="des" align="center"><p style="text-decoration: underline;">{{ $historial->so_dos }}</p></td>
                        </tr>                        
                        <tr>
                            <td class="des" align="center">edad</td>
                            <td class="des" align="center">peso</td>
                            <td class="des" align="center">talla</td>
                            <td class="des" align="center">pulso</td>
                            <td class="des" align="center">temperatura</td>
                            <td class="des" align="center">p/a</td>
                            <td class="des" align="center">respiración</td>
                            <td class="des" align="center">so2</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <small>6) Actitud, piel</small>
                </td>
                <td  class="des" align="left" width="80%">
                    {!! $historial->parametro->parametro_seis !!}
                </td>
            </tr>
            <tr>
                <td>
                    <small>7) Craneo, cara, cuello, garganta</small>
                </td>
                <td  class="des" align="left" width="80%">
                    {!! $historial->parametro->parametro_siete !!}
                </td>
            </tr>
            <tr>
                <td>
                    <small>8) Tórax región cardiaca</small>
                </td>
                <td  class="des" align="left" width="80%">
                    {!! $historial->parametro->parametro_ocho !!}
                </td>
            </tr>
            <tr>
                <td>
                    <small>9) Abdomen</small>
                </td>
                <td  class="des" align="left" width="80%">
                    {!! $historial->parametro->parametro_nueve !!}
                </td>
            </tr>
            <tr>
                <td>
                    <small>10) Genito urinario</small>
                </td>
                <td  class="des" align="left" width="80%">
                    {!! $historial->parametro->parametro_diez !!}
                </td>
            </tr>
            <tr>
                <td>
                    <small>11) Miembros</small>
                </td>
                <td  class="des" align="left" width="80%">
                    {!! $historial->parametro->parametro_once !!}
                </td>
            </tr>
            <tr>
                <td>
                    <small>12) Sistema nervioso</small>
                </td>
                <td  class="des" align="left" width="80%">
                    {!! $historial->parametro->parametro_once !!}
                </td>
            </tr>
            <tr>
                <td>
                    <small>13) Ginecológico y/o rectal</small>
                </td>
                <td  class="des" align="left" width="80%">
                    {!! $historial->parametro->parametro_trece !!}
                </td>
            </tr>
        </table>
        <br><br>
        <table class="table_dos" width="100%" border="0" cellspacing="0" cellpadding="0">                       
            <tr>
                <td align="right"><p style="text-decoration: underline;">Col.: <strong>numero_colegiado nombre_medico</strong></td>
            </tr>                    
            <tr>
                <td align="right">firma y clave del médico</td>
            </tr>
        </table>        
        <div class="page-break"></div>
    @endforeach
</body>
</html>