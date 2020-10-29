<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\clinica\sistema\FichaMedicaA;
use App\Models\clinica\sistema\HistorialFMA;

class ReporteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('administrador');
        //$this->middleware('medico');
        $this->middleware('secretaria');
    }

    public function ficha_medica($ficha)
    {
        $ficha = FichaMedicaA::find($ficha);
        $pdf = \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('clinica.pdf.constancia.ficha_medica', compact('ficha'));
        $nombre_documento = mb_strtolower($ficha->persona->nombre_uno . $ficha->persona->nombre_dos);
        $fecha = date('dmY');
        $hora = date('his');
        return $pdf->stream("ficha_tecnico_{$nombre_documento}_{$fecha}{$hora}.pdf");
    }

    public function historial($paciente)
    {
        $historiales = HistorialFMA::with('parametro')->where('id', $paciente)->get();
        $ficha = FichaMedicaA::find($historiales[0]->ficha_medica_a_id);

        $pdf = \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('clinica.pdf.constancia.historial', compact('ficha', 'historiales'));
        $nombre_documento = mb_strtolower($ficha->persona->nombre_uno . $ficha->persona->nombre_dos);
        $fecha = date('dmY');
        $hora = date('his');
        return $pdf->stream("historial_{$historiales[0]->codigo}_{$nombre_documento}_{$fecha}{$hora}.pdf");
    }
}
