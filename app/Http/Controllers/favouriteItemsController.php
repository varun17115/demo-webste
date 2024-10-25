<?php

namespace App\Http\Controllers;

use App\Models\favouriteItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class favouriteItemsController extends Controller
{
    function like_product(Request $request)
    {
        $product_id = $request->id;
        $user_id = Auth::user()->id;
        $data = favouriteItems::where('user_id', $user_id)
            ->where('product_id', $product_id)->first();
            
        if ($data) {
            $data->delete();
            $total = favouriteItems::where('user_id', $user_id)->get();

            return response()->json(['total' => $total->count(), 'status' => 'success', 'message' => 'Product Removed From Favourites', 'operation' => 'remove']);
        } else {
            $data = new favouriteItems();
            $data->user_id = Auth::user()->id;
            $data->product_id = $product_id;
            $data->save();
            $total = favouriteItems::where('user_id', $user_id)->get();


            return response()->json(['total' => $total->count(), 'status' => 'success', 'message' => 'Product Added To Favourites', 'operation' => 'add']);
        }
    }
    function show_likes_page()
    {
        $products = favouriteItems::where('user_id', Auth::user()->id)
            ->with(['favourites'])
            ->paginate(8);

        //    echo "<pre>";print_r($products);exit;

        return view('user/pages/liked_items', ['products' => $products]);
    }
    function remove_liked(Request $request)
    {
        $product_id = $request->id;
        $user_id = Auth::user()->id;
        $data = favouriteItems::where('user_id', $user_id)
        ->where('product_id', $product_id)->first();
        
        $data->delete();
        $total = favouriteItems::where('user_id', $user_id)->get();
        return response()->json(['total' => $total->count(), 'status' => 'success', 'message' => 'Product Removed From Favourites', 'operation' => 'remove']);
    }
}
