<?php

namespace App;

use App\Relations\BelongsToSite;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class SiteBilling extends Model
{
    use BelongsToSite, Billable;
        
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
