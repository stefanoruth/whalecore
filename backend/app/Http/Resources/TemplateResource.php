<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\ItemResource;

class TemplateResource extends Resource
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
            'id'        => $this->id,
            'title'     => $this->title,
            'structure' => $this->structure,
            'type'      => $this->when($this->whenLoaded('type'), function () {
                return $this->type->name;
            }),
            'items'     => ItemResource::collection($this->whenLoaded('items')),
            'project'   => ProjectResource::make($this->whenLoaded('project')),
        ];
    }
}
