<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $news = News::select('news_id', 'title', 'brief', 'description', 'filename', 'category')->leftjoin('images', 'images.image_id', '=', 'news.feature_image');;


        return DataTables::eloquent($news)
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.news.createNews');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = null;


        if ($request->hasFile('file')) {
            $id = app('App\Http\Controllers\ImagesController')->store($request)['image_id'];
            // return $id;
        }

        $news = News::create([
            'title' => $request->newsTitle,
            'brief' => $request->newsBrief,
            'description' => $request->newsDescription,
            'category' => $request->newsCategory,
            'feature_image' => $id,
        ]);

        if ($request->image_array) {
            foreach (explode(',', $request->image_array) as $single) {
                $album_images = new Album();
                $album_images->image_id =  $single;
                $news->album()->save($album_images);
            }
        }

        return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('pages.news.listNews');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news, $id)
    {
        $news = News::where('news_id', $id)->first();


        return view('pages.news.editNews', ['news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news, $id)
    {
        $news = News::where('news_id', $id)->first();
        $image = Image::where('image_id', $news->feature_image)->first();



        $idd = $news->feature_image;
        if ($request->hasFile('file')) {
            $idd = app('App\Http\Controllers\ImagesController')->store($request)['image_id'];
            if ($image)
                app('App\Http\Controllers\ImagesController')->destroy($image->filename);
        }

        $news->update([
            'title' => $request->newsTitle,
            'brief' => $request->newsBrief,
            'description' => $request->newsDescription,
            'category' => $request->newsCategory,
            'feature_image' => $idd,
        ]);

        // dd($request->all());


        if ($request->image_array) {
            foreach (explode(',', $request->image_array) as $single) {
                $album_images = new Album();
                $album_images->image_id =  $single;
                $news->album()->save($album_images);
            }
        }

        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news, $id)
    {
        News::where('news_id', $id)->first()->delete();


        return response()->json('success');
    }
}
