<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SaveMenuRequest;
use Inertia\Inertia;
use App\Http\Resources\MenuResource;
use App\Http\Resources\MenuUserResource;
use App\Models\Menu;
use App\Models\MenuUser;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = MenuUserResource::collection(MenuUser::with(['menus'])->get());
//dd($menu);

        return Inertia::render('Admin/Menu/index',[
            'edit'=>false,
            'menus'=>MenuResource::collection(Menu::paginate(10)),
            'hehe'=>$menu

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Menu/Create',[
            'edit'=>false,
            'menus'=>MenuResource::collection(Menu::select(['id','name'])->get()),
            'menu'=>new MenuResource(new Menu())
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveMenuRequest $request)
    {
        $data = $request->all();
       // dd($data);
        Menu::create($data);

        return redirect()->route('menus.index')->with('success', 'Add menu successfully!');

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
    public function edit(Menu $menu)
    {
        return Inertia::render('Admin/Menu/Create',[
            'edit'=> true,
            'menuedit'=>new MenuResource($menu),
            'menus'=>MenuResource::collection(Menu::select(['id','name'])->get()),
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveMenuRequest $request, Menu $menu)
    {
        //dd($request->all());
        $data=$request->all();
        $menu->update($data);
         return redirect()->route('menus.index')->with('cussess','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        dd($menu->id);
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Delete menu successfully');
    }
}
