<?php

namespace App;

use App\Relations\BelongsToSite;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use BelongsToSite, SoftDeletes;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /** 
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buckets()
    {
        return $this->hasMany(Bucket::class);
    }
}
