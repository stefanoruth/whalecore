<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function siteUsers()
    {
        return $this->hasMany(SiteUser::class);
    }
}
