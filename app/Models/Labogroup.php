<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labogroup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function testnames(){
        return $this->hasMany(Testname::class,'group_id','id');
    }
    public function testelements(){   
        return $this->hasManyThrough(Testelement::class,Testname::class,'testnames.group_id','id');  
    }
}
