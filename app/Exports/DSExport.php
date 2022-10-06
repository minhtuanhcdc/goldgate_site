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

        return [
            $billtest->id,
            $billtest->thinprep_code,
            $billtest->hpv_code,

            $billtest->custommer->name,
            $billtest->custommer->birthday,
            $billtest->custommer->address.', '.$billtest->custommer->ward->name .', '.$billtest->custommer->district->name.', '.$billtest->custommer->province->name,
            $billtest->custommer->phone,
            $billtest->ousent->name,
            Date::stringToExcel($billtest->date_receive),
            $billtest->ketluan_hpv(),
        ];
    }
    public function headings():array{
        return[
            "#",
            "Mã Thinprep",
            "Mã HPV",
            "Tên bệnh nhân",
            "Năm sinh",
            "Địa chỉ",
            "Điện thoại",
            "Đơn vị gửi mẫu",
            "Ngày nhận mẫu",
            "Kết quả HPV",
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
