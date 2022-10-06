<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCan;

class Category extends Model
{
    use HasFactory;
    use HasCan;
    protected $appends = [
         'can',
    ];
    

    protected $guarded = ['id'];
   
}
