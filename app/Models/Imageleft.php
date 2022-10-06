<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imageleft extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function uploadFolderLeft(): string{
        return "public/ImageThinLeft";
    }
    public function deleteImageLeft(string $column = 'image'): void
    {
        $imageName = $this->$column;

        if ($imageName !== null) {
            Storage::delete("{$this->uploadFolderLeft()}/{$imageName}");
        }
    }

    public function imageright(){
        return $this->hasOne(Imageright::class,'thinprep_code','thinprep_code');
    }


}
