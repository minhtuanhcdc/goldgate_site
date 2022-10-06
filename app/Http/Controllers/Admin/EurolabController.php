<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Eurolab;

use App\Actions\UploadFile;
use PHPUnit\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Storage;

class EurolabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Setting/Eurolab',
        [
        "eurolab"=>Eurolab::get(),

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
        //
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
    public function update(Request $request,Eurolab $eurolab, UploadFile $uploadeFile)
    {
        try{
            DB::beginTransaction();
            $data=$request->all();

            if ($request->file('logo')) {
                $eurolab->deleteImage();
                    $data['logo']=$uploadeFile->setFile($request->file('logo'))
                    ->setUploadPath((new Eurolab())->uploadFolder())
                    ->execute();
             }
            if($request->file('background_hpv')){
                $eurolab->deleteImage2();

                $data['background_hpv']=$uploadeFile->setFile($request->file('background_hpv'))
                ->setUploadPath((new Eurolab())->uploadFolder())
                 ->execute2();

             }
            if($request->file('background_thin')){
                $eurolab->deleteImage3();
                 $data['background_thin']=$uploadeFile->setFile($request->file('background_thin'))
                ->setUploadPath((new Eurolab())->uploadFolder())
                 ->execute3();
            }
            $eurolab=$eurolab->update($data);
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
