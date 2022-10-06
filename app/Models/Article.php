<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;
    //protected $fillable = ['title','id'];
   protected $guarded = ['id'];
    public function category():BelongsTo{
        return $this->belongsTo(Category::class, 'id_category')->withDefault();
    }

    public function uploadFolder(): string{
        return "public/Image_articles";
    }

    public function imageUrl(string $column = 'image'): ?string
   {
       //$imageName = Arr::get($this->data, $column);
       $imageName = $this->$column;
       return $imageName === null
           ? "https://ui-avatars.com/api/?name={$column}&color=7F9CF5&background=EBF4FF"
           : Storage::url("{$this->uploadFolder()}/{$imageName}");
   }

   public function deleteImage(string $column = 'image'): void
   {
       $imageName = $this->$column;

       if ($imageName !== null) {
           Storage::delete("{$this->uploadFolder()}/{$imageName}");
       }
   }
}
