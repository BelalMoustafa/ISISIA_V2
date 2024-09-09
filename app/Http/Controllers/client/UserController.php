<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
class UserController extends Controller
{
    function main(Request $request){
        $data['header_title'] = 'ISISIA';
        $data['categories'] = Category::withCount('products')->get();
        $categoryIds = $request->input('categories');

        if ($categoryIds) {
            $data['products'] = Product::whereIn('category_id', explode(',', $categoryIds))->paginate(10);
        } else {
            $data['products'] = Product::paginate(10);
        }
        $data['topSellingProducts'] = Product::join('order_items', 'products.id', '=', 'order_items.product_id')
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->where('orders.status', 'pending')
        ->selectRaw('products.id, products.title, products.image, SUM(order_items.quantity) AS total_quantity')
        ->groupBy('products.id', 'products.title', 'products.image')
        ->orderByRaw('SUM(order_items.quantity) DESC')
        ->limit(3)
        ->get();
        return view('main', $data);
    }
    function about()
    {
        $data['header_title'] = 'ISISIA | About';
        return view('client.about', $data);
    }
    function contact()
    {
        $data['header_title'] = 'ISISIA | Contact';
        return view('client.contact', $data);
    }
    function shop(Request $request)
    {
        $data['header_title'] = 'ISISIA | Shop';
        $data['categories'] = Category::withCount('products')->get();
        $categoryIds = $request->input('categories');

        if ($categoryIds) {
            $data['products'] = Product::whereIn('category_id', explode(',', $categoryIds))->paginate(10);
        } else {
            $data['products'] = Product::paginate(10);
        }

        return view('client.shop', $data);
    }
    function productDetail($id){
        $product = Product::select('products.*', 'categories.name as category_name', 'categories.metaTitle as category_metaTitle', 'categories.metaDescription as category_metaDescription', 'categories.metaKeys as category_metaKeys')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->findOrFail($id);
        $data['product'] = $product;
        $data['header_title'] = $product->title;
        $data['metaTitle'] = $product->category_metaTitle;
        $data['metaDescription'] = $product->category_metaDescription;
        $data['metaKeys'] = $product->category_metaKeys;

        return view('client.product', $data);
    }
    function addToCart(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity')??1;

        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.',
            ], 404);
        }
        if ($user->cart()->where('product_id', $productId)->exists()) {
            $cartItem = $user->cart()->where('product_id', $productId)->first();
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $user->cart()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!'
        ]);
    }
    public function updateCart(Request $request)
    {
        $user = Auth::user();
        $cartItemId = $request->input('cart_item_id');
        $action = $request->input('action');

        $cartItem = $user->cart()->find($cartItemId);

        if ($cartItem) {
            if ($action == 'increase') {
                $cartItem->quantity += 1;
            } elseif ($action == 'decrease' && $cartItem->quantity > 1) {
                $cartItem->quantity -= 1;
            }

            $cartItem->save();

            return response()->json([
                'success' => true,
                'message' => 'Quantity updated successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart.'
            ], 404);
        }
    }

    function viewCart()
    {
        $user = Auth::user();
        $cartItems = $user->cart()->with('product')->get();
        $totalCartPrice = 0;
        foreach ($cartItems as $item) {
            $totalCartPrice += $item->quantity * $item->product->price;
        }
        $data['header_title'] = 'ISISIA | Cart';
        $data['cartItems'] = $cartItems;
        $data['totalCartPrice'] = $totalCartPrice;
        return view('client.cart',$data);
    }

    function checkout(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->cart()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Your cart is empty.'], 400);
        }
        $order = Order::create([
            'user_id' => $user->id,
            'address' => $request->input('address', 'not now'),
            'status' => 'pending',
            'total_price' => $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            }),
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        $user->cart()->delete();

        return response()->json(['success' => 'Order placed successfully!'], 200);
    }

    public function removeFromCart(Request $request)
    {
        $user = Auth::user();
        $cartItemId = $request->input('cart_item_id');
        $cartItem = $user->cart()->find($cartItemId);

        if ($cartItem) {
            $cartItem->delete();
            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart successfully.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart.'
            ], 404);
        }
    }

}
