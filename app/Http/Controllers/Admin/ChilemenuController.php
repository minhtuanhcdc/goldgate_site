<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Menuchile;
use App\Http\Resources\ChilemenuResource;

class ChilemenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Chilemenu/index',[
            'edit'=>false,
            'chilemenus'=>ChilemenuResource::collection(Menuchile::get()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Chilemenu/Create',[
            'edit'=>false,
            //'menus'=>MenuResource::collection(Menu::select(['id','name'])->get()),
            'chilemenu'=>new ChilemenuResource(new Menuchile())
        ]);
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
       $data = $request->validate([
       
        'name' => ['required', 'string'],
    ]);

        //$data = $request->all();

        Menuchile::create($data);

        return redirect()->route('chilemenus.index')->with('success', 'Add menu successfully!');

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
    public function edit(Menuchile $chilemenu)
    {
        return Inertia::render('Admin/Chilemenu/Create',[
            'edit'=> true,
            'chilemenueEdite'=>new ChilemenuResource($chilemenu),
           
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menuchile $chilemenu)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
        ]);
        //$data=$request->all();
        $chilemenu->update($data);
         return redirect()->route('chilemenus.index')->with('cussess','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menuchile $chilemenu)
    {
        //dd($chilemenu->id);
        $chilemenu->delete();
        return redirect()->route('chilemenus.index')->with('success', 'Delete chile menu successfully');
    }
}
