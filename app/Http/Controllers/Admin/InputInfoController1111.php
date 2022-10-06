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
use App\Http\Requests\SaveinforRequest;
use App\Http\Requests\SaveCustommerRequest;

use App\Http\Resources\TestnameResource;
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
        $perpage = $request->perPage?$request->perPage:10;
        $ousentFill=$request->ousentFill;
        $readcodeFill=$request->readcodeFill;
        $nametestFill=$request->nametestFill;

        $startDate=$request->startDate;
        $endDate=$request->endDate;
        $currentDate = Carbon::now()->toDateString();

        $query = Billtest::query();
        $billtests = "";

        if (request('term')) {
         $query
             ->where('hpv_code', 'like', '%' . request('term') . '%')
             ->orWhere('thinprep_code', 'like', '%' . request('term') . '%');
        }

        if(!$ousentFill && !$readcodeFill&& !$nametestFill && !$startDate && !$endDate){
            $billtests=Billtest::whereDate('date_receive',$currentDate)
            ->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && (!$readcodeFill && !$nametestFill && !$startDate && !$endDate)){
            $billtests=Billtest::where('ousent_id',$ousentFill)
            ->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && $readcodeFill && (!$nametestFill && !$startDate && !$endDate)){
            $billtests=Billtest::where('ousent_id',$ousentFill)
            ->where('read_code',$readcodeFill)
            ->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill &&  $nametestFill && (!$readcodeFill &&!$startDate && !$endDate)){
            $billtests=Billtest::where('ousent_id',$ousentFill)
            ->whereHas('testnames', function($qr) use($nametestFill){
                         $qr->where('testname_id', $nametestFill);
                     })->with('testnames')
            ->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }

        if(!$ousentFill && $readcodeFill && !$nametestFill  && $startDate && $endDate){
            $billtests=Billtest::where('read_code',$readcodeFill)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && !$readcodeFill && $nametestFill  && $startDate && $endDate){
            $billtests=Billtest::where('ousent_id',$ousentFill)
            ->whereHas('testnames', function($qr) use($nametestFill){
                $qr->where('testname_id', $nametestFill);
            })->with('testnames')
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)

            ->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($ousentFill && $readcodeFill && !$nametestFill  && $startDate && $endDate){
            $billtests=Billtest::where('ousent_id',$ousentFill)
            ->where('read_code',$readcodeFill)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }
        if(!$ousentFill && $readcodeFill && !$nametestFill  && $startDate && $endDate){
            $billtests=Billtest::
            where('read_code',$readcodeFill)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results','usercreate','userupdate'])
            ->orderBy('id','desc')
            ->paginate($perpage)->withQueryString();
        }


        // if($nametestFill && $startDate && $endDate ){
        //     $billtests=Billtest::
        //     whereHas('testnames', function($qr) use($nametestFill){
        //         $qr->where('testname_id', $nametestFill);
        //     })->with('testnames')
        //     ->whereDate('date_receive','>=',$startDate)
        //     ->whereDate('date_receive','<=',$endDate);

        // }
        // if($request->ousentFill && $startDate && $endDate ){
        //     $billtests=Billtest::whereDate('date_receive','>=',$startDate)
        //     ->whereDate('date_receive','<=',$endDate)
        //     ->where('ousent_id',$ousentFill);
        // }
        // if($request->readcodeFill && $request->readcodeFill !=='all'){
        //     $query->where('read_code',$readcodeFill);
        // }
        // if($startDate && $endDate && ($ousentFill && $request->ousentFill !=='all')){
        //     $billtests=Billtest::whereDate('date_receive','>=',$startDate)
        //     ->whereDate('date_receive','<=',$endDate)
        //     ->where('ousent_id',$ousentFill);

        // }
        // if($startDate && $endDate && $readcodeFill && $readcodeFill !=='all'){

        //     $billtests=Billtest::where('read_code',$readcodeFill)
        //     ->whereDate('date_receive','>=',$startDate)
        //     ->whereDate('date_receive','<=',$endDate);

        // }
        // if($startDate && $endDate && $request->ousentFill == null && $nametestFill == null){
        //     $billtests=Billtest::whereDate('date_receive','>=',$startDate)->whereDate('date_receive','<=',$endDate);
        //  }

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
        return Inertia::render('InputInfo/Index',[
            //'billtests'=>$billtests,
            'billtests'=>$billtests?$billtests
                        :fn() => $query->with(['custommer','doctor','ousent','testnames','resulthpvs','results','usercreate','userupdate'])
                        ->orderBy('id','desc')->paginate($perpage)->withQueryString(),
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
    public function store(SaveinforRequest $request)
    {
        $userCreate = Auth()->user()->id;

        //dd($request->all());
        $ousentGet = Ousent::where('name', 'like', '%' . request('ousent') . '%')->first();
        //dd($ousentGet->id);

        try{
            DB::beginTransaction();
            $data= $request->all();
            $custommer=Custommer::create($data);
            $readCode =   substr ( $request->thinprep_code ,0, 2 );
              //dd($readCode);
            $Id_bill=$custommer->billtest()->insertGetId([
                'custommer_id'=>$custommer->id,
                'ousent_id'=>$ousentGet->id,
                'doctor_id'=>$request->doctor_id,
                'diagnose'=>$request->diagnose,
                'hpv_code'=>$request->hpv_code,
                'thinprep_code'=>$request->thinprep_code,
                'sample_code'=>$request->sample_code,
                'date_receive'=>$request->date_receive,
                'para'=>$request->para,
                'note'=>$request->note,
                'read_code'=>$readCode,

                'intra'=>$request->intra,
                'hormone'=>$request->hormone,
                'radiation'=>$request->radiation,
                'preg'=>$custommer->preg,


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


            DB::commit();
            return back()->withInput()->with('success','Add successfully!');
        }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }
       return back()->withInput()->back()->with('success','Add  successfully!');
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
        /**
         *
         *
         *
         */
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
                'sample_code'=>$request->sample_code,
                'date_receive'=>$request->date_receive,
                'note'=>$request->note,
                'para'=>$request->para,
                'asign_view'=>$request->asign_view,
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
            //dd($request->all());
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
}
