<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function ousent(){
        return $this->belongsTo(Ousent::class,'ousent_id')->select('id','name');
    }

}
