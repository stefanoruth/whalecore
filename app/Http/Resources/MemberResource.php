<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MemberResource extends Resource
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
            'role'    => $this->role->name,
            'user_id' => $this->user_id,
            'name'    => $this->user->name,
            'email'   => $this->user->email,
        ];
    }
}
