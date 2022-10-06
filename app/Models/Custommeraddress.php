<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custommeraddress extends Model
{
    use HasFactory;
    protected $table = "custommeraddresses";
    protected $guarded = ['id'];
    //protected $primaryKey = 'custommer_id';
}
