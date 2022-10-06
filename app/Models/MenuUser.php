<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class MenuUser extends Model
{
    use HasFactory;
    protected $table = "menu_users";
    protected $guarded = ['id'];

    public function user():BelongsToMany
    {
        return $this->BelongsToMany(User::class,'user_id')->withDefault();;
    }
    public function menus()
    {
        //dd($this->belongsToMany(Menu::class,'id_menu'));
        return $this->belongsTo(Menu::class,'menu_id');
       
    }
}
