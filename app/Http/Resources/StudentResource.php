<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'email'=>$this->email,
            'address'=>$this->address,
            'phone_number'=>$this->phone_number,
            'class_id'=>$this->class_id,
            'section_id'=>$this->section_id,
            'class'=>$this->class,
            'section'=>$this->section,
            // 'class'=>new ClassResource($this->whenLoaded('class')),
            // 'section'=>new SectionResource($this->whenLoaded('section')),

        ];
    }
}
