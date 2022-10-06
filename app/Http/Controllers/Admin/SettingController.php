<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facedes\Storage;

use App\Http\Resources\SettingsResource;
use App\Http\Requests\SaveAboutRequest;
use App\Http\Requests\SaveContactRequest;
use App\Models\Setting;
use App\Actions\UploadFile;

class SettingController extends Controller
{
    private $settings;
    public function __construct(){
        $this->settings = Setting::find(1) ?? new Setting();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
       return Inertia::render('Setting/Create',
       [
            'settings'=> new SettingsResource($this->settings),
       ]
       );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'hero_description'=>['required','string'],
            'hero_image'=>['nullable','image']
        ]);
       //info($request->all());
       $data['hero_description']=$request->get('hero_description');
       if($request->file('hero_image')){
        $this->settings->deleteHeroImgage();

        $imageName=(new UploadFile)
            ->setFile($request->file('hero_image'))
            ->setUploadPath($this->settings->uploadFolder())
            ->execute();

        $data['hero_image']=$imageName;

       }
      $this->save($data);

    return redirect()->back();
    
    }
    public function saveContact(SaveContactRequest $request)
    {
        //dd(123456); 
       //info($request->all());
      
       $data = $request->only(['name','address','email','phone','google_map_url']);

       if($request->file('contact_image')){
        $this->settings->deleteImgage('contact_image');
        $imageName=(new UploadFile)
            ->setFile($request->file('contact_image'))
            ->setUploadPath($this->settings->uploadFolder())
            ->execute();
        $data['contact_image']=$imageName;
       }
        $this->save($data);
        
        return redirect()->back();  
    }
    public function saveAbout(SaveAboutRequest $request)
    {
        //dd("HI"); 
       //info($request->all());
       $data['about_description']=$request->get('about_description');
       if($request->file('about_image')){
        $this->settings->deleteImgage('about_image');
        $imageName=(new UploadFile)
            ->setFile($request->file('about_image'))
            ->setUploadPath($this->settings->uploadFolder())
            ->execute();
        $data['about_image']=$imageName;
       }
        $this->save($data);

        return redirect()->back();  
    }

    private function save(array $data):void{
       
        $this->settings->data=array_merge($this->settings->data, $data);
        $this->settings->save();
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
        //
    }
}
