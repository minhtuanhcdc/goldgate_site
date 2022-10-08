<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\BillreportExport;
use App\Exports\OusentExport;
use App\Exports\HpvExport;
use App\Exports\DSExport;
use App\Exports\DSThinExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExportexcelController extends Controller
{
   public function exportDS(Request $request){


    $dateNow=Carbon::now()->format('d-m-Y');
    return Excel::download(new DSExport($request->startDate, $request->endDate, $request->ousentFill, $request->nametestFill,  $request->resultHpvFill), 'DS_TraKQ_Hpv_'.$dateNow.'.xlsx');
    //return (new BillreportExport($request->startDate,$request->endDate,$request->ousentFill))->download('report.xls');
   }
   public function exportDsThin(Request $request){

    $dateNow=Carbon::now()->format('d-m-Y');
    return Excel::download(new DSThinExport($request->startDate, $request->endDate, $request->ousentFill, $request->resultFill), 'DS_TraKQ_Thin_'.$dateNow.'.xlsx');
    //return (new BillreportExport($request->startDate,$request->endDate,$request->ousentFill))->download('report.xls');
   }
   public function reportBill(Request $request){
   //dd($request->ousentFill);
    $dateNow=Carbon::now()->format('d-m-Y');
    return Excel::download(new BillreportExport($request->startDate, $request->endDate, $request->ousentFill, $request->nametestFill, $request->readcodeFill, $request->resultHpvFill), 'Report_'.$dateNow.'.xlsx');
    //return (new BillreportExport($request->startDate,$request->endDate,$request->ousentFill))->download('report.xls');
   }
   public function ousentexport(Request $request){
    //dd($request->all());

    return Excel::download(new OusentExport, 'ousents.xlsx');

   }
   public function hpvexport(Request $request){
    //dd($request->all());
    $dateNow=Carbon::now()->format('d-m-Y');

    return Excel::download(new HpvExport($request->startDate,$request->endDate,$request->ousentFill), 'HPV_'.$dateNow.'.xlsx');

   }
}
