<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user){
        return $user->is_admin;
    }
    public function update(User $user, Menu $menu){
        return $user->is_admin;
    }
    public function delete(User $user, Menu $menu){
        return $user->is_admin;
    }
}
