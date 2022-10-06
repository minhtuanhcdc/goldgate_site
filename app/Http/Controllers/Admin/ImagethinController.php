<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

use Inertia\Inertia;

use App\Models\Imageleft;
use App\Models\Imageright;
use Storage;
use Str;
use App\Actions\UploadFile;
use Auth;

class ImagethinController extends Controller
{
    public function index()
    {
//dd(Imagethin::get());

        return Inertia::render('Result/UploadImage',[
            'imageviews'=> Imageleft::get(),
        ]);
    }

    public function storeLeft(Request $request,  UploadFile $uploadeFile)
    {
       // dd($request->all());

       if($request->hasFile('files')){
        // $pictures = [];
         foreach($request->file('files') as $file){

            $filename = $file->getClientOriginalName();
             $findImage = Imageleft::where('thinprep_code',substr($filename,0,-4))->first();

             $uploadeFile->setFile($file)
             ->setUploadPath((new Imageleft())->uploadFolderLeft())
              ->executeImgaLeft();

              //$thinprep_code[] = substr($filename,0,-4);
             if($findImage){
                 Imageleft::Where('thinprep_code',substr($filename,0,-4))->update([
                    'thinleft'=>'L_'.$filename
                  ]);
                 }
             else{
                Imageleft::create([
                     'thinprep_code'=>substr($filename,0,-4),
                     'thinleft'=> 'L_'.$filename
                  ]);
             }

          }

        }

        return back()->withInput()->with('success','Add  successfully!');

    }
    public function storeRight(Request $request,  UploadFile $uploadeFile)
    {

        //dd($request->all());
        if($request->hasFile('files')){
            //$pictures = [];
            foreach($request->file('files') as $file){

                $uploadeFile->setFile( $file)
                ->setUploadPath((new Imageright())->uploadFolderRight())
                 ->executeImgaRight();
                $filename = $file->getClientOriginalName();
                //$file->move(public_path('imageThinLeft'),$filename);
                // $pictures[] = $filename;
                // $thinprep_code[] = substr($filename,0,-4);

                $findImage = Imageright::where('thinprep_code',substr($filename,0,-4))->first();

                if($findImage){
                    //Storage::disk('local')->delete('public/ImageThinLeft/'.$findImage->thinleft);
                    Imageright::Where('thinprep_code',substr($filename,0,-4))->update([
                       'thinright'=>'R_'.$filename
                     ]);
                }
                else{
                    Imageright::create([
                        'thinprep_code'=>substr($filename,0,-4),
                        'thinright'=> 'R_'.$filename
                     ]);
                }


             }

        }

        return back()->withInput()->with('success','Add  successfully!');

    }
    public function detroyLeft($id){

//dd($id);



        $dataLeft = Imageleft::where('thinprep_code',$id)->first();
        $dataRight = Imageright::where('thinprep_code',$id)->first();


        //dd($data->thinLeft);

                if($dataLeft)
                {
                    Storage::disk('local')->delete('public/ImageThinLeft/'.$dataLeft->thinleft);
                    //Storage::disk('local')->delete('public/ImageThinRight/'.$data->thinRight);
                    $dataLeft->delete();

                }
                if($dataRight)
                {
                    Storage::disk('local')->delete('public/ImageThinRight/'.$dataRight->thinright);
                    //Storage::disk('local')->delete('public/ImageThinRight/'.$data->thinRight);
                    $dataRight->delete();

                }

                else{
                    return back()->withInput()->with('failure','Can not delete!');
                }


        return back()->withInput()->with('success','Add  successfully!');
    }
}
