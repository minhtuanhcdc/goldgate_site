<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
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
use App\Http\Requests\SaveResultRequest;
use App\Http\Resources\TestnameResource;
use DB;
use Carbon\Carbon;


class InputHpvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perpage = $request->perPage?$request->perPage:50;
        $ousentFill=$request->ousentFill;
        $resultFill=$request->resultFill;
        $startDate=$request->startDate;
        $endDate=$request->endDate;
        $currentDate = Carbon::now()->toDateString();
        $tenDateAgo = Carbon::now()->subDays(10)->toDateString();
        $query = '';
        if (request('term')) {
            $query = Billtest::query();
            $query ->where('hpv_code', 'like', '%' . request('term') . '%');
        }
            //Free===================================================================================
        if(!$ousentFill && !$resultFill && !$startDate && !$endDate && !request('term')){
            //dd($currentDate);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->whereDate('date_receive','>=',$tenDateAgo)
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        //==ousentFill =======================
        if($ousentFill  && !$startDate && !$endDate && !$resultFill){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->where('ousent_id',$ousentFill)
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && $startDate && $endDate  && !$resultFill) {
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('ousent_id',$ousentFill)
            ->where('hpv_code','!=',null)
            ->whereDate('date_receive','>=',$request->startDate)
            ->whereDate('date_receive','<=',$request->endDate)
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && $startDate && $endDate  && $resultFill =='--') {
            //dd($resultFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->where('ousent_id',$ousentFill)
            ->whereDate('date_receive','>=',$request->startDate)
            ->whereDate('date_receive','<=',$request->endDate)
            ->where('resultHpv',null)
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && $startDate && $endDate  && $resultFill =='negative') {
            //dd($resultFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->where('ousent_id',$ousentFill)
            ->whereDate('date_receive','>=',$request->startDate)
            ->whereDate('date_receive','<=',$request->endDate)
            ->whereHas('resulthpvs', function($qr){
                $qr->where('element_id',56)->where('result','<',0.5);
            })->with('resulthpvs')
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && $startDate && $endDate  && $resultFill =='positive') {
            //dd($resultFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->where('ousent_id',$ousentFill)
            ->whereDate('date_receive','>=',$request->startDate)
            ->whereDate('date_receive','<=',$request->endDate)
            ->whereHas('resulthpvs', function($qr){
                $qr->where('element_id',56)->where('result','>=',0.5);
            })->with('resulthpvs')
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && !$startDate && !$endDate  && $resultFill =='--') {
            //dd($resultFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->where('ousent_id',$ousentFill)
            ->where('resultHpv',null)
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && !$startDate && !$endDate  && $resultFill =='negative') {
            //dd($resultFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->where('ousent_id',$ousentFill)

            ->whereHas('resulthpvs', function($qr){
                $qr->where('element_id',56)->where('result','<',0.5);
            })->with('resulthpvs')
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && !$startDate && !$endDate  && $resultFill =='positive') {
            //dd($resultFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->where('ousent_id',$ousentFill)
            ->whereHas('resulthpvs', function($qr){
                $qr->where('element_id',56)->where('result','>=',0.5);
            })->with('resulthpvs')
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
        }
        //==startDate && endDate =======================
        if( $startDate && $endDate  && !$resultFill && !$ousentFill){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->whereDate('date_receive','>=',$request->startDate)
            ->whereDate('date_receive','<=',$request->endDate)
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
        }
        if ($startDate && $endDate && $resultFill =='--' && !$ousentFill){
            //dd($resultFill);
             $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
                ->whereDate('date_receive','>=',$request->startDate)
                ->whereDate('date_receive','<=',$request->endDate)
                ->where('resultHpv',null)
                ->orderBy('hpv_code','desc')
                ->paginate($perpage)->withQueryString();
        }
        if($startDate && $endDate && $resultFill == 'negative' && !$ousentFill)
          {
            //dd('negative');
             $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district'])
                    ->where('hpv_code','!=',null)
                    ->whereDate('date_receive','>=',$request->startDate)
                    ->whereDate('date_receive','<=',$request->endDate)
                    ->whereHas('resulthpvs', function($qr){
                        $qr->where('element_id',56)->where('result','<',0.5);
                    })->with('resulthpvs')
                    ->orderBy('hpv_code','desc')
                    ->paginate($perpage)->withQueryString();
        }
        if($startDate && $endDate && $resultFill == 'positive' && !$ousentFill)
          {
            //dd('negative');
             $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district'])
                    ->where('hpv_code','!=',null)
                    ->whereDate('date_receive','>=',$request->startDate)
                    ->whereDate('date_receive','<=',$request->endDate)
                    ->whereHas('resulthpvs', function($qr){
                        $qr->where('element_id',56)->where('result','>=',0.5);
                    })->with('resulthpvs')
                    ->orderBy('hpv_code','desc')
                    ->paginate($perpage)->withQueryString();
        }
        //==resultFill  =======================
        if($resultFill =='--' && (!$ousentFill && !$startDate && !$endDate)){
           //dd($resultFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('resultHpv',null)
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
        }

        //==resultFill  Negative=======================
        if($resultFill == 'negative' && (!$ousentFill && !$startDate && !$endDate)){
           //dd('negative');
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->whereHas('resulthpvs', function($qr){
                $qr->where('element_id',56)->where('result','<',0.5);
            })->with('resulthpvs')
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
        }

        //==resultFill  positive=======================
        if($resultFill == 'positive' && (!$ousentFill && !$startDate && !$endDate)){
           //dd('position');
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->whereHas('resulthpvs', function($qr){
                $qr->where('element_id',56)->where('result','>=',0.5);
            })->with('resulthpvs')
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
        }

        $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
        $testElementsHpv = Testelement::where('testname_id',2)->where('status','!=',0)->where('element_group',20)->select('id','name','element_group')->get();
        //dd($testElementsHpv);
        $ousents = Ousent::select('id','name')->get();
        $readcodes = Ouread::get();
        $doctors = Doctor::select('id','name','ousent_id')->get();
        $filters=[
            'ousentFill'=>$request->ousentFill,
            'perpage'=>$request->perpage,
            'resultFill'=>$request->resultFill,
            'startDate'=>$request->startDate,
            'endDate'=>$request->endDate,
        ];
        return Inertia::render('Result/IndexHpv',[
            'billtests'=>$query?fn()=>$query->with(['custommer','doctor','ousent','testnames','ward','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString():$billtests,
            'ousents'=>$ousents,
            'testElements'=>$testElements,
            'testElementsHpv'=>$testElementsHpv,
            'doctors'=>$doctors,
            'readcodes'=>$readcodes,
            'filters'=>$filters,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        foreach ($request->elment_hpv as $eid=>$value) {
            if($value!==null){
                Result::insert([
                    'bill_id'=>$request->bill_id,
                    'hpv_code'=>$request->hpv_code,
                    'element_id'=>$eid,
                    'result'=>$value,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    ]);
            };
            }
            Billtest::where('hpv_code',$request->hpv_code)->update(
                [
                    'resultHpv'=>1
                ]
                );

        return back()->withInput()->with('success','Add  successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
           // dd($request->all());
       Result::where('hpv_code',$request->hpv_code)->delete();

        foreach ($request->elment_hpv as $eid=>$value) {
            if($value!==null){
                Result::insert([
                    'bill_id'=>$request->bill_id,
                    'hpv_code'=>$request->hpv_code,
                    'element_id'=>$eid,
                    'result'=>$value,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    ]);
            };

    }
    return back()->withInput()->with('success','Update  successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
