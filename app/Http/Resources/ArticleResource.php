<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'title'=>$this->title,
            'image'=>$this->image,
            'image_url'=>$this->imageUrl(),
            'slug'=>$this->slug,
            'description'=>$this->description,
            'category'=>new CategoryResource($this->whenLoaded('category')),
            //'created_at_for_humans'=>$this->created_at->diffForHumans(),
            'created_at_for_humans'=>$this->when($this->created_at, function(){
                return  $this->created_at->diffForHumans();
            }),
          
        ];
    }
}
