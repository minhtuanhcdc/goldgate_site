<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'hero_description'=>$this->heroDescription(),
            'about_description'=>$this->aboutDescription(),

            'hero_image_url'=>$this->imageUrl('hero_image'),
            'about_image_url'=>$this->imageUrl('about_image'),
            'contact_image_url'=>$this->imageUrl('contact_image'),

            'name'=> $this->name(),
            'address'=> $this->address(),
            'phone'=> $this->phone(),
            'email'=> $this->email(),
            'google_map_url'=> $this->google_map_url(),

        ];
    }
}
