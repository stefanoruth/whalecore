<?php

namespace App\Http\Controllers;

use App\Http\Resources\MediaResource;
use App\Media;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'types' => $media->pluck('type')->unique()->values(),
        ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $file = request()->validate([
            'file' => ['required'],
        ])['file'];


        $filename = sprintf('%s-%s.%s', Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)), time(), $file->getClientOriginalExtension());

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
