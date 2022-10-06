<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Custommer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function billtest(){
       return $this->hasOne(Billtest::class);
    }

    public function province()
    {

     // dd($this->hasOne(Province::class,'code','province_id'));
     return $this->hasOne(Province::class,'code','province_id');
    }

    public function district()
    {

      return $this->hasOne(District::class,'code','district_id');
    }

    public function ward(){

      return $this->hasOne(Ward::class,'code','ward_id');
    }


}
