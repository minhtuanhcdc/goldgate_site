<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;


class Ouread extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function uploadFolder(): string{
        return "public/Image_Ouread";
    }
    public function deleteImage(string $column = 'asign'): void
    {
        $imageName = $this->$column;

        if ($imageName !== null) {
            Storage::delete("{$this->uploadFolder()}/{$imageName}");
        }
    }

}
