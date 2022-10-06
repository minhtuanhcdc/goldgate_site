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

        $currentDate=Carbon::now();
        $startDate=$request->startDate;
        $endDate=$request->endDate;

        $query = Billtest::query();
        $billtests="";

        if (request('term')) {
            dd(request('term'));
            $query->where('thinprep_code', 'like', '%'.request('term').'%');
           }

        if($ousentFill && $request->ousentFill !=='all'){
           // dd($request->ousentFill);
           $query->where('ousent_id',$ousentFill);
                //dd($billtests);
        }

        if($request->readcodeFill && $request->readcodeFill !=='all'){
            $query->where('read_code',$readcodeFill);
            //$billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageleft','results'])->where('thinprep_code','!=',null)->where('read_code',$readcodeFill)->paginate($perpage)->withQueryString();
                //dd($billtests);
        }
        if($startDate && $endDate){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageleft','results'])
            ->where('thinprep_code','!=',null)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)

            ->paginate($perpage)->withQueryString();
        }
        if($startDate && $endDate && ($ousentFill && $request->ousentFill !=='all')){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageleft','results'])
            ->where('thinprep_code','!=',null)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->where('ousent_id',$ousentFill)
            ->paginate($perpage)->withQueryString();
        }
        if($startDate && $endDate && ($request->readcodeFill && $request->readcodeFill !=='all')){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageleft','results'])
            ->where('thinprep_code','!=',null)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->where('read_code',$readcodeFill)
            ->paginate($perpage)->withQueryString();
        }
         else{

           //$query->whereDate('date_receive',$currentDate);


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

            'billtests'=>$billtests?$billtests: fn()=>$query
                        ->with(['custommer','doctor','ousent','testnames','district','ward','imageleft','results','doctorread'])->where('thinprep_code','!=',null)
                        ->paginate($perpage)->withQueryString(),
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
        ]);
    }
    public function printHpv(Request $request){
        $perpage = $request->perPage?$request->perPage:10;
        $ousentFill=$request->ousentFill;
        $readcodeFill=$request->readcodeFill;
        $startDate=$request->startDate;
        $endDate=$request->endDate;

        $query = Billtest::query();
        $billtests="";

        $currentDate=Carbon::now();

        if (request('term')) {
            //dd(request('term'));
            $query->where('hpv_code', 'like', '%'.request('term').'%');
           }

        if($request->ousentFill && $request->ousentFill !=='all'){
            $query->where('ousent_id',$ousentFill);
        }
        if($request->ousentFill ==='all'){
            $query->whereDate('date_receive',$currentDate);
        }
        if($startDate && $endDate){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->paginate($perpage)->withQueryString();
        }
        if($startDate && $endDate && $ousentFill){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->where('ousent_id',$ousentFill)
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
            'endDate'=>$request->endDate

        ];
        return Inertia::render('PrintResult/IndexHpv',[
            'billtests'=>$billtests?$billtests: fn()=>$query->with(['custommer','doctor','ousent','testnames','district','ward','resulthpvs'])
                        ->where('hpv_code','!=',null)
                        ->paginate($perpage)->withQueryString(),
            'nametests'=> $nametests,
            'testElements'=>$testElements,
            'provinces'=>$provinces,
            'districts'=>$districts,
            'wards'=>$wards,
            'ousents'=>$ousents,
            'doctors'=>$doctors,
            'filters'=>$filters,
            'custommer'=>Custommer::with('province')->get(),
        ]);
    }

    public function printMutiThin(Request $rq){

        $keys = collect($rq->all());
        $ids = $keys->keys();

        $billGroup_1 = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','district','ward','imageleft','results'])

                    ->whereHas('ousent', function($qr){
                      $qr->where('form_group',1);
                    })->with('ousent')
                    ->get();
        $billGroup_2 = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','district','ward','imageleft','results'])

                    ->whereHas('ousent', function($qr){
                      $qr->where('form_group',2);
                    })->with('ousent')
                    ->get();
        $billGroup_3 = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','district','ward','imageleft','results'])

                    ->whereHas('ousent', function($qr){
                      $qr->where('form_group',3);
                    })->with('ousent')
                    ->get();
        $billGroup_4 = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','district','ward','imageleft','results'])

                    ->whereHas('ousent', function($qr){
                      $qr->where('form_group',4);
                    })->with('ousent')
                    ->get();
        $billGroup_5 = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','district','ward','imageleft','results'])

                    ->whereHas('ousent', function($qr){
                      $qr->where('form_group',5);
                    })->with('ousent')
                    ->get();
        // $billGroup_General = Billtest::whereIn('id',$ids)->with(['custommer','doctor','doctorread','ousent','testnames','district','ward','imageleft','results'])
        //             ->whereHas('ousent', function($qr){
        //               $qr->whereNotIn('form_group', [1,2,3,4,5]);
        //             })->with('ousent')
        //             ->get();

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
               // 'billGroup_General'=>$billGroup_General,

            ]
        );
    }

    public function printMutiHpv(Request $rq){

        $keys = collect($rq->all());
        $ids = $keys->keys();
//dd($ids);
        $billtests = Billtest::whereIn('id',$ids)->with(['custommer','doctor','ousent','testnames','district','ward','imageleft','resulthpvs'])
                    ->where('hpv_code','!=',null)->get();

        $testElements = Testelement::where('testname_id',1)->where('status','!=',0)->select('id','name','element_group')->get();

        return Inertia::render('PrintMulti/IndexHpv',
            [
            'billtests'=>$billtests,
            'testElements'=>$testElements,
            ]
        );
    }



}
