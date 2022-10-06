<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImagethinResource extends JsonResource
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
            'thinprep_code'=>$this->thinprep_code,
            'thinLeft'=>$this->thinLeft,
            'thinRight'=>$this->thinRight,
            'status'=>$this->status,

        ];
    }
}
