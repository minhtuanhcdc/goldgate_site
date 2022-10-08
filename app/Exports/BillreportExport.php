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



class BillreportExport implements FromCollection,WithMapping,WithHeadings,WithStyles,WithColumnFormatting

{
    //$request->nametestFill
    protected $startDate, $endDate,$ousentFill, $readcodeFill, $nametestFill, $resultHpvFill;
    public function __construct($startDate, $endDate, $ousentFill,$nametestFill, $readcodeFill,$resultHpvFill){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->ousentFill = $ousentFill;
        $this->nametestFill = $nametestFill;

        $this->readcodeFill = $readcodeFill;
        $this->resultHpvFill = $resultHpvFill;
        //dd($this->startDate, $this->endDate);$date_format=$date->toDateString();

    }
    use Exportable;

    public function map($billtest): array
    {

        $array ='';
        $getAddress='';
        foreach ($billtest->ketqua_thin as $value){
         $array .= $value['name'].'; ';
        };
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
            $billtest->read_code,

            $billtest->custommer->name,
            $billtest->custommer->birthday,
            $getAddress,
            $billtest->custommer->phone,

            $billtest->ousent->name,
            $billtest->doctor_indi,

            Date::stringToExcel($billtest->date_receive),
            $billtest->ketluan_hpv(),
            $array,


        ];
    }
    public function headings():array{

        return[
            "#",
            "Mã Thinprep",
            "Mã HPV",
            "Đơn vị đọc",

            "Tên bệnh nhân",
            "Năm sinh",
            "Địa chỉ",
            "Điện thoại",

            "Đơn vị gửi mẫu",
            "Bác sỹ chỉ định",

            "Ngày nhận mẫu",
            "Kết quả HPV",
            "Kết quả Thinprep",
            "Ghi chú",
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

       //<span v-if="rs.element_group ==5 || rs.element_group ==6 || rs.element_group ==7 || rs.element_group ==13
       //|| rs.element_group ==14|| rs.element_group ==15|| rs.element_group ==16 || rs.element_group ==21" class="text-blue-600">
        $weekAgo = Carbon::now()->subDays(10)->toDateString();
    //dd($weekAgo);
        $curentDate = Carbon::now()->toDateString();
        $startDate = $this->startDate;
        $endDate = $this->endDate;
        $ousentFill = $this->ousentFill;
        $nametestFill = $this->nametestFill;
       // dd($nametestFill);
        $readcodeFill = $this->readcodeFill;
        $resultHpvFill = $this->resultHpvFill;

//Field Free================================================================================//
if(!$ousentFill && !$nametestFill && !$readcodeFill && !$startDate && !$endDate){
    //dd(1235555);
    $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','ketqua_thin','resulthpvs'])
    ->whereDate('date_receive','>=',$weekAgo)
    ->orderBy('date_receive','desc')
    ->get();
}
//Ousent===================================================================================//
if($ousentFill && (!$nametestFill && !$readcodeFill && !$startDate && !$endDate) ){
    $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageLeft','ketqua_thin','resulthpvs'])
    ->where('ousent_id',$ousentFill)
    ->orderBy('date_receive','desc')
    ->get();
}
if($ousentFill && $nametestFill && (!$readcodeFill && !$startDate && !$endDate)){
    $billtests=Billtest::with(['custommer','doctor','testnames','ousent','imageLeft','ketqua_thin','resulthpvs'])
    ->where('ousent_id',$ousentFill)
    ->whereHas('testnames', function($qr) use($nametestFill){
                 $qr->where('testname_id',$nametestFill);
             })->with('testnames')
    ->orderBy('date_receive','desc')
    ->get();
}
if($ousentFill &&  $readcodeFill && (!$nametestFill && !$startDate && !$endDate)){
    $billtests=Billtest::with(['custommer','doctor','testnames','ousent','imageLeft','ketqua_thin','resulthpvs'])
    ->where('ousent_id',$ousentFill)
    ->where('read_code',$readcodeFill)
    ->orderBy('date_receive','desc')
    ->get();
}
if($ousentFill &&  $readcodeFill  && $startDate && $endDate && !$nametestFill){
    $billtests=Billtest::with(['custommer','doctor','testnames','ousent','imageLeft','ketqua_thin','resulthpvs'])
    ->where('ousent_id',$ousentFill)
    ->where('read_code',$readcodeFill)
    ->whereDate('date_receive','>=',$startDate)
    ->whereDate('date_receive','<=',$endDate)
    ->orderBy('date_receive','desc')
    ->get();
}
if($ousentFill && $nametestFill && $readcodeFill && (!$startDate && !$endDate)){
    $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','ketqua_thin','resulthpvs'])
    ->where('ousent_id',$ousentFill)
    ->whereHas('testnames', function($qr) use($nametestFill){
                 $qr->where('testname_id',$nametestFill);
             })->with('testnames')
    ->where('read_code',$readcodeFill)
    ->orderBy('date_receive','desc')
    ->get();
}
if($ousentFill && $nametestFill && $readcodeFill && $startDate && $endDate){
    $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','ketqua_thin','resulthpvs'])
    ->where('ousent_id',$ousentFill)
    ->whereHas('testnames', function($qr) use($nametestFill){
                 $qr->where('testname_id',$nametestFill);
             })->with('testnames')
    ->where('read_code',$readcodeFill)
    ->whereDate('date_receive','>=',$startDate)
    ->whereDate('date_receive','<=',$endDate)
    ->get();
}
if($ousentFill && $startDate && $endDate && (!$nametestFill && !$readcodeFill) ){
    dd(123);
    $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','ketqua_thin','resulthpvs'])
    ->where('ousent_id',$ousentFill)
    ->whereDate('date_receive','>=',$startDate)
    ->whereDate('date_receive','<=',$endDate)
    ->orderBy('date_receive','desc')
    ->get();
}
//NametestFill===================================================================================//
if($nametestFill && (!$ousentFill && !$readcodeFill && !$startDate && !$endDate)){
    $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageLeft','ketqua_thin','resulthpvs'])
        ->whereHas('testnames', function($qr) use($nametestFill){
                    $qr->where('testname_id',$nametestFill);
                    })->with('testnames')
        ->orderBy('date_receive','desc')
        ->get();
    }
if( $nametestFill && $startDate && $endDate && (!$ousentFill&& !$readcodeFill) ){
    $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','ketqua_thin','resulthpvs'])
    ->whereHas('testnames', function($qr) use($nametestFill){
                 $qr->where('testname_id',$nametestFill);
             })->with('testnames')
    ->whereDate('date_receive','>=',$startDate)
    ->whereDate('date_receive','<=',$endDate)
    ->orderBy('date_receive','desc')
    ->get();
}
//readcodeFill===================================================================================//
if($readcodeFill && (!$ousentFill && !$nametestFill &&  !$startDate && !$endDate)){
    $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','ketqua_thin','resulthpvs'])
    ->where('read_code',$readcodeFill)
    ->orderBy('date_receive','desc')
    ->get();
}
if($readcodeFill && $ousentFill && (!$nametestFill &&  !$startDate && !$endDate)){
    $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','ketqua_thin','resulthpvs'])
    ->where('read_code',$readcodeFill)
    ->where('ousent_id',$ousentFill)
    ->orderBy('date_receive','desc')
    ->get();
}
if($readcodeFill && $ousentFill &&  $startDate && $endDate && (!$nametestFill )){
    $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','ketqua_thin','resulthpvs'])
    ->where('read_code',$readcodeFill)
    ->where('ousent_id',$ousentFill)
    ->whereDate('date_receive','>=',$startDate)
    ->whereDate('date_receive','<=',$endDate)
    ->orderBy('date_receive','desc')
    ->get();
}
if($readcodeFill  &&  $startDate && $endDate && (!$ousentFill &&!$nametestFill )){
    $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','ketqua_thin','resulthpvs'])
    ->where('read_code',$readcodeFill)
    ->whereDate('date_receive','>=',$startDate)
    ->whereDate('date_receive','<=',$endDate)
    ->orderBy('date_receive','desc')
    ->get();
}
//Date===================================================================================//
if( $startDate && $endDate && (!$ousentFill&& !$readcodeFill && !$resultHpvFill)){
    $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageLeft','ketqua_thin','resulthpvs'])
    ->whereDate('date_receive','>=',$startDate)
    ->whereDate('date_receive','<=',$endDate)
    ->orderBy('date_receive','desc')
    ->get();
}
//Resulte===================================================================================//
if($resultHpvFill =='positive' && (!$ousentFill && !$nametestFill && !$readcodeFill && !$startDate && !$endDate)) {

    $billtests=Billtest::with(['custommer','doctor','ousent','testnames','ketqua_thin','resulthpvs'])
    ->whereHas('resulthpvs', function($qr){
        $qr->where('element_id',56)->where('result','>=',0.5);
    })->with('resulthpvs')
    ->orderBy('hpv_code','desc')
    ->get();
}
if($resultHpvFill =='positive' && $ousentFill && (!$nametestFill && !$readcodeFill && !$startDate && !$endDate)) {
    $billtests=Billtest::with(['custommer','doctor','ousent','testnames','ketqua_thin','resulthpvs'])
    ->where('ousent_id',$ousentFill)
    ->whereHas('resulthpvs', function($qr){
        $qr->where('element_id',56)->where('result','>=',0.5);
    })->with('resulthpvs')
    ->orderBy('hpv_code','desc')
    ->get();
}
if($resultHpvFill =='positive' && $ousentFill && $startDate && $endDate && (!$nametestFill && !$readcodeFill )) {
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
if($resultHpvFill =='negative' && (!$ousentFill && !$nametestFill && !$readcodeFill && !$startDate && !$endDate)) {
    $billtests=Billtest::with(['custommer','doctor','ousent','testnames','ketqua_thin','resulthpvs'])
    ->whereHas('resulthpvs', function($qr){
        $qr->where('element_id',56)->where('result','<',0.5);
    })->with('resulthpvs')
    ->where('hpv_code','!=',null)
    ->orderBy('hpv_code','desc')
    ->get();
}
if($resultHpvFill =='negative' && $ousentFill && (!$nametestFill && !$readcodeFill && !$startDate && !$endDate)) {
    $billtests=Billtest::with(['custommer','doctor','ousent','testnames','ketqua_thin','resulthpvs'])
    ->where('ousent_id',$ousentFill)
    ->whereHas('resulthpvs', function($qr){
        $qr->where('element_id',56)->where('result','<',0.5);
    })->with('resulthpvs')
    ->where('hpv_code','!=',null)
    ->orderBy('hpv_code','desc')
    ->get();
}
if($resultHpvFill =='negative' && $ousentFill && $startDate && $endDate && (!$nametestFill && !$readcodeFill )) {
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

            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY

        ];
    }

    protected $billtest = [
        //'item_id' => 'integer',
        'H' => 'string',
     ];
}
