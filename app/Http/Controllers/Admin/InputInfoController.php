<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Response;

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
use App\Models\Result;
use App\Http\Requests\SaveinforRequest;
use App\Http\Requests\SaveCustommerRequest;

use App\Http\Resources\TestnameResource;
use App\Http\Resources\ProvinceResource;
use App\Http\Resources\DistrictResource;
use PHPUnit\Exception;
use Illuminate\Support\Facades\Log;
use DB;
use Carbon\Carbon;
use \Illuminate\Support\Str;

class InputInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //dd($request->all());>with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results','usercreate','userupdate'])->orderBy('id','desc')->paginate($perpage)->withQueryString()
        $perpage = $request->perPage?$request->perPage:50;
        $ousentFill=$request->ousentFill;
        $readcodeFill=$request->readcodeFill;
        $nametestFill=$request->nametestFill;
        $readCode = $request->chooseReadCode;

        $startDate=$request->startDate;
        $endDate=$request->endDate;
        $currentDate = Carbon::now()->toDateString();
        $two_Year =  substr(Carbon::now()->year,2);
        //dd($two_Year);
        $tenDateAgo = Carbon::now()->subDays(10)->toDateString();

        $query = "";
        $billtests = "";

        if (request('term')) {
            $query = Billtest::query();
         $query
             ->where('hpv_code', 'like', '%' . request('term') . '%')
             ->orWhere('thinprep_code', 'like', '%' . request('term') . '%');
        }
        //Null All==============
        if(!$ousentFill && !$readcodeFill&& !$nametestFill && !$startDate && !$endDate){
            $billtests=Billtest::WhereDate('created_at',$currentDate)
            ->with(['custommer','doctor','ousent','testnames','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        //ousentFill========================================

        if($ousentFill && (!$readcodeFill && !$nametestFill && !$startDate && !$endDate)){
            $billtests=Billtest::where('ousent_id',$ousentFill)
            ->with(['custommer','doctor','ousent','testnames','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && $readcodeFill && (!$nametestFill && !$startDate && !$endDate)){
            $billtests=Billtest::where('ousent_id',$ousentFill)
            ->where('read_code',$readcodeFill)
            ->with(['custommer','doctor','ousent','testnames','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && $readcodeFill && $nametestFill && (!$startDate && !$endDate)){
            $billtests=Billtest::where('ousent_id',$ousentFill)
            ->where('read_code',$readcodeFill)
            ->whereHas('testnames', function($qr) use($nametestFill){
                $qr->where('testname_id', $nametestFill);
            })->with('testnames')
            ->with(['custommer','doctor','ousent','testnames','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && $startDate && $endDate && (!$readcodeFill && !$nametestFill )){
            $billtests=Billtest::where('ousent_id',$ousentFill)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->with(['custommer','doctor','ousent','testnames','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
         //nametestFill========================================
        if( $nametestFill && !$ousentFill && (!$readcodeFill &&!$startDate && !$endDate)){
            $billtests=Billtest::
            whereHas('testnames', function($qr) use($nametestFill){
                         $qr->where('testname_id', $nametestFill);
                     })->with('testnames')
            ->with(['custommer','doctor','ousent','testnames','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if( $nametestFill && $ousentFill && (!$readcodeFill &&!$startDate && !$endDate)){
            $billtests=Billtest::
            whereHas('testnames', function($qr) use($nametestFill){
                         $qr->where('testname_id', $nametestFill);
                     })->with('testnames')
            ->where('ousent_id',$ousentFill)
            ->with(['custommer','doctor','ousent','testnames','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if( $nametestFill && $readcodeFill && (!$ousentFill &&!$startDate && !$endDate)){
            $billtests=Billtest::
            whereHas('testnames', function($qr) use($nametestFill){
                         $qr->where('testname_id', $nametestFill);
                     })->with('testnames')
            ->where('read_code',$readcodeFill)
            ->with(['custommer','doctor','ousent','testnames','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if( $nametestFill && $startDate && $endDate && (!$ousentFill &&  !$readcodeFill)){
            $billtests=Billtest::
            whereHas('testnames', function($qr) use($nametestFill){
                         $qr->where('testname_id', $nametestFill);
                     })->with('testnames')
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->with(['custommer','doctor','ousent','testnames','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if( $nametestFill && $startDate && $endDate &&  $readcodeFill && !$ousentFill ){
            $billtests=Billtest::
            whereHas('testnames', function($qr) use($nametestFill){
                         $qr->where('testname_id', $nametestFill);
                     })->with('testnames')
            ->where('read_code',$readcodeFill)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->with(['custommer','doctor','ousent','testnames','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        //ReadCode========================================

        if($readcodeFill && (!$ousentFill && !$nametestFill  && !$startDate && !$endDate)){
            $billtests=Billtest::where('read_code',$readcodeFill)
            ->where('read_code',$readcodeFill)
            ->with(['custommer','doctor','ousent','testnames','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if( $readcodeFill  && $startDate && $endDate && (!$nametestFill && !$ousentFill) ){
            $billtests=Billtest::where('read_code',$readcodeFill)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->with(['custommer','doctor','ousent','testnames','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }

        //date_receive========================================

        if( $startDate && $endDate && (!$ousentFill && !$readcodeFill && !$nametestFill)){
            $billtests=Billtest::whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->with(['custommer','doctor','ousent','testnames','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }

        $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
        //dd($billtests);
        $provinces = Province::with('districts','wards')->get();
        $provinces_input = ProvinceResource::collection(Province::get());
        $districts_input = DistrictResource::collection(District::get());
        $districts = District::get();
        $wards = Ward::get();
        $ousents = Ousent::select('id','name','logo')->get();
        $doctors = Doctor::with('ousent')->get();
        $readcodes = Ouread::get();
        // $nametests = Testname::select('id','name')->get();
        $nametests=TestnameResource::collection(Testname::get());

        //$provinces=TestnameResource::collection(Testname::get());

        if(Billtest::where('hpv_code','!=',null)->orderBy('hpv_code', 'desc')->first()){
            $hpv_code_last = Billtest::orderBy('hpv_code', 'desc')->first()->hpv_code +1;
        }
        else{
            $hpv_code_last=$two_Year.'000001';
        }

        if($readCode){
            if(Billtest::where('read_code',$readCode)->first()){
                $getThinCode = Billtest::where('read_code',$readCode)->orderBy('thinprep_code', 'desc')->first()->thinprep_code;
                $getThinCode2 = substr($getThinCode,3) + 1;
                $thin_code_last = $readCode.'_'.+$getThinCode2;
            }
            else{
                $thin_code_last=$readCode.'_'.$two_Year.'000001';
            }

            }
        else {
                $thin_code_last='';
            }


        $filters=[
            'ousentFill'=>$request->ousentFill,
            'nametestFill'=>$request->nametestFill,
            'readcodeFill'=>$request->readcodeFill,
            'startDate'=>$request->startDate,
            'endDate'=>$request->endDate,
            //'chooseReadCodeFill'=>$request->chooseReadCode,
        ];
        return Inertia::render('InputInfo/Index',[
            //'billtests'=>$billtests,
            'billtests'=>$query?fn() => $query->with(['custommer','doctor','ousent','testnames','resulthpvs','results','usercreate','userupdate'])
                        ->orderBy('id','desc')->paginate($perpage)->withQueryString():$billtests,
            'nametests'=> $nametests,
            'testElements'=>$testElements,
            'provinces'=>$provinces,
            'provinces_input'=>$provinces_input,
            'districts_input'=>$districts_input,
            'districts'=>$districts,
            'wards'=>$wards,
            'ousents'=>$ousents,
            'doctors'=>$doctors,
            'readcodes'=>$readcodes,
            'filters'=>$filters,
            'custommer'=>Custommer::with('province')->get(),
            "hpv_code_last"=> $hpv_code_last,
            "thin_code_last"=> $thin_code_last,
            "readCodeEdit"=> $thin_code_last,
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
        //dd($request->all());
       $request->validate([
        'thinprep_code'=>['nullable','unique:billtests,thinprep_code'],
        'hpv_code'=>['nullable','unique:billtests,hpv_code'],
       ]);

        $userCreate = Auth()->user()->id;
        $dateNow = Carbon::now();
        $dateGet = $request->date_receive?$request->date_receive:$dateNow;

        if(request('ousent')){
            $ousentFill = Ousent::where('name', 'like', '%' . request('ousent') . '%')->first();
        }
        else{
            $ousentFill = Ousent::where('id', 1)->first();
        }
        //dd(request('ousent'));
    //     $ousentFill = Ousent::where('name', 'like', '%' . request('ousent') . '%')->first();

    //    $ousentGet =$ousentFill?$ousentFill->id:1;
    //    dd($ousentFill);
        try{
            DB::beginTransaction();
            $data= $request->all();
//name`, `birthday`, `address`, `province_id`, `district_id`, `ward_id`, `gender`, `status`, `phone`, `usercreate_id`, `userupdate_id`,
            $custommer=Custommer::create(
                [
                    'name'=>$request->name,
                    'gender'=>0,
                    'phone'=>$request->phone,
                    'birthday'=>$request->birthday,
                    'address'=>$request->address,
                    'province_id'=>$request->province_id,
                    'district_id'=>$request->district_id,
                    'ward_id'=>$request->ward_id,
                    'userupdate_id'=>$request->userupdate_id,
                ]
            );
            $readCode =   substr ( $request->thinprep_code ,0, 2 );
            $Id_bill=$custommer->billtest()->insertGetId([
                'custommer_id'=>$custommer->id,
                'ousent_id'=>$ousentFill->id,
                'doctor_id'=>$request->doctor_id,
                'doctor_indi'=>$request->doctor_indi,
                'diagnose'=>$request->diagnose,
                'hpv_code'=>$request->hpv_code,
                'thinprep_code'=>$request->thinprep_code,
                'sample_code'=>$request->sample_code,
                'date_receive'=>$dateGet,
                'asign_hide'=>$request->asign_hide,
                'date_sent'=>$request->date_sent,
                'para'=>$request->para,
                'note'=>$request->note,
                'read_code'=>$readCode,
                'sub_read_code'=>$request->sub_read_code,
                'intra'=>$request->intra,
                'hormone'=>$request->hormone,
                'radiation'=>$request->radiation,
                'preg'=>$custommer->preg,
                'result_status'=>1,
                'status'=>1,
                'usercreate_id'=>$userCreate,
                'created_at' => date('Y-m-d H:i:s'),
                ]);
                //dd($bill);
                foreach($request->testname_id as $key=>$value){
                    Billname::insert([
                        'billtest_id'=>$Id_bill,
                        'testname_id'=>$value,
                        'status'=>1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
                $element_id=[26,27,29,44];
                $element_id2=[1,4];
                    if($ousentFill->form_group ==2 ||$ousentFill->form_group ==3 || $ousentFill->form_group ==6){
                        foreach($element_id as $v){
                            Result::insert([
                                'element_id'=>$v,
                                'bill_id'=>$Id_bill,
                                'thinprep_code'=>$request->thinprep_code,
                                'created_at'=>date('Y-m-d H:i:s'),
                                'updated_at'=>date('Y-m-d H:i:s'),
                                ]);
                        }
                    }else
                    foreach($element_id2 as $v){
                        Result::insert([
                            'element_id'=>$v,
                            'bill_id'=>$Id_bill,
                            'thinprep_code'=>$request->thinprep_code,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                            ]);
                    }

            DB::commit();

            $hpv_code_last = Billtest::orderBy('hpv_code', 'desc')->first()->hpv_code +1;
            return back()->withInput()->with([
                'success' => 'Successfully!',
                'hpv_code' => $hpv_code_last,
            ]);
        }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }
    //    return back()->withInput()->back()->with('success','Add  successfully!');
    return redirect()->route('inputinfo.index')->with('success','Add successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request,Billtest $billtest )
    {
       //dd($request->all());
        $getBill = Billtest::where('id',$request->billtest_id)->first();

        if($getBill->thinprep_code==null){
            $data=$request->validate([
                'thinprep_code'=>['nullable','unique:billtests,thinprep_code'],
               ]);
        }
        if($getBill->thinprep_code !== $request->thinprep_code){
            $data=$request->validate([
                'thinprep_code'=>[Rule::unique(Billtest::class)],
               ]);
        }
        if($getBill->hpv_code==null){
            $data=$request->validate([
                'hpv_code'=>['nullable','unique:billtests,hpv_code'],

               ]);
        }

            $sub_thin_code=$request->sub_read_code_null?null:$request->sub_read_code;

            //dd($sub_thin_code);


        $userUpdate = Auth()->user()->id;
        $ousentGet = Ousent::where('name', 'like', '%' . request('ousent') . '%')->first();
      //dd($request->all());
        try{
            DB::beginTransaction();
            $data= $request->all();

            $readCode =   substr ( $request->thinprep_code ,0, 2 );
              //dd($readCode);
            Billtest::where('id',$request->billtest_id)->update([
                'ousent_id'=>$ousentGet->id,
                'doctor_id'=>$request->doctor_id,
                'doctor_indi'=>$request->doctor_indi,
                'diagnose'=>$request->diagnose,
                'hpv_code'=>$request->hpv_code,
                'thinprep_code'=>$request->thinprep_code,
                'sub_read_code'=>$sub_thin_code,
                'sample_code'=>$request->sample_code,
                'date_receive'=>$request->date_receive,
                'date_sent'=>$request->date_sent,
                'note'=>$request->note,
                'para'=>$request->para,
                'asign_hide'=>$request->asign_hide,
                'read_code'=>$readCode,
                'intra'=>$request->intra,
                'hormone'=>$request->hormone,
                'radiation'=>$request->radiation,
                'preg'=>$request->preg,
                'userupdate_id'=>$userUpdate,
                'updated_at' => date('Y-m-d H:i:s'),
                ]);

             Billname::where('billtest_id',$request->billtest_id)->delete();
                foreach($request->testname_id as $key=>$value){
                    Billname::insert([
                        'billtest_id'=>$request->billtest_id,
                        'testname_id'=>$value,
                        'status'=>1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }

            DB::commit();
            return back()->withInput()->with('success','Add successfully!');
        }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }
       return back()->withInput()->back()->with('success','Add  successfully!');
    }
    public function updatebill(Request $request, $id)
    {
           // dd('updateBill');
      // id`, `name`, `birthday`, `address`, `gender`, `ousent_id`, `status`, `created_at`, `updated_at
      $userUpdate = Auth()->user()->id;
      try{
       DB::beginTransaction();
       $data=$request->all();
      $custommerId=Custommer::where('id',$request->custommer_id)->update([
       'name'=>$request->name,
       'birthday'=>$request->birthday,
       'address'=>$request->address,
       'province_id'=>$request->province_id,
       'district_id'=>$request->district_id,
       'ward_id'=>$request->ward_id,
       'gender'=>$request->gender,
       'phone'=>$request->phone,
       'intra'=>$request->intra,
       'hormone'=>$request->hormone,
       'radiation'=>$request->radiation,
       'preg'=>$request->preg,
       'userupdate_id'=>$userUpdate,
       'updated_at'=>date('Y-m-d H:i:s'),
      ]);

       DB::commit();

       }catch(Exception $excepton){
           DB::rollBack();
           Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
       }

       return back()->withInput()->with('success','Add  successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // dd($id);
    }
    public function multidelete(Request $request)
    {

        $keys = collect($request->all());
        $ids = $keys->keys();

        // $IdCustommer=[];

        // $getIdCustommer = Billtest::whereIn('id',explode(",",$ids))->select('custommer_id')->get();
        // foreach($getIdCustommer as $k){
        //     $IdCustommer[]= $k->custommer_id;
        // }

        Billname::whereIn('billtest_id',$ids)->delete();
        Billtest::whereIn('id',$ids)->delete();
        return back()->withInput()->with('success','Add  successfully!');
    }
    public function getOuread(Request $request){

        $readCode = $request->chooseReadCode;
        $two_Year =  substr(Carbon::now()->year,2);
        if($readCode){
            if(Billtest::where('read_code',$readCode)->first()){
                $getThinCode = Billtest::where('read_code',$readCode)->orderBy('thinprep_code', 'desc')->first()->thinprep_code;
                $getThinCode2 = substr($getThinCode,3) + 1;
                $thin_code_last = $readCode.'_'.+$getThinCode2;
            }
            else{
                $thin_code_last=$readCode.'_'.$two_Year.'000001';
            }

            }
        else {
                $thin_code_last='';
            }
        return with($thin_code_last);
    }
}
