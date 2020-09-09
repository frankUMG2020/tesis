<?php

namespace App\Imports;

use App\Models\clinica\catalogo\Departamento;
use App\Models\clinica\catalogo\Municipio;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MunicipioImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $value) {
            if (!is_null($value[0])) {
                $nuevo = new Municipio();
                $nuevo->nombre = $value[0];
                $nuevo->departamento_id = $value[1];
                $nuevo->save();
            }
        }
    }
}
