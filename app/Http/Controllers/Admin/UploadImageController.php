<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Actions\UploadFile;
use App\Models\ImageThinprep;
use App\Models\Ouread;
use App\Http\Resources\ImageThinprepResource;

use PHPUnit\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Storage;
use Carbon\Carbon;

use Str;

class UploadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $perpage = $request->perPage?$request->perPage:5;

        $readCode=$request->readCode;
        $startDate=$request->startDate;
        $endDate=$request->endDate;

        $query = ImageThinprep::query();
        $imageviews="";
        $currentDate=Carbon::now();

        if (request('term')) {
            //dd(request('term'));
            $query->where('thinprep_code', 'like', '%'.request('term').'%');
           }
        if($request->readCode && $request->readCode !=='all'){
            $query->where('read_code',$readCode);
        }
        if($request->readCode ==='all'){
            $query->whereDate('created_at',$currentDate);
        }
        if($startDate && $endDate){
            $imageviews=ImageThinprep::
           whereDate('created_at','>=',$startDate)
            ->whereDate('created_at','<=',$endDate)
            ->orderBy('thinprep_code','desc')
            ->paginate($perpage)->withQueryString();
        }
        if($startDate && $endDate && $request->readCode && $request->readCode !=='all'){
            $imageviews=ImageThinprep::
            where('read_code',$readCode)
            ->whereDate('created_at','>=',$startDate)
            ->whereDate('created_at','<=',$endDate)
            ->orderBy('thinprep_code','desc')
            ->paginate($perpage)->withQueryString();
        }

        $filters=[
            'readCode'=>$request->readCode,
            'startDate'=>$request->startDate,
            'endDate'=>$request->endDate,
            'perPage'=>$request->perPage,

        ];

        $oureads = Ouread::get();

        return Inertia::render('Result/UploadImage',[
            'imageviews'=>$imageviews?$imageviews: fn()=>$query->orderBy('thinprep_code','desc')->paginate($perpage)->withQueryString(),
            'oureads'=>$oureads,
            'filters'=>$filters,
        ]);
    }


     /* Show the form for creating a new resource.
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
    public function store(Request $request,  UploadFile $uploadeFile)
    {
        //dd($request->all());

        if($request->hasFile('files')){
            // $pictures = [];
             foreach($request->file('files') as $file){

                $filename = $file->getClientOriginalName();

                $findImageLeft = ImageThinprep::where('thinprep_code',substr($filename,0,-4))->first();

                $findImageRight = ImageThinprep::where('thinprep_code',substr($filename,0,-5))->first();

                 //$readCode =   substr ( $filename ,0, -4 );
                 $imageRight =   substr( $filename ,-5, -4 );

                //dd($findImageRight);
                //$thinprep_code[] = substr($filename,0,-4);
                if( $findImageRight || $findImageLeft){
                                if($findImageRight){

                                    Storage::disk('local')->delete('public/ImageThinRight/'.$findImageRight->thinRight);

                                    ImageThinprep::Where('thinprep_code',substr($filename,0,-5))->update([
                                        'thinRight'=>$filename,
                                        //'read_code'=>$readCode
                                    ]);
                                    $uploadeFile->setFile($file)
                                    ->setUploadPath((new ImageThinprep())->uploadFolderRight())
                                    ->executeImage();
                                }
                                if($findImageLeft){

                                    Storage::disk('local')->delete('public/ImageThinLeft/'.$findImageLeft->thinLeft);

                                    ImageThinprep::Where('thinprep_code',substr($filename,0,-4))->update([
                                        'thinLeft'=>$filename,
                                        //'read_code'=>$readCode
                                    ]);
                                    $uploadeFile->setFile($file)
                                    ->setUploadPath((new ImageThinprep())->uploadFolderLeft())
                                    ->executeImage();
                                }

                            }
                else{
                 if(substr($filename ,-5, -4 ) === "B"){
                     //dd('có B');
                     ImageThinprep::create([
                            'thinprep_code'=>substr($filename,0,-5),
                            'thinRight'=>$filename,
                            'read_code'=>substr ( $filename ,0, 2 )
                            ]);
                    $uploadeFile->setFile($file)
                        ->setUploadPath((new ImageThinprep())->uploadFolderRight())
                        ->executeImage();
                     }
                 else{
                   // dd('Khong có B');
                   ImageThinprep::create([
                    'thinprep_code'=>substr($filename,0,-4),
                    'thinLeft'=>$filename,
                    'read_code'=>substr ( $filename ,0, 2 )
                    ]);
                    $uploadeFile->setFile($file)
                    ->setUploadPath((new ImageThinprep())->uploadFolderLeft())
                    ->executeImage();
                 }
                }
              }

            }

            return back()->withInput()->with('success','Add  successfully!');


    }
    // public function storeRight(Request $request,  UploadFile $uploadeFile)
    // {
    //     if($request->hasFile('files')){
    //         // $pictures = [];
    //          foreach($request->file('files') as $file){

    //             $filename = $file->getClientOriginalName();
    //              $findImage = ImageThinprep::where('thinprep_code',substr($filename,0,-4))->first();
    //              $readCode =   substr ( $filename ,0, 4 );


    //               //$thinprep_code[] = substr($filename,0,-4);
    //              if($findImage){
    //                 Storage::disk('local')->delete('public/ImageThinRight/'.$findImage->thinRight);
    //                 ImageThinprep::Where('thinprep_code',substr($filename,0,-4))->update([
    //                     'thinRight'=>'R_'.$filename,
    //                     'read_code'=>$readCode
    //                   ]);
    //                   $uploadeFile->setFile($file)
    //                   ->setUploadPath((new ImageThinprep())->uploadFolderRight())
    //                    ->executeImgaRight();
    //                  }
    //              else{
    //                 ImageThinprep::create([
    //                      'thinprep_code'=>substr($filename,0,-4),
    //                      'thinRight'=> 'R_'.$filename,
    //                      'read_code'=>$readCode
    //                   ]);
    //                   $uploadeFile->setFile($file)
    //                   ->setUploadPath((new ImageThinprep())->uploadFolderRight())
    //                    ->executeImgaRight();
    //              }

    //           }

    //         }

    //         return back()->withInput()->with('success','Add  successfully!');

    //     //dd($request->all());
    //     // if($request->hasFile('files')){
    //     //     $pictures = [];
    //     //     foreach($request->file('files') as $file){

    //     //         $uploadeFile->setFile( $file)
    //     //         ->setUploadPath((new ImageThinprep())->uploadFolderRight())
    //     //          ->executeImgaRight();
    //     //         $filename = $file->getClientOriginalName();
    //     //         //$file->move(public_path('imageThinLeft'),$filename);
    //     //         $pictures[] = $filename;
    //     //         $thinprep_code[] = substr($filename,0,-4);

    //     //         $findImage = ImageThinprep::where('thinprep_code',substr($filename,0,-4))->first();

    //     //         if($findImage){
    //     //             ImageThinprep::Where('thinprep_code',substr($filename,0,-4))->update([
    //     //                'thinRight'=>'R_'.$filename
    //     //              ]);
    //     //         }
    //     //         else{
    //     //             ImageThinprep::create([
    //     //                 'thinprep_code'=>substr($filename,0,-4),
    //     //                 'thinRight'=> 'R_'.$filename
    //     //              ]);
    //     //         }


    //     //      }

    //     // }

    //     // return back()->withInput()->with('success','Add  successfully!');

    // }

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
        //
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
       $data = ImageThinprep::find($id);

//dd($data->thinLeft);

        if($data)
        {
            Storage::disk('local')->delete('public/ImageThinLeft/'.$data->thinLeft);

            Storage::disk('local')->delete('public/ImageThinRight/'.$data->thinRight);




            $data->delete();
            return back()->withInput()->with('success','Delete  successfully!');
        }
        else{
            return back()->withInput()->with('failure','Can not delete!');
        }

    }
}
