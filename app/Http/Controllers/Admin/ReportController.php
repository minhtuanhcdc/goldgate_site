<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use \Illuminate\Support\Str;
use PHPUnit\Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use DB;

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

class ReportController extends Controller
{
public function Index(Request $request)
{
    $perpage = $request->perPage?$request->perPage:20;
    $ousentFill=$request->ousentFill;
    $readcodeFill=$request->readcodeFill;
    $startDate=$request->startDate;
    $endDate=$request->endDate;
    $resultHpvFill=$request->resultHpvFill;

    $weekAgo = Carbon::now()->subDays(10)->toDateString();
    //dd($weekAgo);
    $curentDate = Carbon::now()->toDateString();
    $nametestFill=$request->nametestFill;

    $query ='';
    $billtests="";

    if (request('term')) {
        $query = Billtest::query();
        $query
            ->where('thinprep_code', 'like', '%'.request('term').'%')
            ->orWhere('hpv_code', 'like', '%' . request('term') . '%');
       }
//Field Free================================================================================//
    if(!$ousentFill && !$nametestFill && !$readcodeFill && !$startDate && !$endDate){
        $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','results','resulthpvs'])
        ->whereDate('date_receive','>=',$weekAgo)
        ->orderBy('date_receive','desc')
        ->paginate($perpage)->withQueryString();
    }
 //Ousent===================================================================================//
    if($ousentFill && (!$nametestFill && !$readcodeFill && !$startDate && !$endDate) ){
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageLeft','results','resulthpvs'])
        ->where('ousent_id',$ousentFill)
        ->orderBy('date_receive','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($ousentFill && $nametestFill && (!$readcodeFill && !$startDate && !$endDate)){
        $billtests=Billtest::with(['custommer','doctor','testnames','ousent','imageLeft','results','resulthpvs'])
        ->where('ousent_id',$ousentFill)
        ->whereHas('testnames', function($qr) use($nametestFill){
                     $qr->where('testname_id',$nametestFill);
                 })->with('testnames')
        ->orderBy('date_receive','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($ousentFill &&  $readcodeFill && (!$nametestFill && !$startDate && !$endDate)){
        $billtests=Billtest::with(['custommer','doctor','testnames','ousent','imageLeft','results','resulthpvs'])
        ->where('ousent_id',$ousentFill)
        ->where('read_code',$readcodeFill)
        ->orderBy('date_receive','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($ousentFill &&  $readcodeFill  && $startDate && $endDate && !$nametestFill){
        $billtests=Billtest::with(['custommer','doctor','testnames','ousent','imageLeft','results','resulthpvs'])
        ->where('ousent_id',$ousentFill)
        ->where('read_code',$readcodeFill)
        ->whereDate('date_receive','>=',$startDate)
        ->whereDate('date_receive','<=',$endDate)
        ->orderBy('date_receive','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($ousentFill && $nametestFill && $readcodeFill && (!$startDate && !$endDate)){
        $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','results','resulthpvs'])
        ->where('ousent_id',$ousentFill)
        ->whereHas('testnames', function($qr) use($nametestFill){
                     $qr->where('testname_id',$nametestFill);
                 })->with('testnames')
        ->where('read_code',$readcodeFill)
        ->orderBy('date_receive','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($ousentFill && $nametestFill && $readcodeFill && $startDate && $endDate){
        $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','results','resulthpvs'])
        ->where('ousent_id',$ousentFill)
        ->whereHas('testnames', function($qr) use($nametestFill){
                     $qr->where('testname_id',$nametestFill);
                 })->with('testnames')
        ->where('read_code',$readcodeFill)
        ->whereDate('date_receive','>=',$startDate)
        ->whereDate('date_receive','<=',$endDate)
        ->paginate($perpage)->withQueryString();
    }
    if($ousentFill && $startDate && $endDate && (!$nametestFill && !$readcodeFill) ){
        $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','results','resulthpvs'])
        ->where('ousent_id',$ousentFill)
        ->whereDate('date_receive','>=',$startDate)
        ->whereDate('date_receive','<=',$endDate)
        ->orderBy('date_receive','desc')
        ->paginate($perpage)->withQueryString();
    }
   //NametestFill===================================================================================//
    if($nametestFill && (!$ousentFill && !$readcodeFill && !$startDate && !$endDate)){
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageLeft','results','resulthpvs'])
            ->whereHas('testnames', function($qr) use($nametestFill){
                        $qr->where('testname_id',$nametestFill);
                        })->with('testnames')
            ->orderBy('date_receive','desc')
            ->paginate($perpage)->withQueryString();
        }
    if( $nametestFill && $startDate && $endDate && (!$ousentFill&& !$readcodeFill) ){
        $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','results','resulthpvs'])
        ->whereHas('testnames', function($qr) use($nametestFill){
                     $qr->where('testname_id',$nametestFill);
                 })->with('testnames')
        ->whereDate('date_receive','>=',$startDate)
        ->whereDate('date_receive','<=',$endDate)
        ->orderBy('date_receive','desc')
        ->paginate($perpage)->withQueryString();
    }
    //readcodeFill===================================================================================//
    if($readcodeFill && (!$ousentFill && !$nametestFill &&  !$startDate && !$endDate)){
        $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','results','resulthpvs'])
        ->where('read_code',$readcodeFill)
        ->orderBy('date_receive','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($readcodeFill && $ousentFill && (!$nametestFill &&  !$startDate && !$endDate)){
        $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','results','resulthpvs'])
        ->where('read_code',$readcodeFill)
        ->where('ousent_id',$ousentFill)
        ->orderBy('date_receive','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($readcodeFill && $ousentFill &&  $startDate && $endDate && (!$nametestFill )){
        $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','results','resulthpvs'])
        ->where('read_code',$readcodeFill)
        ->where('ousent_id',$ousentFill)
        ->whereDate('date_receive','>=',$startDate)
        ->whereDate('date_receive','<=',$endDate)
        ->orderBy('date_receive','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($readcodeFill  &&  $startDate && $endDate && (!$ousentFill &&!$nametestFill )){
        $billtests=Billtest::with(['custommer','doctor','ousent','imageLeft','results','resulthpvs'])
        ->where('read_code',$readcodeFill)
        ->whereDate('date_receive','>=',$startDate)
        ->whereDate('date_receive','<=',$endDate)
        ->orderBy('date_receive','desc')
        ->paginate($perpage)->withQueryString();
    }
    //Date===================================================================================//
    if( $startDate && $endDate && (!$ousentFill&& !$readcodeFill)){
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageLeft','results','resulthpvs'])
        ->whereDate('date_receive','>=',$startDate)
        ->whereDate('date_receive','<=',$endDate)
        ->orderBy('date_receive','desc')
        ->paginate($perpage)->withQueryString();
    }
    //Resulte===================================================================================//
    if($resultHpvFill =='positive' && (!$ousentFill && !$nametestFill && !$readcodeFill && !$startDate && !$endDate)) {

        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','results','resulthpvs'])
        ->whereHas('resulthpvs', function($qr){
            $qr->where('element_id',56)->where('result','>=',0.5);
        })->with('resulthpvs')
        ->orderBy('hpv_code','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($resultHpvFill =='positive' && $ousentFill && (!$nametestFill && !$readcodeFill && !$startDate && !$endDate)) {
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','results','resulthpvs'])
        ->where('ousent_id',$ousentFill)
        ->whereHas('resulthpvs', function($qr){
            $qr->where('element_id',56)->where('result','>=',0.5);
        })->with('resulthpvs')
        ->orderBy('hpv_code','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($resultHpvFill =='positive' && $ousentFill && $startDate && $endDate && (!$nametestFill && !$readcodeFill )) {
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','results','resulthpvs'])
        ->where('ousent_id',$ousentFill)
        ->whereDate('date_receive','>=',$startDate)
        ->whereDate('date_receive','<=',$endDate)
        ->whereHas('resulthpvs', function($qr){
            $qr->where('element_id',56)->where('result','>=',0.5);
        })->with('resulthpvs')
        ->orderBy('hpv_code','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($resultHpvFill =='negative' && (!$ousentFill && !$nametestFill && !$readcodeFill && !$startDate && !$endDate)) {
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','results','resulthpvs'])
        ->whereHas('resulthpvs', function($qr){
            $qr->where('element_id',56)->where('result','<',0.5);
        })->with('resulthpvs')
        ->where('hpv_code','!=',null)
        ->orderBy('hpv_code','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($resultHpvFill =='negative' && $ousentFill && (!$nametestFill && !$readcodeFill && !$startDate && !$endDate)) {
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','results','resulthpvs'])
        ->where('ousent_id',$ousentFill)
        ->whereHas('resulthpvs', function($qr){
            $qr->where('element_id',56)->where('result','<',0.5);
        })->with('resulthpvs')
        ->where('hpv_code','!=',null)
        ->orderBy('hpv_code','desc')
        ->paginate($perpage)->withQueryString();
    }
    if($resultHpvFill =='negative' && $ousentFill && $startDate && $endDate && (!$nametestFill && !$readcodeFill )) {
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','results','resulthpvs'])
        ->where('ousent_id',$ousentFill)
        ->whereDate('date_receive','>=',$startDate)
        ->whereDate('date_receive','<=',$endDate)
        ->whereHas('resulthpvs', function($qr){
            $qr->where('element_id',56)->where('result','<',0.5);
        })->with('resulthpvs')
        ->where('hpv_code','!=',null)
        ->orderBy('hpv_code','desc')
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
        'nametestFill'=>$request->nametestFill,
        'readcodeFill'=>$request->readcodeFill,
        'startDate'=>$request->startDate,
        'endDate'=>$request->endDate,
        'perPage'=>$request->perPage,
        'resultHpvFill'=>$request->resultHpvFill,
    ];
    return Inertia::render('Report/Index',[
        'billtests'=>$query?fn()=>$query->with(['sco','custommer','doctor','ousent','testnames','imageLeft','results','resulthpvs'])
        ->paginate($perpage)->withQueryString()
        :$billtests,
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


    public function IndexHpv(Request $request)
    {
        $perpage = $request->perPage?$request->perPage:10;
        $ousentFill=$request->ousentFill;
        $startDate=$request->startDate;
        $endDate=$request->endDate;
        $nametest=$request->nametestFill;
        $resultFill=$request->resultFill;
        $dateNow = Carbon::now()->toDateString();
        $query = Billtest::query();
       $billtests="";
        if (request('term')) {
            $query
            ->where('hpv_code', 'like', '%' . request('term') . '%')
            ->with(['sco','custommer','doctor','ousent','testnames','imageLeft','resulthpvs']);
           }

        if($ousentFill  && ($nametest==null && $resultFill == null  && $startDate ==null && $endDate==null)){
            if($ousentFill !='all'){
                $query->where('ousent_id',$ousentFill)
                ->with(['sco','custommer','doctor','ousent','testnames','imageLeft','resulthpvs']);
            }
            else{
                $query
                ->with(['sco','custommer','doctor','ousent','testnames','imageLeft','resulthpvs']);
            }
        }
        if($ousentFill  && $nametest &&  ($resultFill == null  && $startDate ==null && $endDate==null)){
            if($ousentFill !='all'){
                if($nametest !='all'){
                    $query
                    ->where('ousent_id',$ousentFill)
                    ->whereHas('testnames', function($qr) use($nametest){
                        $qr->where('testname_id',$nametest);
                    })->with(['sco','custommer','doctor','ousent','testnames','imageLeft','resulthpvs']);
                }
                else{
                    $query
                    ->where('ousent_id',$ousentFill)
                    ->with(['sco','custommer','doctor','ousent','testnames','imageLeft','resulthpvs']);
                }

            }
            else{
                if($nametest !='all'){
                    $query
                    ->whereHas('testnames', function($qr) use($nametest){
                        $qr->where('testname_id',$nametest);
                    })->with(['sco','custommer','doctor','ousent','testnames','imageLeft','resulthpvs']);
                }
                else{
                    $query
                   ->with(['sco','custommer','doctor','ousent','testnames','imageLeft','resulthpvs']);
                }
            }
         }
        if($ousentFill && $nametest && $resultFill  && ($startDate ==null && $endDate==null)){
            if($ousentFill != 'all'){
                if($nametest != 'all'){
                    if($resultFill == -1)
                    {
                        $query->where('ousent_id',$ousentFill)
                        ->whereHas('testnames', function($qr) use($nametest){
                            $qr->where('testname_id',$nametest);
                        })->with('testnames')
                        ->whereHas('resulthpvs', function($qr){
                            $qr->where('element_id',56)->where('result','<',0.5);
                        })->with('resulthpvs')
                        ->with(['sco','custommer','doctor','ousent','imageLeft']);
                    }
                    if($resultFill == 1)
                    {
                        $query->where('ousent_id',$ousentFill)
                        ->whereHas('testnames', function($qr) use($nametest){
                            $qr->where('testname_id',$nametest);
                        })->with('testnames')
                        ->whereHas('resulthpvs', function($qr){
                            $qr->where('element_id',56)->where('result','>=',0.5);
                        })->with('resulthpvs')
                        ->with(['sco','custommer','doctor','ousent','imageLeft']);
                    }
                    if($resultFill == 2)
                    {

                        $query->where('ousent_id',$ousentFill)
                        ->whereHas('testnames', function($qr) use($nametest){
                            $qr->where('testname_id',$nametest);
                        })->with('testnames')
                        ->whereHas('resulthpvs', function($qr){
                            $qr->where('element_id',56)->where('result',null);
                        })->with('resulthpvs')
                        ->with(['sco','custommer','doctor','ousent','imageLeft']);
                    }
                }
                else{
                    if($resultFill == -1)
                    {
                        $query->where('ousent_id',$ousentFill)

                        ->whereHas('resulthpvs', function($qr){
                            $qr->where('element_id',56)->where('result','<',0.5);
                        })->with('resulthpvs')
                        ->with(['sco','custommer','doctor','ousent','imageLeft','testnames']);
                    }
                    if($resultFill == 1)
                    {
                        $query->where('ousent_id',$ousentFill)

                        ->whereHas('resulthpvs', function($qr){
                            $qr->where('element_id',56)->where('result','>=',0.5);
                        })->with('resulthpvs')
                        ->with(['sco','custommer','doctor','ousent','imageLeft','testnames']);
                    }
                    if($resultFill == 2)
                    {

                        $query->where('ousent_id',$ousentFill)
                        ->whereHas('resulthpvs', function($qr){
                            $qr->where('element_id',56)->where('result',null);
                        })->with('resulthpvs')
                        ->with(['sco','custommer','doctor','ousent','imageLeft','testnames']);
                    }
                }
            }
            else
            {
                if($nametest != 'all'){
                    if($resultFill == -1)
                    {
                        $query
                        ->whereHas('testnames', function($qr) use($nametest){
                            $qr->where('testname_id',$nametest);
                        })->with('testnames')
                        ->whereHas('resulthpvs', function($qr){
                            $qr->where('element_id',56)->where('result','<',0.5);
                        })->with('resulthpvs')
                        ->with(['sco','custommer','doctor','ousent','imageLeft']);
                    }
                    if($resultFill == 1)
                    {
                        $query
                        ->whereHas('testnames', function($qr) use($nametest){
                            $qr->where('testname_id',$nametest);
                        })->with('testnames')
                        ->whereHas('resulthpvs', function($qr){
                            $qr->where('element_id',56)->where('result','>=',0.5);
                        })->with('resulthpvs')
                        ->with(['sco','custommer','doctor','ousent','imageLeft']);
                    }
                    if($resultFill == 2)
                    {
                        $query
                        ->whereHas('testnames', function($qr) use($nametest){
                            $qr->where('testname_id',$nametest);
                        })->with('testnames')
                        ->whereHas('resulthpvs', function($qr){
                            $qr->whereNotIn('element_id',56)->where('result',null);
                        })->with('resulthpvs')
                        ->with(['sco','custommer','doctor','ousent','imageLeft']);
                    }
                }
                else {
                    if($resultFill == -1)
                    {
                        $query
                        ->whereHas('resulthpvs', function($qr){
                            $qr->where('element_id',56)->where('result','<',0.5);
                        })->with('resulthpvs')
                        ->with(['sco','custommer','doctor','ousent','imageLeft','testnames']);
                    }
                    if($resultFill == 1)
                    {
                        $query
                            ->whereHas('resulthpvs', function($qr){
                            $qr->where('element_id',56)->where('result','>=',0.5);
                            })->with('resulthpvs')
                            ->with(['sco','custommer','doctor','ousent','imageLeft','testnames']);
                    }
                    if($resultFill == 2)
                    {
                        $query
                            ->whereHas('resulthpvs', function($qr){
                            $qr->whereNotIn('element_id',56)->where('result',null);
                            })->with('resulthpvs')
                            ->with(['sco','custommer','doctor','ousent','imageLeft','testnames']);
                    }
                }

            }

        }
        if($startDate && $endDate && ($ousentFill == null && $nametest =null)){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageLeft','resulthpvs'])
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->where('hpv_code','!=',null)
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($startDate == null && $endDate == null && $ousentFill==null && $resultFill==null && $nametest==null){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageLeft','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->whereDate('date_receive',$dateNow)
            ->orderBy('hpv_code','desc')
            ->paginate($perpage)->withQueryString();
         }

        $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
        $provinces = Province::with('districts','wards')->get();
        $districts = District::get();
        $wards = Ward::get();
        $ousents = Ousent::select('id','name','logo')->get();
        $doctors = Doctor::with('ousent')->get();
        $nametests=TestnameResource::collection(Testname::whereIn('id',[2,3,4,5])->get());
        $filters=[
            'ousentFill'=>$request->ousentFill,
            'ousentFill'=>$request->ousentFill,
            'resultFill'=>$request->resultFill,
            'startDate'=>$request->startDate,
            'endDate'=>$request->endDate,
        ];
        return Inertia::render('Report/IndexHpv',[
            'billtests'=>$billtests?$billtests:fn()=>$query
                        ->where('hpv_code','!=',null)
                        ->orderBy('hpv_code','desc')
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
    public function IndexThinprep(Request $request)
    {
        $perpage = $request->perPage?$request->perPage:5;
        $ousentFill=$request->ousentFill;
        $readcodeFill=$request->readcodeFill;
        $startDate=$request->startDate;
        $endDate=$request->endDate;
        $nametest=$request->nametestFill;

        $query = Billtest::query();
        $billtests="";

        if (request('term')) {
            $query->where('thinprep_code', 'like', '%'.request('term').'%');
        }
        if($request->ousentFill && $request->ousentFill !=='all'){
            $query->where('ousent_id',$ousentFill);
        }
        if($nametest){
            $query->whereHas('testnames', function($qr) use($nametest){
                $qr->where('testname_id',$nametest);
            })->with('testnames');
        }
        if($nametest && $ousentFill){
            $query
            ->where('ousent_id',$ousentFill)
            ->whereHas('testnames', function($qr) use($nametest){
                $qr->where('testname_id',$nametest);
            })->with('testnames');
        }

        if($request->readcodeFill && $request->readcodeFill !=='all'){
            $query->where('read_code',$readcodeFill);
        }
        if($startDate && $endDate && $ousentFill){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageLeft','results'])
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->where('ousent_id',$ousentFill)
            ->where('thinprep_code','!=',null)
            ->paginate($perpage)->withQueryString();
        }
        if($startDate && $endDate && $readcodeFill){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','imageLeft','results'])
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->where('read_code',$readcodeFill)
            ->where('thinprep_code','!=',null)
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
            'startDate'=>$request->startDate,
            'endDate'=>$request->endDate,

        ];
        return Inertia::render('Report/IndexThinprep',[
            'billtests'=>$billtests?$billtests:fn()=>$query->with(['sco','custommer','doctor','ousent','testnames','imageLeft','results'])
            ->where('thinprep_code','!=',null)
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


}
