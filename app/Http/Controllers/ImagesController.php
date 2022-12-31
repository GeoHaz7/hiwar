<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Image;
use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        if ($request->file('file')) {
            $image = $request->file('file');
            $fileInfo = $image->getClientOriginalName();
            $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
            $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
            $file_name = $filename . '-' . time() . '.' . $extension;
            $image->move(public_path('uploads/gallery'), $file_name);

            $imageUpload = new Image();
            $imageUpload->original_filename = $fileInfo;
            $imageUpload->filename = $file_name;
            $imageUpload->save();

            return  ['image_id' => $imageUpload->image_id];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Images  $images
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Image $images)
    {


        switch ($request->type) {
            case ('page'):
                $images = Page::find($request->id)->album;
                break;

            case ('product'):
                $images = Product::find($request->id)->album;
                break;

            case ('news'):
                $images = News::find($request->id)->album;
                break;

            default:
                return null;
        }
        // $images = Page::find($request->id)->album;


        foreach ($images as $image) {
            $image = $image->images;
            $obj['name'] =  $image->filename;
            $file_path = public_path('uploads/gallery/') . $image->filename;
            $obj['size'] = filesize($file_path);
            $obj['path'] = url('uploads/gallery/' . $image->filename);
            $data[] = $obj;
        }
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Images  $images
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $images)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Images  $images
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $images)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Images  $images
     * @return \Illuminate\Http\Response
     */
    public function destroy($filename)
    {
        // $filename =  $request->get('filename');
        Image::where('filename', $filename)->delete();
        $path = public_path('uploads/gallery/') . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['success' => $filename]);
    }

    public function delete(Request $request)
    {
        $filename =  $request->get('filename');
        Image::where('filename', $filename)->delete();
        $path = public_path('uploads/gallery/') . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['success' => $filename]);
    }
}
