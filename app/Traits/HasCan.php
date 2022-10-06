<?php

namespace App\Traits;
use Illuminate\Support\Facades\Gate;
trait HasCan {
    public function getCanAttribute(){
        $currentUser = request()->user(); 
      
        return [
            // 'permissions'=>$permissions,
            // 'view'=>Gate::allows('list-category'),
            // 'create'=>Gate::allows('create-category'),
            // 'update'=>Gate::allows('update-category'),
            // 'delete'=>Gate::allows('delete-category'),
            'view'=>$currentUser->can('update', $this),
            'create'=>$currentUser->can('create', $this),
            'update'=>$currentUser->can('update', $this),
            'delete'=>$currentUser->can('delete', $this),
        ];
    }
}