<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Ousent;
use App\Models\Ouread;
use App\Models\Doctor;
use App\Models\Custommer;
use App\Models\Billtest;
use App\Models\Billname;
use App\Models\Testname;
use App\Models\Testelement;
use App\Models\Eurolab;
use App\Models\Custommeraddress;
use App\Http\Requests\SaveCustommerRequest;
use App\Http\Resources\TestnameResource;
use DB;
use Carbon\Carbon;

class PrintController extends Controller
{
    public function printThinprep(Request $request){
        $perpage = $request->perPage?$request->perPage:10;
        $ousentFill=$request->ousentFill;
        $readcodeFill=$request->readcodeFill;
        $startDate=$request->startDate;
        $endDate=$request->endDate;
        $currentDate = Carbon::now()->toDateString();
        $tenDateAgo=Carbon::now()->subDays(10)->toDateString();
        $query='';
         if (request('term')) {
            $query = Billtest::query();
            $query->where('thinprep_code', 'like', '%'.request('term').'%');
            }
     // Free all==========================================================================
     if(!$ousentFill && !$readcodeFill && !$startDate && !$endDate){
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageleft','results','doctorread'])
        ->where('thinprep_code','!=',null)
        ->whereDate('date_receive','>=',$tenDateAgo)
        ->orderBy('thinprep_code','desc')
        ->paginate($perpage)->withQueryString();
     }
     // Ousent==========================================================================
         if($ousentFill && (!$readcodeFill && !$startDate && !$endDate)){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageleft','results','doctorread'])
            ->where('thinprep_code','!=',null)
            ->where('ousent_id',$ousentFill)
            ->orderBy('thinprep_code','desc')
            ->paginate($perpage)->withQueryString();
        }
         if($ousentFill && $readcodeFill && (!$startDate && !$endDate)){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageleft','results','doctorread'])
            ->where('thinprep_code','!=',null)
            ->where('ousent_id',$ousentFill)
            ->where('read_code',$readcodeFill)
            ->orderBy('thinprep_code','desc')
            ->paginate($perpage)->withQueryString();
        }
         if($ousentFill && $readcodeFill && $startDate && $endDate){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageleft','results','doctorread'])
            ->where('thinprep_code','!=',null)
            ->where('ousent_id',$ousentFill)
            ->where('read_code',$readcodeFill)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->orderBy('thinprep_code','desc')
            ->paginate($perpage)->withQueryString();
        }
         if($ousentFill && !$readcodeFill && $startDate && $endDate){
            //dd(123);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageleft','results','doctorread'])
            ->where('thinprep_code','!=',null)
            ->where('ousent_id',$ousentFill)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->orderBy('thinprep_code','desc')
            ->paginate($perpage)->withQueryString();
        }
     // ReadcCod==========================================================================
     if($readcodeFill && (!$ousentFill &&  !$startDate && !$endDate)){
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageleft','results','doctorread'])
        ->where('thinprep_code','!=',null)
        ->where('read_code',$readcodeFill)
        ->orderBy('thinprep_code','desc')
        ->paginate($perpage)->withQueryString();
    }
     if($readcodeFill  &&  $startDate && $endDate && (!$ousentFill)){
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageleft','results','doctorread'])
        ->where('thinprep_code','!=',null)
        ->where('read_code',$readcodeFill)
        ->whereDate('date_receive','>=',$startDate)
        ->whereDate('date_receive','<=',$endDate)
        ->orderBy('thinprep_code','desc')
        ->paginate($perpage)->withQueryString();
    }
     // Free all==========================================================================
     if ($startDate && $endDate && (!$readcodeFill  && !$ousentFill)){
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageleft','results','doctorread'])
        ->where('thinprep_code','!=',null)
        ->whereDate('date_receive','>=',$startDate)
        ->whereDate('date_receive','<=',$endDate)
        ->orderBy('thinprep_code','desc')
        ->paginate($perpage)->withQueryString();
    }

        $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
        //dd($billtests);
        $provinces = Province::with('districts','wards')->get();
        $districts = District::get();
        $wards = Ward::get();

        $ousents = Ousent::select('id','name','logo')->get();
        $doctors = Doctor::with('ousent')->get();
        $readcodes = Ouread::get();
        // $nametests = Testname::select('id','name')->get();
        $nametests=TestnameResource::collection(Testname::get());
        $filters=[
            'ousentFill'=>$request->ousentFill,
        ];

        return Inertia::render('PrintResult/IndexThin',[
            'billtests'=>$query?fn()=>$query
                        ->with(['custommer','doctor','ousent','testnames','imageleft','results','doctorread'])
                        ->where('thinprep_code','!=',null)
                        ->orderBy('thinprep_code','desc')
                        ->paginate($perpage)->withQueryString():$billtests,
            'nametests'=> $nametests,
            'testElements'=>$testElements,
            'provinces'=>$provinces,
            'districts'=>$districts,
            'wards'=>$wards,
            'ousents'=>$ousents,
            'doctors'=>$doctors,
            'readcodes'=>$readcodes,
            'filters'=>$filters,
            'custommer'=>Custommer::with('province')->get(),
            'eurolab'=>Eurolab::where('id',1)->first(),
        ]);
    }
    public function printHpv(Request $request){
        $perpage = $request->perPage?$request->perPage:50;
        $ousentFill=$request->ousentFill;

        $startDate=$request->startDate;
        $endDate=$request->endDate;
        $starthpv=$request->starthpv;
        $tohpv=$request->tohpv;

       $query ='';


        $currentDate=Carbon::now()->toDateString();
        $tenDateAgo=Carbon::now()->subDays(10)->toDateString();

        if (request('term')) {
            $query = Billtest::query();
            $query->where('hpv_code', 'like', '%'.request('term').'%');
           }
    //Free Fill=================================
    if(!$ousentFill && !$startDate && !$endDate && !$starthpv && !$tohpv){
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
        ->where('hpv_code','!=',null)
        ->whereDate('date_receive','>=',$tenDateAgo)
        ->orderBy('hpv_code','desc')
        ->paginate($perpage)->withQueryString();
    }
    //Ousent ==================================================================//
    if($ousentFill && (!$startDate && !$endDate && !$starthpv && !$tohpv)){
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
        ->where('hpv_code','!=',null)
        ->where('ousent_id',$ousentFill)
        ->orderBy('hpv_code','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($ousentFill && $startDate && $endDate && (!$starthpv && !$tohpv)){
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
        ->where('hpv_code','!=',null)
        ->where('ousent_id',$ousentFill)
        ->whereDate('date_receive','>=',$startDate)
        ->whereDate('date_receive','<=',$endDate)
        ->orderBy('hpv_code','desc')
        ->paginate($perpage)->withQueryString();
    }
    if(!$ousentFill && $startDate && $endDate && (!$starthpv && !$tohpv)){
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
        ->where('hpv_code','!=',null)
        ->whereDate('date_receive','>=',$startDate)
        ->whereDate('date_receive','<=',$endDate)
        ->orderBy('hpv_code','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($starthpv && $tohpv && (!$ousentFill && !$startDate && !$endDate)){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->where('hpv_code','>=',$starthpv)
            ->where('hpv_code','<=',$tohpv)
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();

        }


        $testElements = Testelement::where('testname_id',2)->select('id','name','element_group')->get();
        //dd($billtests);
        $provinces = Province::with('districts','wards')->get();
        $districts = District::get();
        $wards = Ward::get();

        $ousents = Ousent::select('id','name','logo')->get();
        $doctors = Doctor::with('ousent')->get();


        // $nametests = Testname::select('id','name')->get();
        $nametests=TestnameResource::collection(Testname::get());
        $filters=[
            'ousentFill'=>$request->ousentFill,
            ' startDate'=>$request->startDate,
            'endDate'=>$request->endDate,
            'starthpv'=>$request->starthpv,
            'tohpv'=>$request->tohpv

        ];
        return Inertia::render('PrintResult/IndexHpv',[
            'billtests'=>$query?fn()=>$query->with(['custommer','doctor','ousent','testnames','resulthpvs'])
                           ->orderBy('hpv_code','desc')
                        ->paginate($perpage)->withQueryString():$billtests,
            'nametests'=> $nametests,
            'testElements'=>$testElements,
            'provinces'=>$provinces,
            'districts'=>$districts,
            'wards'=>$wards,
            'ousents'=>$ousents,
            'ouread'=>Ouread::where('asign_hpv',1)->first(),
            'doctors'=>$doctors,
            'filters'=>$filters,
            'eurolab'=>Eurolab::where('id',1)->first(),
            'custommer'=>Custommer::with('province')->get(),
        ]);
    }

    public function printMutiThin(Request $rq){
       // dd($rq->all());

        $keys = collect($rq->all());
        $ids = $keys->keys();
//dd($ids);
        $billGroup_1 = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','imageleft','results'])
                    ->whereHas('ousent', function($qr){
                      $qr->where('form_group',1);
                    })->with('ousent')
                    ->get();
        $billGroup_2 = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','imageleft','results'])

                    ->whereHas('ousent', function($qr){
                      $qr->where('form_group',2);
                    })->with('ousent')
                    ->get();
        $billGroup_3 = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','imageleft','results'])

                    ->whereHas('ousent', function($qr){
                      $qr->where('form_group',3);
                    })->with('ousent')
                    ->get();
        $billGroup_4 = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','imageleft','results'])

                    ->whereHas('ousent', function($qr){
                      $qr->where('form_group',4);
                    })->with('ousent')
                    ->get();
        $billGroup_5 = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','imageleft','results'])
                    ->whereHas('ousent', function($qr){
                      $qr->where('form_group',5);
                    })->with('ousent')
                    ->get();
        $billGroup_6 = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','imageleft','results'])

                    ->whereHas('ousent', function($qr){
                      $qr->where('form_group',6);
                    })->with('ousent')
                    ->get();
        $billGroup_general = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','imageleft','results'])

                    ->whereHas('ousent', function($qr){
                      $qr->where('form_group',null);
                    })->with('ousent')
                    ->get();

        // $billtests = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','district','ward','imageleft','results'])
        //             ->get();

        //dd($billHCDC);
        $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
        $elementChecked = [];


        return Inertia::render('PrintMulti/Index',
            [
                'testElements'=>$testElements,
                'billGroup_1'=>$billGroup_1,
                'billGroup_2'=>$billGroup_2,
                'billGroup_3'=>$billGroup_3,
                'billGroup_4'=>$billGroup_4,
                'billGroup_5'=>$billGroup_5,
                'billGroup_6'=>$billGroup_6,
                'billGroup_general'=>$billGroup_general,
                'eurolab'=>Eurolab::where('id',1)->first(),

            ]
        );
    }

    public function printMutiHpv(Request $rq){

        $keys = collect($rq->all());
        $ids = $keys->keys();
//dd($ids);
        $billtests = Billtest::whereIn('id',$ids)->with(['custommer','doctor','ousent','testnames','imageleft','resulthpvs'])
                    ->where('hpv_code','!=',null)->get();

        $testElements = Testelement::where('testname_id',1)->where('status','!=',0)->select('id','name','element_group')->get();
        $eurolab= Eurolab::where('id',1)->first();

        return Inertia::render('PrintMulti/IndexHpv',
            [
            'billtests'=>$billtests,
            'testElements'=>$testElements,
            'ouread'=>Ouread::where('asign_hpv',1)->first(),
            'eurolab'=>$eurolab,
            ]
        );
    }
    public function printCode(Request $rq){

        $keys = collect($rq->all());
        $ids = $keys->keys();
        $billtests = Billtest::whereIn('id',$ids)->with('custommer')
        ->where('hpv_code','!=',null)->get();

        return Inertia::render('PrintCode/IndexHpv',
            [
                'billtests'=>$billtests,
            ]
        );
    }
    public function printThin(Request $rq){

        $keys = collect($rq->all());
        $ids = $keys->keys();
        $billtests = Billtest::whereIn('id',$ids)->with('custommer')
        ->where('thinprep_code','!=',null)->get();

        return Inertia::render('PrintCode/IndexThin',
            [
                'billtests'=>$billtests,
            ]
        );
    }



}