<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Storage;

class Ousent extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function uploadFolder(): string{
        return "public/Image_Ousent";
    }
    public function imageHeaderFolder(): string{
        return "public/imageHeader_Ousent";
    }
    public function imageFooterFolder(): string{
        return "public/imageFooter_Ousent";
    }

    public function imageUrl(string $column = 'logo'): ?string
    {
        $imageName = $this->$column;
        return $imageName === null
        ? "https://ui-avatars.com/api/?name={$column}&color=7F9CF5&background=EBF4FF"
        : Storage::url("{$this->uploadFolder()}/{$imageName}");
    }
    public function getImage(): ?string
    {
        $imageName = $this->$column;
        return $imageName === null
        ? "https://ui-avatars.com/api/?name={$column}&color=7F9CF5&background=EBF4FF"
        : Storage::url("{$this->uploadFolder()}/{$imageName}");
    }
    public function deleteImage(string $column = 'logo'): void
   {
       $imageName = $this->$column;

       if ($imageName !== null) {
           Storage::delete("{$this->uploadFolder()}/{$imageName}");
       }
   }
    public function deleteImageHeader(string $column = 'image_header'): void
   {
       $imageName = $this->$column;

       if ($imageName !== null) {
           Storage::delete("{$this->imageHeaderFolder()}/{$imageName}");
       }
   }
    public function deleteImageFooter(string $column = 'image_footer'): void
   {
       $imageName = $this->$column;

       if ($imageName !== null) {
           Storage::delete("{$this->imageFooterFolder()}/{$imageName}");
       }
   }


}
