<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        if (Wishlist::where('user_id', $user->id)->where('product_id', $productId)->exists()) {
            return response()->json(['message' => 'Product already in wishlist'], 400);
        }

        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $productId,
        ]);

        return response()->json(['message' => 'Product added to wishlist'], 200);
    }

    public function viewWishlist()
    {
        $user = Auth::user();
        $wishlistItems = $user->wishlist()->with('product')->get();

        $data['header_title'] = 'ISISIA | WishList';
        $data['wishlistItems'] = $wishlistItems;

        return view('client.wish_list', $data);
    }

    public function removeFromWishlist(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        $wishlistItem = Wishlist::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return response()->json(['message' => 'Item removed from wishlist'], 200);
        }

        return response()->json(['message' => 'Item not found in wishlist'], 404);
    }
}
