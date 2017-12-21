<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

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
            'title'         => $this->title,
            'api_key'       => $this->api_key,
            'meta'          => $this->meta,
            'templates'     => TemplateResource::collection($this->whenLoaded('templates')),
            'items'         => ItemResource::collection($this->whenLoaded('items')),
            'members'       => MemberResource::collection($this->whenLoaded('members')),
            'language_code' => $this->language_code,
            'language'      => LangResource::make($this->whenLoaded('defaultLanguage')),
            'languages'     => LangResource::collection($this->whenLoaded('languages')),
        ];
    }
}
