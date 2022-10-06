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
            'permissions'=>PermissionResource::collection(Permission::get())

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
            'Pemission'=>new PermissionResource(new Permission())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
       // dd($request->all());
        try{
            DB::beginTransaction();
            $data=$request->all();
           $user= Permission::create($data);
           //$user->permissions()->attach($request->permission_id);
            DB::commit();
            return redirect()->route('permissions.index')->with('success','Add role successfully!');
            }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
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
