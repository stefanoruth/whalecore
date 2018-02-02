<?php

namespace App\Http\Controllers;

use App\Http\Resources\TemplateResource;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TemplateResource::collection(
            Template::orderBy('title', 'ASC')->get()
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
            'title' => ['required',Rule::unique('templates')->where('project_id', session('tenant'))],
        ]);

        return TemplateResource::make(Template::create([
            'title' => request('title'),
            'project_id' => session('tenant'),
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return TemplateResource::make(
            Template::findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = request()->validate([
            'title' => ['required',Rule::unique('templates')->where('project_id', session('tenant'))->ignore($id)],
            'structure' => ['present','array'],
        ]);

        return tap(Template::where('id', $id)->firstOrFail(), function ($template) use ($data) {
            $template->fill($data)->save();
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Template::where('id', $id)->delete();
    }
}
