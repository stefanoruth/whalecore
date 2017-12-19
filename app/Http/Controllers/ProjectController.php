<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Project;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'language_code' => 'required',
        ]);

        $project = new Project($data);
        $project->generateApiKey();
        $project->save();

        $project->members()->create([
            'role_id' => Role::where('name', 'owner')->firstOrfail()->id,
            'user_id' => auth()->id(),
        ]);
            
        // Create default templates.
        $project->templates()->create([
            'title'     => 'Employee',
            'structure' => json_decode('[{"id": "employees", "dir": "rows", "max": null, "min": 0, "type": "repeater", "title": "Employees", "fields": [{"id": "image", "dir": "rows", "max": null, "min": 0, "type": "image", "title": "Image", "fields": [], "values": [], "default": null, "required": false, "description": null, "placeholder": null}, {"id": "name", "dir": "rows", "max": null, "min": 0, "type": "text", "title": "Name", "fields": [], "values": [], "default": null, "required": false, "description": null, "placeholder": null}, {"id": "jobtitle", "dir": "rows", "max": null, "min": 0, "type": "text", "title": "Title", "fields": [], "values": [], "default": null, "required": false, "description": null, "placeholder": null}, {"id": "email", "dir": "rows", "max": null, "min": 0, "type": "text", "title": "Email", "fields": [], "values": [], "default": null, "required": false, "description": null, "placeholder": null}], "values": [], "default": null, "required": false, "description": null, "placeholder": null}]'),
        ]);

        $project->templates()->create([
            'title'     => 'Standard page',
            'structure' => json_decode('[{"id": "page", "dir": "rows", "max": null, "min": 0, "type": "section", "title": "Page", "fields": [{"id": "title", "dir": "rows", "max": null, "min": 0, "type": "text", "title": "Title", "fields": [], "values": [], "default": null, "required": false, "description": null, "placeholder": null}, {"id": "body", "dir": "rows", "max": null, "min": 0, "type": "text-editor", "title": "Body", "fields": [], "values": [], "default": null, "required": false, "description": null, "placeholder": null}], "values": [], "default": null, "required": false, "description": null, "placeholder": null}, {"id": "seo", "dir": "rows", "max": null, "min": 0, "type": "section", "title": "Seo", "fields": [{"id": "title", "dir": "rows", "max": null, "min": 0, "type": "text", "title": "Seo Title", "fields": [], "values": [], "default": null, "required": false, "description": null, "placeholder": null}, {"id": "description", "dir": "rows", "max": null, "min": 0, "type": "text", "title": "Seo Description", "fields": [], "values": [], "default": null, "required": false, "description": null, "placeholder": null}, {"id": "image", "dir": "rows", "max": null, "min": 0, "type": "image", "title": "Seo Image", "fields": [], "values": [], "default": null, "required": false, "description": null, "placeholder": null}], "values": [], "default": null, "required": false, "description": null, "placeholder": null}]'),
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
            Auth::user()->projects()->with('members.user', 'members.role', 'defaultLanguage', 'languages')->findOrFail(session('tenant'))
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
            $project->languages()->sync(request('languages'));
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
