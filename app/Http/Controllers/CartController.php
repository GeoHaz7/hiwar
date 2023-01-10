<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $products = Product::select('product_id', 'name', 'price', 'vendor_id', 'filename', 'status', 'description')
            ->leftjoin('images', 'images.image_id', '=', 'products.feature_image');

        return view('pages.products.test', ['product' => $products]);
    }

    public function addToCart(Request $request)
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

    public function getCartTotalItems(Request $request)
    {
        if (!$request->cookie('cart')) {

            return response()->json(['message' => 'success', 'totalItems' => 0]);
        } else {
            $cart = json_decode($request->cookie('cart'));

            $totalcarts = count($cart);
            return response()->json(['message' => 'success', 'totalItems' => $totalcarts])->cookie('cart', json_encode($cart), 60);
        }
    }
}
