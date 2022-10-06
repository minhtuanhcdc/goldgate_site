<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Labogroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Storage;

class LabogroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *testNames
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('LaboManager/LaboGroup/Index',[
            
            'labogroups'=>Labogroup::paginate(2)
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
        try{
            DB::beginTransaction(); 
            $data= $request->all();             
            Labogroup::create($data);
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
    public function update(Request $request, Labogroup $labogroup)
    {
        try{
            DB::beginTransaction();

            $data=$request->all();

            $labogroup->update($data);
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
    public function destroy(Labogroup $labogroup)
    {    
        $labogroup->delete();
        return back()->withInput()->with('success', "Delete successfully!");
        
    }
}
