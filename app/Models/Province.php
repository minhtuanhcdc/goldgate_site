<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function districts(){
        return $this->hasMany(District::class);
    }
    public function wards(){
        return $this->hasOneThrough( Ward::class,District::class,'province_id','id');

    }
}
