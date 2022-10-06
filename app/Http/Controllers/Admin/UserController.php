<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Role;
use App\Http\Resources\UserResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\MenuResource;
use App\Actions\UploadFile;
use App\Http\Requests\SaveUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;
use Illuminate\Support\Facades\DB;
use Auth;

class UserController extends Controller
{
     private $user;
     private $role;
     public function __construct(User $user, Role $role){
        $this->user=$user;
        $this->role=$role;
        //$this->user = User::find(1) ?? new Setting();

    }

     /* Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = $this->user->get();
        //dd($users);
        //$user=User::with(['roles'])->get();
        //dd($users);
       return Inertia::render('Admin/User/index',[
        'can' => [
            'create' => Auth::user()->checkPermissionAccess(config('permissions.access.create-user')),
            'edit' => Auth::user()->checkPermissionAccess(config('permissions.access.edit-user')),
            'delete' => Auth::user()->checkPermissionAccess(config('permissions.access.delete-user')),
            'view' => Auth::user()->checkPermissionAccess(config('permissions.access.list-user')),

        ],
            'users'=>UserResource::collection(User::with(['permissionroles'])->orderBy('id','asc')->paginate(10)),

           'roles'=>RoleResource::collection(Role::select('id','name')->get()),
       ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/User/Create',[
            'edit'=>false,
            'roles'=>RoleResource::collection(Role::select('id','name')->get()),
            'user'=>new UserResource(new User())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUserRequest $request,UploadFile $uploadeFile)
    {
       // dd($request->all());
        try{
            DB::beginTransaction();
            $data=$request->all();
            $data['password']= Hash::make('246357@');
            $data['profile_photo_path']=$uploadeFile->setFile($request->file('profile_photo_path'))
            ->setUploadPath((new User())->uploadFolder())
            ->execute();
;
           $user= User::create($data);
           $user->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('users.index')->with('success','Add User successfully!');
            }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }

       return redirect()->route('users.index')->with('success','Add User successfully!');
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
    public function edit(User $user)
    {

        $roleData=array();
        $roles = $this->role->all();
        $user1=$this->user->find($user->id);
        $roleOfUser= $user1->roles;
            foreach($roleOfUser as $roleselected){
                $roleData[]=$roleselected->id;
          }

        return Inertia::render('Admin/User/Create',[
            'edit'=>true,
            'user'=>new UserResource($user),
            'roles'=>RoleResource::collection(Role::select('id','name')->get()),
            'roleOfUser'=>$roleData
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user, UploadFile $uploadeFile){
   // dd($request->all());
        try{
            DB::beginTransaction();
            $data=$request->all();
            if ($request->file('image')) {
                $user->deleteImage();
            $data['profile_photo_path']=$uploadeFile->setFile($request->file('image'))
            ->setUploadPath((new User())->uploadFolder())
            ->execute();
            }
           $userrole=$user->update($data);
           $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('users.index')->with('success','Add User successfully!');
            }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }
       return redirect()->route('users.index')->with('success','Add User successfully!');
        }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', "User deleted successfully!");
    }
}
