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
use Carbon\Carbon;

class DSThinExport implements FromCollection,WithMapping,WithHeadings,WithStyles,WithColumnFormatting
{
    protected $startDate, $endDate, $ousentFill,  $resultFill;
    public function __construct($startDate, $endDate, $ousentFill, $resultFill){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->ousentFill = $ousentFill;
        $this->resultFill = $resultFill;
    }
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        $weekAgo = Carbon::now()->subDays(10)->toDateString();
        $curentDate = Carbon::now()->toDateString();
        $startDate = $this->startDate;
        $endDate = $this->endDate;
        $ousentFill = $this->ousentFill;
       // dd($nametestFill);
        $resultFill = $this->resultFill;
        //Field Free================================================================================//
        if(!$ousentFill && !$startDate && !$endDate){
            //dd(1235555);
            $billtests=Billtest::where('thinprep_code','!=',null)
            ->with(['custommer','doctor','ousent','imageLeft','ketqua_thin','resulthpvs'])
            ->whereDate('date_receive',$curentDate)
            ->orderBy('date_receive','desc')
            ->get();
        }
        //Ousent===================================================================================//
        if($ousentFill && (!$startDate && !$endDate) ){
            $billtests=Billtest::where('thinprep_code','!=',null)
            ->with(['custommer','doctor','ousent','testnames','imageLeft','ketqua_thin','resulthpvs'])
            ->where('ousent_id',$ousentFill)
            ->orderBy('date_receive','desc')
            ->get();
        }
        if($ousentFill && $startDate && $endDate){
            $billtests=Billtest::where('thinprep_code','!=',null)
            ->with(['custommer','doctor','ousent','imageLeft','ketqua_thin','resulthpvs'])
            ->where('ousent_id',$ousentFill)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->get();
        }
        //Date===================================================================================//
        if( $startDate && $endDate && (!$ousentFill)){
            $billtests=Billtest::where('thinprep_code','!=',null)
            ->with(['custommer','doctor','ousent','testnames','imageLeft','ketqua_thin','resulthpvs'])
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->orderBy('date_receive','desc')
            ->get();
        }
        //Resulte===================================================================================//

        return $billtests;
    }
    public function headings():array{
        return[
            "#",
            "M?? Thinprep",
            "T??n b???nh nh??n",
            "N??m sinh",
            "?????a ch???",
            "??i???n tho???i",
            "????n v??? g???i m???u",
            "Ng??y nh???n m???u",
            "K???t qu??? Thin",
            "Ghi ch??",
        ];
    }
    public function map($billtest): array
    {
        $array ='';
        foreach ($billtest->ketqua_thin as $value){
         $array .= $value['name'].'; ';
        }
        $getAddress='';
        if(!$billtest->custommer->province)
        {
            $getAddress = $billtest->custommer->address;
        }
        if($billtest->custommer->province && $billtest->custommer->district){
            $getAddress = $billtest->custommer->address.''.$billtest->custommer->ward->name.', '.$billtest->custommer->district->name;
        }
        if($billtest->custommer->province && $billtest->custommer->district && $billtest->custommer->ward){
            $getAddress = $billtest->custommer->address.''.$billtest->custommer->ward->name.', '.$billtest->custommer->district->name.', '.$billtest->custommer->province->name;
        }
        return [
            $billtest->id,
            $billtest->thinprep_code,
            $billtest->custommer->name,
            $billtest->custommer->birthday,
            $getAddress,
            //.', '.$billtest->custommer->ward->name .', '.$billtest->custommer->district->name.', '.$billtest->custommer->province->name,
            $billtest->custommer->phone,
            $billtest->ousent->name,
            Date::stringToExcel($billtest->date_receive),
            $array,
        ];
    }
    public function styles(Worksheet $sheet){
        return[
           1=>['font'=>['bold'=>true]],
            'C1'=>['font'=>['bold'=>true, 'italic'=>true],'color'=>'red'],
        ];
    }
    public function columnFormats(): array
    {
        return [

            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY

        ];
    }

    protected $billtest = [
        //'item_id' => 'integer',
        'H' => 'string',
     ];
}
