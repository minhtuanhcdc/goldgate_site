<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

use App\Models\Menu;
use App\Models\User;
use App\Models\MenuUser;
use App\Models\RoleUser;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
         return array_merge(parent::share($request), [
                'menuPermission' => function() use($request){
                    $user = $request->user();
                    if($user){

                        $menuAccess=RoleUser::where('user_id',auth()->id())
                        ->join('roles','roles.id','role_users.role_id')
                       ->join('permission_role','permission_role.role_id','roles.id')
                       ->join('permissions','permissions.id','permission_role.permission_id')
                        ->join('menus','menus.id','permissions.menu_id')
                        ->select('menus.id as menuId','menus.status as menuStatus','menus.name as menuName','menus.url as Url','menus.parent_id as parent_id')
                        ->where('menus.status','!=',0)
                        ->groupBy('menuId')
                        ->orderBy('menuName','asc')
                        ->get();
                        //dd($menuAccess);
                        return [
                            'menuAccess' =>$menuAccess,
                            //'pemissions' =>$pemissions,
                        ];
                    }

                }

         ]);
     }
}
