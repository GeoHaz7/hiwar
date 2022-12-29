<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page = Page::select('page_id', 'title', 'brief', 'description', 'filename', 'status')->leftjoin('images', 'images.image_id', '=', 'pages.feature_image');;


        return DataTables::eloquent($page)
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pages.createPage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        if ($request->hasFile('file')) {
            $id = app('App\Http\Controllers\ImagesController')->store($request)['image_id'];
            // return $id;
        }

        $page = Page::create([
            'title' => $request->pageTitle,
            'brief' => $request->pageBrief,
            'description' => $request->pageDescription,
            'status' => 1,
            'feature_image' => $id,
        ]);

        if ($request->image_array) {
            foreach (explode(',', $request->image_array) as $single) {
                $album_images = new Album();
                $album_images->image_id =  $single;
                $page->album()->save($album_images);
            }
        }

        return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('pages.pages.listPages');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::where('page_id', $id)->first();


        return view('pages.pages.editPage', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::where('page_id', $id)->first();
        $image = Image::where('image_id', $page->feature_image)->first();



        $idd = $page->feature_image;
        if ($request->hasFile('file')) {
            $idd = app('App\Http\Controllers\ImagesController')->store($request)['image_id'];
            if ($image)
                app('App\Http\Controllers\ImagesController')->destroy($image->filename);
        }

        $page->update([
            'title' => $request->pageTitle,
            'brief' => $request->pageBrief,
            'description' => $request->pageDescription,
            'status' => 1,
            'feature_image' => $idd,
        ]);

        // dd($request->all());


        if ($request->image_array) {
            foreach (explode(',', $request->image_array) as $single) {
                $album_images = new Album();
                $album_images->image_id =  $single;
                $page->album()->save($album_images);
            }
        }

        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::where('page_id', $id)->first()->delete();


        return response()->json('success');
    }

    public function switch(Page $page, $id)
    {
        $page = Page::where('page_id', $id)->first();

        $page->update([
            'status' => !$page->status,
        ]);

        return response()->json('success');
    }
}
