<?php

namespace App\Http\Controllers;

use App\Project;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->middleware('tenancy')->except(['index', 'store']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProjectResource::collection(
            Auth::user()->projects()->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required',
        ]);

        $project = Project::create($data);
        $project->generateApiKey();
        $project->save();

        $project->members()->create([
            'role_id' => Role::where('name', 'owner')->firstOrfail()->id,
            'user_id' => auth()->id(),
        ]);

        return $project;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProjectResource::make(
            Auth::user()->projects()->with('members.user', 'members.role')->findOrFail(session('tenant'))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail(session('tenant'));

        if (request('title')) {
            $project->title = request('title');
        }

        if (request('default_lang')) {
            $project->language_code = request('default_lang');
        }

        if (request('languages')) {
            $project->meta = ['languages' => request('languages')];
        }

        $project->save();

        return ProjectResource::make($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Project::where('id', session('tenant'))->delete();
    }
}
