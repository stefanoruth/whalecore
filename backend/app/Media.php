<?php

namespace App;

use App\Relations\BelongsToProject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use BelongsToProject;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'path',
    ];

    /**
     * Generates the public url for the media file.
     * @return string
     */
    public function getPathAttribute()
    {
        return Storage::disk($this->disk)->url(sprintf("%s/%s", $this->project_id, $this->file_name));
    }
}
