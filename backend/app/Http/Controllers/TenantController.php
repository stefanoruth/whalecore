<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectSpecificAreaException;
use App\Project;

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
            'projectId' => 'required',
        ]);

        $project = Project::whereHas('users', function($query){
            $query->where('id', auth()->id());
        })->where('id', request('projectId'))->first();

        if (is_null($project)) {
            throw new ProjectSpecificAreaException("You need to be a part of the project to login" ,403);
        }

        session(['tenant' => $project->id]);
    }
}
