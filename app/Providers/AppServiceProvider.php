<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\Menu;
//use App\Models\User;
use App\Models\MenuUser;
use App\Http\Resources\MenuResource;
use App\Http\Resources\MenuUserResource;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share('flash', function(){
            return [
                'success'=>Session::get('success'),
                'failure'=>Session::get('failure'),
                'hpv_code'=>Session::get('hpv_code'),
            ];

        });
//         Inertia::share('menus', function(){
//             $menu = MenuUserResource::collection(MenuUser::where('id_user',auth()->id())->with(['menus'])->get());
// //dd($menu);
//             return [
//                 'menuparent'=>$menu,
//                 //'menuchile'=>"menuchile"
//             ];

//         });

    }
}
