<?php

namespace App\Http\Controllers;

use App\Item;
use App\Http\Resources\ItemResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemResource::collection(
            Item::with('template.type')->when(request('type'), function ($query) {
                $query->type(request('type'));
            })->get()
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
        request()->validate([
            'title'    => 'required',
            'template' => ['required',Rule::exists('templates', 'id')->where('project_id', session('tenant'))],
        ]);


        // Generate slug
        $slug = Str::slug(request('title'));
        $i = 1;
        while (Item::where('slug', $slug)->count() > 0) {
            $slug = Str::slug(request('title')).$i;
            $i++;
        }

        return ItemResource::make(
            Item::create([
                'title'       => request('title'),
                'slug'        => $slug,
                'template_id' => request('template'),
                'project_id'     => session('tenant'),
            ])
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ItemResource::make(
            Item::with('template.type', 'content', 'project.languages', 'project.defaultLanguage')->findOrFail($id)
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
        $data = request()->validate([
            'content' => ['required', 'array'],
        ]);

        // return request('content');

        $item = Item::findOrFail($id);

        foreach ($data['content'] as $langCode => $content) {
            $item->content()->updateOrCreate([
                'project_id' => $item->project_id,
                'language_code' => $langCode,
            ], [
                'body' => $content,
            ]);
        }
        
        return ItemResource::make($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Item::where('id', $id)->delete();
    }
}
