<?php

namespace App;

use App\Relations\BelongsToProject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use BelongsToProject, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content';

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
        'meta' => 'json',
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
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Fetch and query revisions of the model
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function revisions()
    {
        return $this->hasMany(ContentRevision::class);
    }

    /**
     * Build public api endpoint
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return sprintf(
            '%s/content/%s/%s/',
            config('app.url_api'),
            $this->item->slug,
            $this->language_code
        );
    }

    /**
     * Fetches the seo information for the content
     *
     * @return object
     */
    public function getSeoAttribute()
    {
        return $this->meta->seo ?? null;
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
