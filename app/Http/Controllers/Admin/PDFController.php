<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
//use Barryvdh\DomPDF\Facade as PDF;
use Inertia\Inertia;
use App\Models\Billtest;
use App\Models\Testelement;
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFController extends Controller
{
    public function TransBillId(Request $r){
     // dd($r->all());
      $this->downloadPDF($r->all());
    }

    public function downloadPDF(Request $r){
     // dd($r->all());
      $fruits = collect($r->all());
      $keys = $fruits->keys();
     //dd($keys);
      $billtests=Billtest::whereIn('id',$keys)->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])->get();
     // $dateNow = Carbon::now()->toDateTimeString('d-m-Y');
      $date = date('d-m-Y', time());

      //dd($billtests);
      $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
      $pdf = PDF::loadView('printView.Index', [
        'billtests'=>$billtests,
        'testElements'=>$testElements,
        'dateNow'=>$date,

      ]);
      $pdf->setPaper('A4', 'portrait');

      //$pdf->render();
      return $pdf->stream();
      //return $pdf->stream('Leito.pdf');

      // $options = new Options();
      // $options->set('defaultFont', 'sans-serif');
      // $dompdf = new Dompdf($options);
      // $dompdf->loadView('printView.Index', [
      //   'billtests'=>$billtests,
      //   'testElements'=>$testElements,

      // ]);
      // $dompdf->setPaper('A4', 'landscape');
//$pdf->$options;
      //PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
     //$pdf->setDefaultFont('sans-serif');
      //$pdf->setMarginBottom('margin-bottom', '0mm');
      // $pdf->Options('margin-top', '0mm');
      // $pdf->Options('margin-right', '0mm');
      // $pdf->Options('margin-left', '0mm');
      //$pdf->setPaper('A4', 'landscape');


      }
}
