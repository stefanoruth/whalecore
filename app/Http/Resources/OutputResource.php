<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class OutputResource extends Resource
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
            'data' => $this->body,
            'seo' => data_get($this->meta, 'seo'),
        ];
    }
}
