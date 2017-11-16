<?php

namespace App;

use App\Relations\BelongsToProject;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class ProjectBilling extends Model
{
    use BelongsToProject, Billable;
        
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
