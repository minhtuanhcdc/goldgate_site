<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billname extends Model
{
    use HasFactory;
    protected $table = "billnames";
    protected $guarded = ['id'];

    public function testnames(){
        
    }
}
