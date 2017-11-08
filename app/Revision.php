<?php

namespace App;

use App\Relations\BelongsToSite;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use BelongsToSite;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /** 
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function revisionable()
    {
        return $this->morphTo();
    }
}
