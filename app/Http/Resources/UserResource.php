<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //dd ($this->whenLoaded('roles'));
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'username'=>$this->username,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'address'=>new AddressResource($this->whenLoaded('address')),
            'permissionroles'=>$this->whenLoaded('permissionroles'),
          
            'profile_photo_path'=>$this->imageUrl(),
            'created_at_forhuman'=>$this->when($this->created_at, function(){
                return $this->created_at->diffForHumans();
            })
        ];
    }
}
