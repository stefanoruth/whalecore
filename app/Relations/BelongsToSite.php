<?php

namespace App\Relations;

use App\Site;

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
}