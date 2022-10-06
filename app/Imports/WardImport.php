<?php

namespace App\Imports;

use App\Models\Ward;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class WardImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Ward([
            'code'     => $row['code'],
            'name'     => $row['name'],
            'district_id'  => $row['district_id'],
        ]);
    }
}
