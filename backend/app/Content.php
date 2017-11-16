<?php

namespace App;

use App\Relations\BelongsToProject;
use App\Relations\Revisionable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use BelongsToProject, SoftDeletes;

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
        'body' => 'json',
    ];

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_contents');
    }

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Concerns\belongsToMany
     */
    public function buckets()
    {
        return $this->belongsToMany(Bucket::class, 'bucket_contents');
    }

    /**
     * fetch and query revisions of the model
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function revisions()
    {
        return $this->hasMany(ContentRevision::class);
    }

    /**
     * Boots the Revivision trait
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Create revision on model update.
        static::updating(function ($model) {
            $model->revisions()->create([
                'user_id' => function_exists('auth') && auth()->check() ? auth()->user()->id : null,
                'before'  => array_intersect_key($model->fresh()->toArray(), $model->getDirty()),
                'after'   => $model->getDirty(),
            ]);
        });
    }
}
