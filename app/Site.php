<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->hasMany(SiteMember::class);
    }

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
    public function templates()
    {
        return $this->hasMany(Template::class);
    }

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buckets()
    {
        return $this->hasMany(Bucket::class);
    }

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function components()
    {
        return $this->hasMany(Component::class);
    }

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function media()
    {
        return $this->hasMany(Media::class);
    }

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function billing()
    {
        return $this->hasOne(Billing::class);
    }

    /** 
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function defaultLanguage()
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithUsers()
    {
        return $this->with('members.user', 'members.role');
    }
}
