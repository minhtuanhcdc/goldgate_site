<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id'=> $this->id,
            'name'=> $this->name,
            'slug'=> $this->slug,
            /*'created_at_for_human'=> $this->created_at->diffForHumans(),*/
            'created_at_for_human'=>$this->when($this->created_at, function(){
                return $this->created_at->diffForHumans();
            }),
        ];
    }
}
