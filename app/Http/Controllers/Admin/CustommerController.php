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
use PHPUnit\Exception;
use Illuminate\Support\Facades\Log;
use DB;
use \Illuminate\Support\Str;

class CustommerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

            $query
                ->where('thinprep_code', 'like', '%'.request('term').'%')
                ->orWhere('hpv_code', 'like', '%' . request('term') . '%');

           }
        //    whereHas('members',function($query){
        //     $query->where('users.type','beginner');
        // })->with('members')
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
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->where('ousent_id',$ousentFill)
            ->paginate($perpage)->withQueryString();
        }
        if($startDate && $endDate && $readcodeFill){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->where('read_code',$readcodeFill)
            ->paginate($perpage)->withQueryString();
        }
        // else{
        //    // dd($request->perpage);
        // $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])->paginate($perpage)->withQueryString();
        // }
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
        return Inertia::render('Custommer/Index',[
            'billtests'=>$billtests?$billtests:fn()=>$query->with(['sco','custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCustommerRequest $request)
    {
        //dd($request->all());
        $userCreate = Auth()->user()->id;

        //dd($userCreate);

        try{
            DB::beginTransaction();
            $data= $request->all();
            $custommer=Custommer::create($data);

            //$data['custommer_id']=$custommers->id;
            //`id`, `custommer_id`, `ousent_id`, `doctor_id`, `diagonose`,
            // `hpv_code`, `thinprep_code`, `sample_code`, `status`

              $readCode =   substr ( $request->thinprep_code ,0, 4 );
              //dd($readCode);
            $Id_bill=$custommer->billtest()->insertGetId([
                'custommer_id'=>$custommer->id,
                'ousent_id'=>$request->ousent_id,
                'doctor_id'=>$request->doctor_id,
                'diagnose'=>$request->diagnose,
                'hpv_code'=>$request->hpv_code,
                'thinprep_code'=>$request->thinprep_code,
                'sample_code'=>$request->sample_code,
                'date_receive'=>$request->date_re,
                'read_code'=>$readCode,

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


                //custommer_id`, `province_id`, `district_id`, `ward_id
                // Custommeraddress::insert([
                //     'custommer_id'=>$custommer->id,
                //     'province_id'=>$request->province_id,
                //     'district_id'=>$request->district_id,
                //     'ward_id'=>$request->ward_id,
                //     'created_at' => date('Y-m-d H:i:s'),

                // ]);


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
    public function update(Request $request,Custommer $custommer)
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
        Billtest::where('id',$id)->delete();
        Billname::where('billtest_id',$id)->delete();
        //$billtest->delete();
        return back()->withInput()->with('success','Add  successfully!');
    }

}
