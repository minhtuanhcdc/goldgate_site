<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Ousent;
use App\Http\Resources\OusentResource;
use App\Http\Requests\SaveOuRequest;
use App\Actions\UploadFile;
use PHPUnit\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Storage;

class OusentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       $perPage = $request->perPage?$request->perPage:10;


       $query = Ousent::query();

       $ousents ="";

       if (request('term')) {
        $query = Ousent::where('name', 'like', '%'.request('term').'%')
            ->orWhere('form_group', 'like', '%' . request('term') . '%')
            //->orWhere('phone_contact', 'like', '%' . request('term') . '%')
            ->paginate($perPage)->withQueryString();
       }
       if(request('term') == null){
        $ousents = Ousent::paginate($perPage)->withQueryString();
       }


       $filters=[
        'perPage'=>$perPage,
    ];

        return Inertia::render('Ousent/Index',[

            'ousents'=>$ousents?$ousents:$query,
            'filters'=>$filters
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
        // $data= $request->all();
        // Ousent::create($data);
        //dd($request->file('logo'));
        try{
            DB::beginTransaction();
            $data=
            [
               'name'=> $request->name,
               'title'=> $request->title,
               'address'=> $request->address,
               'phone'=> $request->phone,
               'phone_contact'=> $request->phone_contact,
               'id_ou'=> $request->id_ou,
               'form_group'=> $request->form_group,
               'website'=> $request->website,
               'logo_view'=> $request->logo_view,
               'asign_view'=> $request->asign_view,

               'address_view'=> $request->address_view,
               'header_view'=> $request->header_view,
               'footer_view'=> $request->footer_view,

               'person_contact'=> $request->person_contact,
            ];
            //$data= $request->all();
            //dd($data);
             $data['logo']=$uploadeFile->setFile($request->file('logo'))
            ->setUploadPath((new Ousent())->uploadFolder())
             ->execute();
             $data['image_header']=$uploadeFile->setFile($request->file('image_header'))
            ->setUploadPath((new Ousent())->imageHeaderFolder())
             ->executeHeader();
             $data['image_footer']=$uploadeFile->setFile($request->file('image_footer'))
            ->setUploadPath((new Ousent())->imageFooterFolder())
             ->executeFooter();

           $ousents= Ousent::create($data);
           //Ousent::create($data);

            DB::commit();
            return redirect()->route('ousents.index')->with('success','Add successfully!');
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
        dd(123);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Ousent $ousent, UploadFile $uploadeFile)
    {
       // dd($request->all());
        //$request->session()->put('url.intended',url()->previous());
        try{
            DB::beginTransaction();
            $data=$request->all();
            // $data=
            // [
            //    'name'=> $request->name,
            //    'address'=> $request->address,
            //    'phone'=> $request->phone,
            //    'id_ou'=> $request->id_ou,
            //    'person_contact'=> $request->person_contact,
            // ];
            if ($request->file('logo')) {
                $ousent->deleteImage();
                    $data['logo']=$uploadeFile->setFile($request->file('logo'))
                    ->setUploadPath((new Ousent())->uploadFolder())
                    ->execute();
            }
            if($request->file('image_header')){
                $ousent->deleteImageHeader();
                $data['image_header']=$uploadeFile->setFile($request->file('image_header'))
                ->setUploadPath((new Ousent())->imageHeaderFolder())
                 ->executeHeader();

            }
            if($request->file('image_footer')){
                $ousent->deleteImageFooter();
                 $data['image_footer']=$uploadeFile->setFile($request->file('image_footer'))
                ->setUploadPath((new Ousent())->imageFooterFolder())
                 ->executeFooter();
            }
            $ousent=$ousent->update($data);
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

        public function destroy(Ousent $ousent)
        {
            //dd($ousent);
            $ousent->deleteImage();
            $ousent->deleteImageHeader();
            $ousent->deleteImageFooter();

            $ousent->delete();
            return back()->withInput()->with('success','Delete successfully!');
        }
        public function deleteLogo($id,UploadFile $uploadeFile ){

            $ousent = Ousent::where('id',$id)->first();
            $ousent->deleteImage();
            Ousent::where('id',$id)->update([
                'logo'=>null,

            ]);
            return back()->withInput()->with('success','Delete successfully!');
        }
        public function deleteHeader($id,UploadFile $uploadeFile ){
            $ousent = Ousent::where('id',$id)->first();
            $ousent->deleteImageHeader();
            Ousent::where('id',$id)->update([
                'image_header'=>null,

            ]);
            return back()->withInput()->with('success','Delete successfully!');
        }
        public function deleteFooter($id,UploadFile $uploadeFile ){
            $ousent = Ousent::where('id',$id)->first();
            $ousent->deleteImageFooter();
            Ousent::where('id',$id)->update([
                'image_footer'=>null,

            ]);
            return back()->withInput()->with('success','Delete successfully!');
        }

}
