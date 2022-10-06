<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Testelement extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function testname(){
        return $this->belongsTo(Testname::class, 'testname_id')->select('id','name');
    }
    public function testgroup(){

        //return $this->getNameTest->getGroup;
        return $this->hasOneThrough(Labogroup::class,Testname::class,'testnames.group_id','testnames.id')->select('labogroups.id as group_id','labogroups.name as group_name');

    }

    public function valueresult($id_bill)
    {
        $rs = Result::where(['bill_id'=>$id_bill,'element_id'=>$this->id])->first();
        //dd($rs);
        if($rs)
            return $rs->resulttest;
        else
            return '';
    }

}
