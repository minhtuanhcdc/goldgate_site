<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testname extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getGroup()
    {
        //dd( $this->belongsTo(Labogroup::class,'group_id'));

        return $this->belongsTo(Labogroup::class, 'group_id');
    }

    public function elementtests()
    {
        dd($this->hasMany('App\Models\Testelement', 'id_nametest', 'id'));
        return $this->hasMany('App\Models\Testelement', 'id_nametest', 'id');
    }
}
