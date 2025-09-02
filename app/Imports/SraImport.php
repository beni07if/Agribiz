<?php

namespace App\Imports;

use App\Models\Sra;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class SraImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        return new Sra([
            'idGroup' => $row[0],
            'group_name' => $row[1],
            'transparency' => $row[2],
            'percent_transparency' => $row[3],
            'rspo_compliance' => $row[4],
            'percent_rspo_compliance' => $row[5],
            'ndpe_compliance' => $row[6],
            'percent_ndpe_compliance' => $row[7],
            'total' => $row[8],
            'percent_total' => $row[9],
            // Tambahkan kolom lain sesuai kebutuhan
        ]);
    }
}