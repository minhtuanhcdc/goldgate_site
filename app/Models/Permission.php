<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function permissionsChildrent(){
        return $this->hasMany(Permission::class, 'parent_id');
    }
    public function menus(){
        return $this->belongsTo(Menu::class, 'menu_id')->withDefault();
    }
    public function menuchiles(){
        return $this->belongsTo(Menuchile::class, 'menu_id')->select('id','name');
    }
}
