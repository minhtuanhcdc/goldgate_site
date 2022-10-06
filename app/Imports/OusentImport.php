<?php

namespace App\Imports;

use App\Models\Ousent;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;


class OusentImport implements ToModel,WithHeadingRow
  {   /**
    * @param array $row
    *name	address	phone_contact	website	person_contact	phone

    *`image_footer`, `footer_view`, `header_view`, `address_view`, `logo_view`, `created_at`, `updated_at`
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ousent([
            'name'     => $row['name'],
            'address'     => $row['address'],
            'phone_contact'     => $row['phone_contact'],
            'website'     => $row['website'],
            'form_group'     => $row['form_group'],
            'person_contact'     => $row['person_contact'],
            'phone'     => $row['phone'],
        ]);
    }
}
