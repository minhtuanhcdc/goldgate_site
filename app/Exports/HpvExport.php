<?php

namespace App\Exports;

use App\Models\Billtest;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FormArray;
use Maatwebsite\Excel\Concerns\FormView;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use \Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
//::TYPE_STRING;


class HpvExport implements FromCollection,WithMapping,WithHeadings,WithStyles,WithColumnFormatting
{
    protected $startDate, $endDate,$ousentFill;
    public function __construct($startDate, $endDate,$ousentFill){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->ousentFill = $ousentFill;
        //dd($this->startDate, $this->endDate);$date_format=$date->toDateString();
    }
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Billtest::all();
    // }
    public function map($billtest): array
    {
       //dd(123);
        return [
            $billtest->id,
            $billtest->hpv_code,
            $billtest->custommer->name,
            $billtest->custommer->birthday,

            // implode('',$billtest->sco->pluck('result')->toArray()),
            // implode('',$billtest->hpv16->pluck('result')->toArray()),
            // implode('',$billtest->hpv18->pluck('result')->toArray()),
            $billtest->ketluan(),
            $billtest->ousent->name,
            Date::stringToExcel($billtest->date_receive),
            $billtest->read_code,
        ];
    }
    public function headings():array{
        return[
            '#',
            'Mã Hpv',
            'Tên BN',
            'Tuổi',
            // 'SCO',
            // 'HPV 16',
            // 'HPV 18',
            'Kết quả',
            'Đơn vị gửi mẫu',
            'Ngày nhận mẫu',
            'Mã ĐV đọc mẫu',
        ];
    }
    public function styles(Worksheet $sheet){
        return[
            1=>['font'=>['bold'=>true,'size' =>'12','family'=>'Times New Roman'], 'color'=>'blue'],
            'E'=>['font'=>['bold'=>true],'color'=>'red'],
            'A:H'=>['font'=>['size' =>'12','family'=>'Times New Roman'],'color'=>'red'],
        ];


    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $startDate = $this->startDate;
       $endDate = $this->endDate;
       $ousentFill = $this->ousentFill;

        return Billtest::where('ousent_id',$ousentFill)
        ->where('date_receive',$startDate)
        //->where('date_receive','<=',$endDate)
        ->with('resulthpvs')->get();
    }

    public function columnFormats(): array
    {
        return [

            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY

        ];
    }

    // protected $billtest = [
    //     //'item_id' => 'integer',
    //     'H' => 'string',
    //  ];



}
