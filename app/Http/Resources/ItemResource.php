<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\ContentResource;

class ItemResource extends Resource
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
            'id'       => $this->id,
            'title'    => $this->title,
            'slug'     => $this->slug,
            'template' => TemplateResource::make($this->whenLoaded('template')),
            'project'  => ProjectResource::make($this->whenLoaded('project')),
            'content'  => ContentResource::collection($this->whenLoaded('content')),
        ];
    }
}
