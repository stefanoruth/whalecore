<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Project;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProjectResource::make(
            Project::whereHas('users', function ($query) {
                $query->where('id', auth()->id());
            })->where('id', session('tenant'))->firstOrFail()
        );
    }

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

        $project = Project::whereHas('users', function ($query) {
            $query->where('id', auth()->id());
        })->where('id', request('projectId'))->first();

        if (is_null($project)) {
            throw new \Exception('You need to be a part of the project to login', 403);
        }

        session(['tenant' => $project->id]);

        return ProjectResource::make($project);
    }
}
