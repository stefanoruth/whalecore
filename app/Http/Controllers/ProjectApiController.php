<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectApiController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return tap(Project::findOrFail(session('tenant')), function ($project) {
            $project->generateApiKey();
            $project->save();
        });
    }
}
