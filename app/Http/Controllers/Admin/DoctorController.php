<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Ousent;
use App\Models\Doctor;
use DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage? $request->perPage:5;

        $ousents=Ousent::get();
        $doctors="";

        //$doctors=Doctor::with('ousent')->paginate($perPage);

        if (request('term')) {
            $query = Doctor::where('name', 'like', '%'.request('term').'%')

                //->orWhere('phone', 'like', '%' . request('term') . '%')
                //->orWhere('phone_contact', 'like', '%' . request('term') . '%')
                ->with('ousent')
                ->paginate($perPage)->withQueryString();
           }
           if(request('term') == null){
            $doctors = Doctor::with('ousent')->paginate($perPage)->withQueryString();
           }
           $filters=[
            'perPage'=>$perPage,
        ];

        return Inertia::render('Ousent/IndexDoctor',
            [
            "doctors"=>$doctors?$doctors:$query,
            "ousents"=>$ousents,
            ]
            );
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
            Doctor::create($data);
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
    public function update(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $data= [
                'name' => $request->name,
                'ousent_id' => $request->ousent_id,
                'phone' => $request->phone,
                'title' => $request->title,
                'status' => $request->status,
            ];

            //dd($data);
            Doctor::where('id',$id)->update($data);
            DB::commit();
            return back()->withInput()->with('success','Add successfully!');
        }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }
       return back()->withInput()->back()->with('success','Add  successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->back()->with('success','Delete  successfully!');
    }
}
