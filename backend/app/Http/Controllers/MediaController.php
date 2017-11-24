<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\Project;
use App\Http\Resources\MediaResource;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Media::all();


        return MediaResource::collection($media)->additional(['meta' => [
            'mime_types' => $media->pluck('mime_type')->unique(),
        ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = request()->validate([
            'file' => ['required']
        ])['file'];


        $filename = sprintf("%s-%s.%s", pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), time(), $file->getClientOriginalExtension());

        $media = new Media([
            'project_id' => session('tenant'),
            'file_name' => $filename,
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getClientSize(),
            'disk' => 'public',
        ]);

        $project = Project::findOrFail(session('tenant'));

        $path = $file->storeAs($project->id, $filename, 'public');

        $media->save();

        return $media;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Media::findOrFail($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete from disk.

        return Media::where('id', $id)->delete();
    }
}
