<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Eurolab extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function uploadFolder(): string{
        return "public/Image_Eurolab";
    }
    public function deleteImage(string $column = 'logo'): void
    {
        $imageName = $this->$column;

        if ($imageName !== null) {
            Storage::delete("{$this->uploadFolder()}/{$imageName}");
        }
    }
    public function deleteImage2(string $column = 'background_hpv'): void
    {
        $imageName = $this->$column;

        if ($imageName !== null) {
            Storage::delete("{$this->uploadFolder()}/{$imageName}");
        }
    }
    public function deleteImage3(string $column = 'background_thin'): void
    {
        $imageName = $this->$column;

        if ($imageName !== null) {
            Storage::delete("{$this->uploadFolder()}/{$imageName}");
        }
    }
}
