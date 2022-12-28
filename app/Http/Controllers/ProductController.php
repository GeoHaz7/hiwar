<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::select('product_id', 'name', 'price', 'vendor', 'filename', 'status')->leftjoin('images', 'images.image_id', '=', 'pages.feature_image');;


        return DataTables::eloquent($product)
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.products.createProduct');
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

        $product = Product::create([
            'name' => $request->productName,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
            'status' => 1,
            'feature_image' => $id,
            'vendor_id' => $request->vendor_id,
        ]);

        if ($request->image_array) {
            foreach (explode(',', $request->image_array) as $single) {
                $album_images = new Album();
                $album_images->image_id =  $single;
                $product->album()->save($album_images);
            }
        }

        return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('pages.Products.listProducts');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, $id)
    {
        $product = Product::where('product', $id)->first();


        return view('pages.pages.editPage', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, $id)
    {
        $product = Product::where('product_id', $id)->first();
        $image = Image::where('image_id', $product->feature_image)->first();



        $idd = $product->feature_image;
        if ($request->hasFile('file')) {
            $idd = app('App\Http\Controllers\ImagesController')->store($request)['image_id'];
            if ($image)
                app('App\Http\Controllers\ImagesController')->destroy($image->filename);
        }

        $product->update([
            'name' => $request->productName,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
            'status' => 1,
            'feature_image' => $idd,
            'vendor_id' => $request->vendor_id,
        ]);

        // dd($request->all());


        if ($request->image_array) {
            foreach (explode(',', $request->image_array) as $single) {
                $album_images = new Album();
                $album_images->image_id =  $single;
                $product->album()->save($album_images);
            }
        }

        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, $id)
    {
        Product::where('product_id', $id)->first()->delete();


        return response()->json('success');
    }
}
