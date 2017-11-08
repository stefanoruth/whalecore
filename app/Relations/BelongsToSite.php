<?php

namespace App\Relations;

use App\Site;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToSite
{
    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * Boots the BelongsToSite trait
     * @return void
     */
    protected static function bootBelongsToSite()
    {
        static::addGlobalScope(new SiteScope);
    }
}