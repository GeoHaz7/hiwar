<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\PhotoAlbum;
use App\Models\Image;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AlbumController extends Controller
{

    public function index()
    {

        $album = Album::select('album_id', 'name', 'filename')
            ->leftjoin('images', 'images.image_id', '=', 'albums.feature_image');

        return DataTables::eloquent($album)
            ->make(true);
    }


    public function create()
    {
        return view('pages.Albums.createAlbum');
    }


    public function store(Request $request)
    {
        $id = null;

        if ($request->hasFile('file')) {
            $id = app('App\Http\Controllers\ImagesController')->store($request)['image_id'];
            // return $id;
        }

        $album = Album::create([
            'name' => $request->albumName,
            'description' => $request->albumDescription,
            'feature_image' => $id,
        ]);

        if ($request->image_array) {
            foreach (explode(',', $request->image_array) as $single) {
                $album_images = new PhotoAlbum();
                $album_images->image_id =  $single;
                $album->album()->save($album_images);
            }
        }

        return response()->json('success');
    }


    public function show()
    {
        return view('pages.albums.listAlbum');
    }


    public function edit(Album $album, $id)
    {
        $album = Album::where('album_id', $id)->first();

        return view('pages.albums.editAlbum', ['album' => $album]);
    }


    public function update(Request $request, Album $album, $id)
    {
        $album = Album::where('album_id', $id)->first();


        $image = Image::where('image_id', $album->feature_image)->first();


        $idd = $album->feature_image;
        if ($request->hasFile('file')) {
            $idd = app('App\Http\Controllers\ImagesController')->store($request)['image_id'];
            if ($image)
                app('App\Http\Controllers\ImagesController')->destroy($image->filename);
        }

        $album->update([
            'name' => $request->albumName,
            'description' => $request->albumDescription,
            'feature_image' => $idd,
        ]);


        if ($request->image_array) {
            foreach (explode(',', $request->image_array) as $single) {
                $album_images = new PhotoAlbum();
                $album_images->image_id =  $single;
                $album->album()->save($album_images);
            }
        }

        return response()->json('success');
    }


    public function destroy(Album $album, $id)
    {
        $album =  Album::where('album_id', $id)->first();

        $album->delete();

        return response()->json('success');
    }
}
