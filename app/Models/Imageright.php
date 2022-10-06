<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imageright extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function uploadFolderRight(): string{
        return "public/ImageThinRight";
    }
    public function deleteImageRight(string $column = 'image'): void
    {
        //dd($column);
        $imageName = $this->$column;

        if ($imageName !== null) {
            Storage::delete("{$this->uploadFolderRight()}/{$imageName}");
        }
    }
}
