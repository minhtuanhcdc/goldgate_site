<?php
namespace App\Services;
use Illuminate\Support\Facades\Gate;

class PermissionGatePolicyAccess{
    public function setGatePolicyAccess(){ 
        $this->defindGateCategory();
        $this->defindGateUser();
    }

    public function defindGateCategory(){
        Gate::define('list-category','App\Policies\CategoryPolicy@view');
        Gate::define('create-category','App\Policies\CategoryPolicy@create');
        Gate::define('edit-category','App\Policies\CategoryPolicy@update');
        Gate::define('delete-category','App\Policies\CategoryPolicy@delete');
    }
    public function defindGateUser(){
        Gate::define('list-user','App\Policies\UserPolicy@view');
        Gate::define('create-user','App\Policies\UserPolicy@create');
        Gate::define('edit-user','App\Policies\UserPolicy@update');
        Gate::define('delete-user','App\Policies\UserPolicy@delete');
    }

}