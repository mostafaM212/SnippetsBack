<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StepsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid'=>$this->uuid ,
            'title'=>$this->title ?:'' ,
            'body'=>$this->body?:'',
            'order'=>$this->order,
        ];
    }
}
