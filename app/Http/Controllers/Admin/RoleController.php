<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Menu;
use App\Models\MenuUser;
use App\Models\Permission;
use DB;
use Str;
use Inertia\Inertia;
use App\Http\Resources\RoleResource;
use App\Http\Resources\MenuResource;
use App\Http\Resources\PermissionResource;
use App\Http\Requests\SaveRoleRequest;

class RoleController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission){
        $this->permission=$permission;
        $this->role=$role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Role/index',[
            'roles'=>RoleResource::collection(Role::get()),
            //'users'=>$user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return Inertia::render('Admin/Role/AddRole',[
            'edit'=>false,
            'permissions'=>PermissionResource::collection(Permission::with(['menus','menuchiles'])->select(['id','name','menu_id','parent_id'])->get()),
            'role'=>new RoleResource(new Role()),


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


        $data = $request->validate([
            'name' => ['required', 'string'],
            'display_name' => ['required', 'string'],
        ]);
        $role=$this->role->create($data);
       // $this->$role->create($data);
       $role->permissions()->attach($request->menuselected);
        return redirect()->route('roles.index')->with('success', 'Add role successfully!');
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
    public function edit(Role $role)
    {
       //dd($role->id);

        $permisionData=array();
        $rolesper = $this->role->all();

        $role1=$this->role->find($role->id);

        $permissionOfRole= $role1->permissions;
        foreach($permissionOfRole as $roleselected){
            $permisionData[]=$roleselected->id;
          };
        return Inertia::render('Admin/Role/AddRole',[
            'edit'=>true,
            'role'=>new RoleResource($role),
            'permissions'=>PermissionResource::collection(Permission::with(['menus','menuchiles'])->select(['id','name','menu_id','parent_id'])->get()),
            //'permissions'=>PermissionResource::collection(Permission::select(['id','name','parent_id'])->get()),
            'permisionData'=>$permisionData,

        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
       //dd($request->all());

       $role->permissions()->sync($request->menuselected);

        MenuUser::where('user_id',$request->user_id)->delete();
        $data1=[];
        foreach($request->menuParentchecked as $menu_id){
            $data1[]=[
                'user_id'=>$role->id,
                'menu_id'=>$menu_id,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ];
        }
       // dd($data1);
        MenuUser::insert($data1);

        // $data = $request->validate([
        //     'name' => ['required', 'string'],
        //     'display_name' => ['required', 'string'],
        // ]);

        // //$role->update($data);
        // //dd($data);
        // $role=$this->role->update($request->all());

        // $role->permissions()->sync($request->menuselected);

            return redirect()->route('roles.index')->with('success', 'Add role successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', "Role deleted successfully!");
    }
    public function menuAccess($id){
       // dd($id);
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
        return Inertia::render('Admin/Role/Create',[
            'edit'=>true,
            'menus'=>$menus,
            'userRole'=>$user,
            'menuedits'=>$arrays,

        ]);
    }
}
