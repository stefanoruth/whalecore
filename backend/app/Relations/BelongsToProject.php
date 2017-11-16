<?php

namespace App\Relations;

use App\Project;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToProject
{
    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Boots the BelongsToProject trait
     * @return void
     */
    protected static function bootBelongsToProject()
    {
        static::addGlobalScope('project-scope', function (Builder $builder) {
            $builder->where('project_id', session('tenant'));
        });
    }
}