<?php

namespace App\Exports;

use App\Models\Ousent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class OusentExport implements FromCollection, WithMapping,WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ousent::all();
    }

    public function map($ousents): array
    {
        return [
            $ousents->id,
            $ousents->form_group,
            $ousents->name,
            $ousents->address,
            $ousents->phone_contact,
            $ousents->website,
            $ousents->person_contact,
            $ousents->phone,
           // Date::dateTimeToExcel($invoice->created_at),
        ];
    }

    public function headings():array{
        return[
            'Mã ĐV',
            'Form group',
            'Tên ĐV gửi mẫu',
            'Địa chỉ',
            'Điện thoại ',
            'Website ',
            'Người liên hệ',
            'Phone',
        ];
    }

    public function styles(Worksheet $sheet){
        return $sheet->setStyle(array(
            'font' => array(
                'name'      =>  'Times New Roman',
                'size'      =>  14,
                'bold'      =>  true
            )
        ));
    }
}
