<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = "menus";
    protected $guarded = ['id'];
    public function users()
    {
        return $this->belongsToMany(User::class);
       //return $this->belongsToMany(User::class, 'menu_users', 'id_menu', 'id_user')->withDefault();
    }
    public function menupermissions(){
       
        return $this->hasMany(User::class,'menu_users', 'id_user','id_menu');
    }

    public function menuChieldent(){
        return $this->belongsToMany(Menu::class,'parent_id');
    }
}
