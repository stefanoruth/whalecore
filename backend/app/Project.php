<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

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
        'meta' => 'json',
    ];

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->hasMany(ProjectMember::class);
    }

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function users()
    {
        return $this->hasManyThrough(User::class, ProjectMember::class, 'project_id', 'id', 'id', 'user_id');
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
    public function items()
    {
        return $this->hasMany(Item::class);
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
        return $this->hasOne(ProjectBilling::class);
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

    /**
     * Generates a new 40 char api key for the current project.
     * @return \App\Project
     */
    public function generateApiKey()
    {
        do {
            $salt = sha1(time() . mt_rand());
            $key = substr($salt, 0, 40);
        } while (static::where('api_key', $key)->count() > 0);

        $this->api_key = $key;

        return $this;
    }
}
