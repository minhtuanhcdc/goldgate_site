<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Ouread;
use DB;
use Storage;
use App\Http\Requests\SaveOureadRequest;
use App\Actions\UploadFile;
use PHPUnit\Exception;

class OureadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage?$request->perPage:10;

        $ouread = Ouread::paginate($perPage);
        $getOuread = Ouread::select('id','name','read_code')->get();
        if (request('term')) {
            $query = Ouread::where('name', 'like', '%'.request('term').'%')
                ->orWhere('read_code', 'like', '%' . request('term') . '%')
                //->orWhere('phone_contact', 'like', '%' . request('term') . '%')
                ->paginate($perPage)->withQueryString();
           }
           if(request('term') == null){
            $ouread = Ouread::paginate($perPage)->withQueryString();
           }
           $filters=[
            'perPage'=>$perPage,
        ];

        return Inertia::render('ReadSample/Index',[
            'oureads'=>$ouread?$ouread:$query,
            'getOuread'=>$getOuread,
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
    public function store(Request $request, UploadFile $uploadeFile)
    {
        //dd($request->all());
        try{
            DB::beginTransaction();
            $data=
            [
               'name'=> $request->name,
               'read_code'=> $request->read_code,
               'sub_read_code'=> $request->sub_read_code,
               'id_parent'=> $request->id_parent,
               'title'=> $request->title,
               'phone'=> $request->phone,
               'status'=> $request->status,
            ];

           //Ousent::create($data);
           $data['asign']=$uploadeFile->setFile($request->file('asign'))
           ->setUploadPath((new Ouread())->uploadFolder())
            ->execute();
            $ousents= Ouread::create($data);
            DB::commit();
            return redirect()->back()->with('success','Add  successfully!');
            }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }

       return redirect()->back()->with('success','Add  successfully!');
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
    public function update(Request $request, Ouread $ouread,UploadFile $uploadeFile)
    {
        try{
            DB::beginTransaction();
            $data=$request->all();
            if ($request->file('asign')) {
                $ouread->deleteImage();
                    $data['asign']=$uploadeFile->setFile($request->file('asign'))
                    ->setUploadPath((new Ouread())->uploadFolder())
                    ->execute();
            }
            $ouread->update($data);
            DB::commit();
            return back()->withInput()->with('success','Updated successfully!');
            }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }
       return back()->withInput()->with('success','Update successfully!');
       //return back()->withInput()->with('success','Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ouread $ouread)
    {
       // dd($id);
       $ouread->deleteImage();
        $ouread->delete();
        return redirect()->back()->with('success','Delete  successfully!');
    }
}
