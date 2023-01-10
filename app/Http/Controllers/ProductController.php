<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\PhotoAlbum;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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
        $products = Product::select('product_id', 'name', 'price', 'vendor_id', 'filename', 'status')
            ->leftjoin('images', 'images.image_id', '=', 'products.feature_image');

        return DataTables::eloquent($products)
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
        $id = null;

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
            'vendor_id' => $request->has('vendor_id') ? $request->vendor_id : Auth::user()->vendor->vendor_id,
        ]);

        if ($request->image_array) {
            foreach (explode(',', $request->image_array) as $single) {
                $album_images = new PhotoAlbum();
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
        $product = Product::where('product_id', $id)->first();

        if (Auth::user()->type == 2 && $product->vendor_id != Auth::user()->vendor->vendor_id)

            return response()->json(['error' => 'Unauthorized.'], 401);

        return view('pages.products.editProduct', ['product' => $product]);
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

        if (Auth::user()->type == 2 && $product->vendor_id != Auth::user()->vendor->vendor_id)

            return response()->json(['error' => 'Unauthorized.'], 401);

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
                $album_images = new PhotoAlbum();
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
        $product =  Product::where('product_id', $id)->first();

        if (Auth::user()->type == 2 && $product->vendor_id != Auth::user()->vendor->vendor_id)

            return response()->json(['error' => 'Unauthorized.'], 401);

        $product->delete();

        return response()->json('success');
    }

    public function switch(Request $request, Product $product, $id)
    {

        // dd($request->all());

        $product = Product::where('product_id', $id)->first();

        $product->update([
            'status' => !$product->status,
        ]);

        return response()->json('success');
    }


    public function test()
    {
        $products = Product::select('product_id', 'name', 'price', 'vendor_id', 'filename', 'status', 'description')
            ->leftjoin('images', 'images.image_id', '=', 'products.feature_image');

        return view('pages.products.test', ['product' => $products]);
    }

    public function addToCartCookie(Request $request)
    {
        $id = $request->id;
        $enter = false;
        if (!$request->cookie('cart')) {
            $totalcarts = 0;
            $cart = [];
            array_push($cart, ['product_id' => $id, 'quantity' => 1]);

            $totalcarts = count($cart);
            return response()->json(['message' => 'success', 'totalItems' => $totalcarts])->cookie('cart', json_encode($cart), 60);
        } else {
            $cart = json_decode($request->cookie('cart'));

            foreach ($cart as $key => $value) {
                $value = json_decode(json_encode($value), true);
                if ($value['product_id'] == $id) {
                    $enter = true;
                    $value['quantity'] = $value['quantity'] + 1;
                    $cart[$key] = $value;

                    $totalcarts = count($cart);
                    return response()->json(['message' => 'success', 'totalItems' => $totalcarts])->cookie('cart', json_encode($cart), 60);
                }
            }
            if ($enter == false) {
                array_push($cart, ['product_id' => $id, 'quantity' => 1]);

                $totalcarts = count($cart);
                return response()->json(['message' => 'success', 'totalItems' => $totalcarts])->cookie('cart', json_encode($cart), 60);
            }
        }
    }
}
