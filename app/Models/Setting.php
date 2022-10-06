<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;


class Setting extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'data'=>'array',
    ];
    public function uploadFolder(): string{
        return "public/settings";
    }
    public function heroDescription(): ?string {
        return Arr::get($this->data,'hero_description');
    }
    public function heroImageUrl():?String {
       return $this->imageUrl('hero_image');
        
    }
    public function deleteHeroImgage(){
        $imageName = Arr::get($this->data, 'hero_image');
        if($imageName !==null){
            Storage::delete("{$this->uploadFolder()}/{$imageName}");
        }
    }
    public function aboutDescription(): ?string {
        return Arr::get($this->data,'about_description');
    }
    public function aboutImageUrl():?String {
       return $this->imageUrl('about_image');
    }
    public function deleteImgage(string $column): void{
        $imageName = Arr::get($this->data, $column);
        if($imageName !==null){
            Storage::delete("{$this->uploadFolder()}/{$imageName}");
        }
    }
    // public function deleteAboutImgage(){
    //     $imageName = Arr::get($this->data, 'about_image');

    //     if($imageName !==null){
    //         Storage::delete("{$this->uploadFolder()}/{$imageName}");
    //     }
    // }

    public function imageUrl(string $column): ?string
    {
        $imageName = Arr::get($this->data, $column);

        return $imageName === null
            ? "https://ui-avatars.com/api/?name={$column}&color=7F9CF5&background=EBF4FF"
            : Storage::url("{$this->uploadFolder()}/{$imageName}"); 
    }

    public function name(): ?string{
        return Arr::get($this->data, 'name');
    }
    public function address(): ?string{
        return Arr::get($this->data, 'address');
    }
    public function phone(): ?string{
        return Arr::get($this->data, 'phone');
    }
    public function email(): ?string{
        return Arr::get($this->data, 'email');
    }
    public function google_map_url(): ?string{
        return Arr::get($this->data, 'google_map_url');
    }

}
