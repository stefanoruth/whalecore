<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::with('template.type')->type('page')->get();
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

        return Item::create([
            'title'       => request('title'),
            'slug'        => $slug,
            'template_id' => request('template'),
            'project_id'     => session('tenant'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Item::with('template.type')->type('page')->findOrFail($id);
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
        return $request->all();
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
