<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateType extends Model
{
    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function templates()
    {
        return $this->hasMany(Template::class);
    }
}
