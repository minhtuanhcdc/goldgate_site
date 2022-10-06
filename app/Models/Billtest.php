<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billtest extends Model
{
    use HasFactory;
    protected $guarded = ['id','hpv_code'];
    protected $table = "billtests";
    protected $hidden = ['primary_key'];
    public function custommer(){
        return $this->hasOne(Custommer::class,'id','custommer_id')->with(['province','district','ward']);
    }
    public function doctor(){
        return $this->hasOne(Doctor::class,'id','doctor_id')->select('id','name','title');
    }
    public function doctorread(){
        $this->primaryKey = 'read_code';
        return $this->hasOne(Ouread::class,'read_code','read_code');
    }
    public function ousent(){
        return $this->hasOne(Ousent::class,'id','ousent_id');
    }

    public function testnames(){
     //dd($this->belongsTomany(Testname::class,'billnames','billtest_id','testname_id'));
         return $this->belongsTomany(Testname::class,'billnames','billtest_id','testname_id');
    }
    public function results(){
         //dd($this->belongsTomany(Testelement::class,'results','bill_id','element_id')->select('element_id','result'));
        //$this->primaryKey = 'hpv_code';
         return $this->belongsTomany(Testelement::class,'results','bill_id','element_id')->select('element_id','result','name','element_group');
    }
    // public function province(){
    //      //return $this->belongsTomany(Testname::class,'billnames');
    //      return $this->hasOneThrough(Custommeraddress::class,Province::class,'code','custommer_id');
    // }
    // public function district(){
    //     // dd($this->hasOneThrough(District::class,Custommeraddress::class, 'custommer_id','id'));
    //      return $this->hasOneThrough(District::class,Custommeraddress::class, 'district_id','code');
    // }
    // public function ward(){
    //      //return $this->belongsTomany(Testname::class,'billnames');
    //      return $this->hasOneThrough(Ward::class,Custommeraddress::class, 'ward_id','code');
    // }
    public function phone(){
         //return $this->belongsTomany(Testname::class,'billnames');
         return $this->belongsTo(Custommeraddress::class, 'custommer_id','id');
    }
    public function imageleft(){
        //dd($this->belongsTo(ImageThinprep::class, 'thinprep_code','thinprep_code'));
        return $this->belongsTo(ImageThinprep::class, 'thinprep_code','thinprep_code');
   }

    public function cutommerupdate(){
          return $this->hasOne(Custommer::class);
    }
    public function resulthpvs(){
        // dd($this->hasMany(Result::class,'bill_id','id'));
        $this->primaryKey = 'hpv_code';
         return $this->belongsTomany(Testelement::class,'results','hpv_code','element_id')->select('element_id','result');
    }
    public function sco(){
        // dd($this->hasMany(Result::class,'bill_id','id'));
        $this->primaryKey = 'hpv_code';

         $rs = $this->belongsTomany(Testelement::class,'results','hpv_code','element_id')->where('element_id',56)->select('result');

         return $rs;
    }
    public function hpv16(){
        // dd($this->hasMany(Result::class,'bill_id','id'));
        $this->primaryKey = 'hpv_code';

         $rs = $this->belongsTomany(Testelement::class,'results','hpv_code','element_id')->where('element_id',57)->select('result');

         return $rs;
    }
    public function hpv18(){
        // dd($this->hasMany(Result::class,'bill_id','id'));
        $this->primaryKey = 'hpv_code';
         $rs = $this->belongsTomany(Testelement::class,'results','hpv_code','element_id')->where('element_id',58)->select('result');
         return $rs;
    }
    public function ketluan_hpv(){
         //dd($this->hasMany(Result::class,'bill_id','id'));
         $keluan="";
        $this->primaryKey = 'hpv_code';
         $sco = $this->hasMany(Result::class,'hpv_code','hpv_code')->where('element_id',56)->select('result');
         $hpv16 = $this->hasMany(Result::class,'hpv_code','hpv_code')->where('element_id',57)->select('result');
         $hpv18 = $this->hasMany(Result::class,'hpv_code','hpv_code')->where('element_id',58)->select('result');

         $sco_Value = implode('',$sco->pluck('result')->toArray());
         $hpv16_Value = implode('',$hpv16->pluck('result')->toArray());
         $hpv18_Value = implode('',$hpv18->pluck('result')->toArray());

         if($sco_Value >= 0.5){
            if($hpv16_Value >=1 && $hpv18_Value < 1){
                $keluan = "HPV16 dương";
            }
            elseif($hpv16_Value < 1 && $hpv18_Value >= 1){
                $keluan = "Genotype HPV 18 Dương";
            }
            elseif($hpv16_Value >= 1 && $hpv18_Value >= 1){
                $keluan = "HPV16 và HPV18/45 dương";
            }
            else{
                $keluan = "11 Type Dương";
            }

         }
         elseif($sco_Value == null){
            $keluan = "--";
         }
         else{
            $keluan = "Âm tính";
         }
         return $keluan;
    }
    public function ketqua_thin(){
        $keluan_thin="";
        $this->primaryKey = 'thinprep_code';
        //<span v-if="rs.element_group ==5 || rs.element_group ==6 || rs.element_group ==7 || rs.element_group ==13
        //|| rs.element_group ==14|| rs.element_group ==15|| rs.element_group ==16 || rs.element_group ==21" class="text-blue-600">
         //$data = $this->belongsTomany(Testelement::class,'results','thinprep_code','element_id')->select('element_id','result','name');
         $array = $this->belongsTomany(Testelement::class,'results','thinprep_code','element_id')
         ->whereIn('testelements.element_group',[5,6,7,13,14,15,16,21])
         ->select('name');
         //$keluan_thin = implode(',',$datas->pluck('name')->toArray());
        return $array;

    }
    public function usercreate(){
        return $this->hasOne(User::class,'id','usercreate_id');
    }
    public function userupdate(){
        return $this->hasOne(User::class,'id','userupdate_id');
    }

//     public function scopeOusent($query, $request)
// {
//     if ($request->has('ousentFill')) {
//         $query->where('name', 'LIKE', '%' . $request->name . '%');
//     }

//     return $query;
// }


}
