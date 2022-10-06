<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function permissions(){
        //dd(123);
        return $this->belongsToMany(Permission::class,'permission_role', 'role_id','permission_id');
    }
    public function roleuser(){
        return $this->belongsToMany(User::class,'user_role', 'user_id','role_id');
    }



}
