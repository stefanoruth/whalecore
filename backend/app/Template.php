<?php

namespace App;

use App\Relations\BelongsToSite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'structure' => 'json',
    ];

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
