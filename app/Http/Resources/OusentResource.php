<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OusentResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'address'=>$this->address,
            'id_ou'=>$this->id_ou,
            'person_contact'=>$this->person_contact,
            'phone'=>$this->phone,
            'logo'=>$this->logo,
            'image_url'=>$this->imageUrl(),    
        ];
    }
}
