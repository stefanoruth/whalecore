<?php

namespace App;

use App\Relations\BelongsToProject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use BelongsToProject, SoftDeletes;

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    /**
     * Scope
     * @param  [type] $query [description]
     * @param  [type] $type  [description]
     * @return [type]        [description]
     */
    public function scopeType($query, $type)
    {
        return $query->whereHas('template', function ($query) use ($type) {
            $query->whereHas('type', function ($query) use ($type) {
                $query->where('name', $type);
            });
        });
    }
}
