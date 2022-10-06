<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Menu;
use App\Models\MenuUser;

use Inertia\Inertia;
use App\Http\Resources\RoleResource;
use App\Http\Resources\MenuResource;
use App\Http\Requests\SaveRoleRequest;

class MenuPermisionController extends Controller
{
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
      
       $user=User::where('id',$id)->select('id','name')->get();
       $menus=MenuResource::collection(Menu::select('id','name','id_parent')->get());
       $menuedits=MenuUser::where('id_user',$id)->select('id_menu')->get();
       $arrays=[];
       if($menuedits){
        foreach($menuedits as $object)
        {
            $arrays[] = $object->id_menu;
        }
       }
        
            // Dump array with object-arrays
            //dd($arrays);
       return Inertia::render('Admin/User/CreateMenu',[
           'edit'=>true,
           'menus'=>$menus,
           'userRole'=>$user,
           'menuedits'=>$arrays,
           
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      //dd($request->all());
      MenuUser::where('id_user',$request->id_user)->delete();
      $data=[];
      foreach($request->menuSelected as $menu_id){
          $data[]=[
              'id_user'=>$request->id_user,
              'id_menu'=>$menu_id,
              'created_at'=>date('Y-m-d H:i:s'),    
              'updated_at'=>date('Y-m-d H:i:s'),    
          ];
      }
      //dd($data);
      MenuUser::insert($data);
      return redirect()->route('users.index')->with('success','Create permission successfully!');
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
