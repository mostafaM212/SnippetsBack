<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SnippetResource extends JsonResource
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
            'my_data'=>$this->isMySnippets(),
            'is_public'=>$this->is_public,
            'steps_count'=>$this->steps->count(),
            'author'=>new PublicUserResource($this->user),
        ];
    }
}
