<?php

namespace App\Http\Controllers;

use App\Exceptions\SiteSpecificAreaException;
use App\Site;

class TenantController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * 
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'siteId' => 'required',
        ]);

        $site = Site::whereHas('users', function($query){
            $query->where('id', auth()->id());
        })->where('id', request('siteId'))->first();

        if (is_null($site)) {
            throw new SiteSpecificAreaException("You need to be a part of the site project to login" ,403);
        }

        session(['tenant' => $site->id]);
    }
}
