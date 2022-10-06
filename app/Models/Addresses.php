<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Addresses extends Model
{
    use HasFactory;
    protected $fillable = ['id_user', 'country'];

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }

}
