<?php

namespace App\Http\Controllers;

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
        })->where('id', request('siteId'))->firstOrFail();

        session(['tenant' => $site->id]);
    }
}
