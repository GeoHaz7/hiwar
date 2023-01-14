<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use stdClass;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index()
    {
        $products = Product::select('product_id', 'name', 'price', 'vendor_id', 'filename', 'status', 'description')
            ->leftjoin('images', 'images.image_id', '=', 'products.feature_image');

        return view('frontend.shop', ['product' => $products]);
    }

    public function addToCart(Request $request)
    {
        $id = $request->id;
        $enter = false;
        if (!$request->cookie('cart')) {
            $cart = [];
            array_push($cart, ['product_id' => $id, 'quantity' => 1]);

            return response()->json(['message' => 'success'])->cookie('cart', json_encode($cart), 60);
        } else {
            $cart = json_decode($request->cookie('cart'));

            foreach ($cart as $key => $value) {
                $value = json_decode(json_encode($value), true);
                if ($value['product_id'] == $id) {
                    $enter = true;
                    $value['quantity'] = $value['quantity'] + 1;
                    $cart[$key] = $value;

                    return response()->json(['message' => 'success'])->cookie('cart', json_encode($cart), 60);
                }
            }
            if ($enter == false) {
                array_push($cart, ['product_id' => $id, 'quantity' => 1]);

                return response()->json(['message' => 'success'])->cookie('cart', json_encode($cart), 60);
            }
        }
    }

    public function removeFromCart(Request $request)
    {
        $id = $request->id;

        $cart = json_decode($request->cookie('cart'));

        foreach ($cart as $key => $value) {
            $value = json_decode(json_encode($value), true);
            if ($value['product_id'] == $id) {
                $value['quantity'] = $value['quantity'] - 1;

                if ($value['quantity'] < 1) {
                    unset($cart[$key]);
                    return response()->json(['message' => 'removed'])->cookie('cart', json_encode($cart), 60);
                } else {
                    $cart[$key] = $value;
                    return response()->json(['message' => 'success'])->cookie('cart', json_encode($cart), 60);
                }
            }
        }
    }

    public function deleteFromCart(Request $request)
    {
        $id = $request->id;

        $cart = json_decode($request->cookie('cart'));

        if (gettype($cart) == "object") {
            $cart = (array)$cart;
        }



        foreach ($cart as $key => $value) {
            $value = json_decode(json_encode($value), true);
            if ($value['product_id'] == $id) {
                unset($cart[$key]);
                return response()->json(['message' => 'success'])->cookie('cart', json_encode($cart), 60);
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

    public function cart(Request $request)
    {
        $cart = json_decode($request->cookie('cart'));

        if ($cart) {
            $products = [];
            $total = 0;

            foreach ($cart as $key => $value) {
                $loopProduct = Product::find($value->product_id);

                $product = new stdClass();
                $product->product_id = $value->product_id;
                $product->name = $loopProduct->name;
                $product->price = $loopProduct->price;
                $product->description = $loopProduct->description;
                $product->thumbnail = $loopProduct->thumbnail ? $loopProduct->thumbnail->filename : null;
                $product->quantiy = $value->quantity;

                array_push($products, $product);
            }

            foreach ($products as $key => $value) {
                $productTotal = $value->quantiy * $value->price;
                $total = $total + $productTotal;
            }


            return view('frontend.cartList', ['products' => $products, 'total' => $total]);
        }
    }

    public function checkout(Request $request)
    {


        $cart = json_decode($request->cookie('cart'));

        foreach ($cart as $key => $value) {

            OrderProduct::create([
                'order_id' => $request->order_id,
                'product_id' => $value->product_id,
                'quantity' => $value->quantity,
            ]);
        }
        return response()->json(['message' => 'success']);
    }
}
