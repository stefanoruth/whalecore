<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ContentResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'language_code' => $this->language_code,
            'url'           => $this->url,
            'body'          => $this->body,
            'item'          => ItemResource::make($this->whenLoaded('items')),
            'project'       => ProjectResource::make($this->whenLoaded('project')),
        ];
    }
}
