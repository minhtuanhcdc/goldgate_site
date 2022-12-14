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

class DSExport implements FromCollection,WithMapping,WithHeadings,WithStyles,WithColumnFormatting

{
    //$request->nametestFill
    protected $startDate, $endDate,$ousentFill, $nametestFill, $resultHpvFill;
    public function __construct($startDate, $endDate, $ousentFill,$nametestFill, $resultHpvFill){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->ousentFill = $ousentFill;
        $this->nametestFill = $nametestFill;


        $this->resultHpvFill = $resultHpvFill;
    }
    use Exportable;
    public function map($billtest): array
    {
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
            $billtest->hpv_code,

            $billtest->custommer->name,
            $billtest->custommer->birthday,
            $getAddress,
            $billtest->custommer->phone,
            $billtest->ousent->name,
            Date::stringToExcel($billtest->date_receive),
            $billtest->ketluan_hpv(),
        ];
    }
    public function headings():array{
        return[
            "#",
            "M?? Thinprep",
            "M?? HPV",
            "T??n b???nh nh??n",
            "N??m sinh",
            "?????a ch???",
            "??i???n tho???i",
            "????n v??? g???i m???u",
            "Ng??y nh???n m???u",
            "K???t qu??? HPV",
            "Ghi ch??",
        ];
    }
    public function styles(Worksheet $sheet){
        return[
           1=>['font'=>['bold'=>true]],
            'C1'=>['font'=>['bold'=>true, 'italic'=>true],'color'=>'red'],
        ];
    }
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
        $resultHpvFill = $this->resultHpvFill;

        //Field Free================================================================================//
        if(!$ousentFill && !$startDate && !$endDate){
            //dd(1235555);
            $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','ketqua_thin','resulthpvs'])
            ->whereDate('date_receive',$curentDate)
            ->orderBy('date_receive','desc')
            ->get();
        }
        //Ousent===================================================================================//
        if($ousentFill && (!$startDate && !$endDate) ){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageLeft','ketqua_thin','resulthpvs'])
            ->where('ousent_id',$ousentFill)
            ->orderBy('date_receive','desc')
            ->get();
        }
        if($ousentFill && $startDate && $endDate){
            $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','ketqua_thin','resulthpvs'])
            ->where('ousent_id',$ousentFill)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->get();
        }
        //Date===================================================================================//
        if( $startDate && $endDate && (!$ousentFill)){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageLeft','ketqua_thin','resulthpvs'])
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->orderBy('date_receive','desc')
            ->get();
        }
        //Resulte===================================================================================//
        if($resultHpvFill =='positive' && (!$ousentFill && !$startDate && !$endDate)) {
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','ketqua_thin','resulthpvs'])
            ->whereHas('resulthpvs', function($qr){
                $qr->where('element_id',56)->where('result','>=',0.5);
            })->with('resulthpvs')
            ->orderBy('hpv_code','desc')
            ->get();
        }
        if($resultHpvFill =='positive' && $ousentFill && (!$startDate && !$endDate)) {
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','ketqua_thin','resulthpvs'])
            ->where('ousent_id',$ousentFill)
            ->whereHas('resulthpvs', function($qr){
                $qr->where('element_id',56)->where('result','>=',0.5);
            })->with('resulthpvs')
            ->orderBy('hpv_code','desc')
            ->get();
        }
        if($resultHpvFill =='positive' && $ousentFill && $startDate && $endDate) {
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','ketqua_thin','resulthpvs'])
            ->where('ousent_id',$ousentFill)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->whereHas('resulthpvs', function($qr){
                $qr->where('element_id',56)->where('result','>=',0.5);
            })->with('resulthpvs')
            ->orderBy('hpv_code','desc')
            ->get();
        }
        if($resultHpvFill =='negative' && (!$ousentFill && !$startDate && !$endDate)) {
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','ketqua_thin','resulthpvs'])
            ->whereHas('resulthpvs', function($qr){
                $qr->where('element_id',56)->where('result','<',0.5);
            })->with('resulthpvs')
            ->where('hpv_code','!=',null)
            ->orderBy('hpv_code','desc')
            ->get();
        }
        if($resultHpvFill =='negative' && $ousentFill && (!$startDate && !$endDate)) {
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','ketqua_thin','resulthpvs'])
            ->where('ousent_id',$ousentFill)
            ->whereHas('resulthpvs', function($qr){
                $qr->where('element_id',56)->where('result','<',0.5);
            })->with('resulthpvs')
            ->where('hpv_code','!=',null)
            ->orderBy('hpv_code','desc')
            ->get();
        }
        if($resultHpvFill =='negative' && $ousentFill && $startDate && $endDate ) {
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','ketqua_thin','resulthpvs'])
            ->where('ousent_id',$ousentFill)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->whereHas('resulthpvs', function($qr){
                $qr->where('element_id',56)->where('result','<',0.5);
            })->with('resulthpvs')
            ->where('hpv_code','!=',null)
            ->orderBy('hpv_code','desc')
            ->get();
        }
        return $billtests;
    }

    public function columnFormats(): array
    {
        return [

            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY

        ];
    }

    protected $billtest = [
        //'item_id' => 'integer',
        'H' => 'string',
     ];
}
