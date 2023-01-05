<?php

namespace App\Http\Controllers;

use App\Models\VideoAlbum;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VideoAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = VideoAlbum::select('video_id', 'name', 'link');

        return DataTables::eloquent($videos)
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = $request->videoLink;
        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
        $videoLink = substr($url, 0, strpos($url, "&"));



        VideoAlbum::create([
            'name' => $request->videoName,
            'link' => $videoLink,
            'linkShortcut' => $my_array_of_vars['v'],
        ]);

        return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('pages.videos.listVideos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VideoAlbum::where('video_id', $id)->first()->delete();
        return response()->json('success');
    }
}
