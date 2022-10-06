<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Labogroup;
use App\Models\Testname;
use App\Models\Testelement;
use App\Models\Testunit;
use Illuminate\Support\Facades\Log;
use DB;


class TestelementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage=$request->perPage?$request->perPage:50;
        $testName=$request->testName?$request->testName:'all';
      

        if($request->testName && $request->testName !=='all')
        {
        $testElements=Testelement::where('testname_id',$testName)->with(['testname'])->paginate($perPage)->withQueryString();   
        }
        elseif( ($request->elementSearch && $request->testName) ){
            $testElements=Testelement::where('name','like','%'.$request->elementSearch.'%')->with(['testname'])->paginate($perPage)->withQueryString();   
        }
        else{
            $testElements=Testelement::with(['testname'])->paginate($perPage)->withQueryString(); 
        }

        $testUnits=Testunit::get();
        $filtersGet=[
            'testName'=>$request->testName,
            
        ];
        $filters=$filtersGet?$filtersGet:[];
        return Inertia::render('LaboManager/TestElement/Index',[
            'testElements'=>$testElements,
            'testUnits'=>$testUnits,
            'filters'=>$filters,
            'testNames'=>Testname::get(),
            'testGroups'=>Labogroup::get(),
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
        try{
            DB::beginTransaction(); 
            $data= $request->all();             
            Testelement::create($data);
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
    public function update(Request $request, Testelement $testelement)
    {
        try{
            DB::beginTransaction();

            $data=$request->all();

            $testelement->update($data);
            DB::commit();
            return back()->withInput()->with('success','Updated successfully!');
            }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }
       return back()->withInput()->with('success','Update successfully!');    
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
