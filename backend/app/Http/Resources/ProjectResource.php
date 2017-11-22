<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\TemplateResource;
use App\Http\Resources\ItemResource;

class ProjectResource extends Resource
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
            'title'         => $this->title,
            'api_key'       => $this->api_key,
            'meta'          => $this->meta,
            'templates'     => TemplateResource::collection($this->whenLoaded('templates')),
            'items'         => ItemResource::collection($this->whenLoaded('items')),
            'language'      => $this->whenLoaded('language'),
        ];
    }
}
