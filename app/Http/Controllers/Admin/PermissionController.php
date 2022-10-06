<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Permission;
use App\Models\Menu;
use App\Models\Menuchile;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\MenuResource;
use App\Http\Resources\ChilemenuResource;
use DB;

class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('Admin/Permission/Index',
        [
            'permissions'=>PermissionResource::collection(Permission::with(['menus','menuchiles'])->get())

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Permission/Create',[
            'edit'=>false,
            'permissions'=>MenuResource::collection(Menu::where('url','!=','')->select(['id','name'])->get()),
            'chilemenus'=>ChilemenuResource::collection(Menuchile::get()),
            'Permission'=>new PermissionResource(new Permission())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //$menuName =Menu::where('id',$request->menu_id)->select('name')->get();
        //dd($menuName);
        $permision=Permission::create([
            'menu_id'=>$request->menu_id,
            'display_name'=>$request->display_name,
            'parent_id'=>0
        ]);

        foreach($request->menuchile_id as $value){
            Permission::create([
                'menu_id'=>$value,
                'display_name'=>$value,
                'parent_id'=>$permision->id,
                'key_code'=>$request->menu_id.'_'.$value
            ]);
        }
       return redirect()->route('permissions.index')->with('success','Add permission successfully!');
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
    public function edit(Permission $permission)
    {
        return Inertia::render('Admin/Permission/Create',[
            'edit'=>true,
            'permissions'=>MenuResource::collection(Menu::where('url','!=','')->select(['id','name'])->get()),
            'chilemenus'=>ChilemenuResource::collection(Menuchile::get()),
            'Permission'=>new PermissionResource($permission),


        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        // dd($request->all());
         $permission=Permission::create([
            'menu_id'=>$request->menu_id,
            'display_name'=>$request->display_name,
            'parent_id'=>0
        ]);
        foreach($request->menuchile_id as $value){
            Permission::create([
                'menu_id'=>$value,
                'display_name'=>$value,
                'parent_id'=>$permission->id,
                'key_code'=>$request->menu_id.'_'.$value
            ]);
        }
       return redirect()->route('permissions.index')->with('success','Add permission successfully!');
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
