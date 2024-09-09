<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function dashboard()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $shippedOrdersCount = Order::where('status', 'shipped')->count();
        $productQuantities = OrderItem::select('products.title as product_name', DB::raw('SUM(quantity) as total_quantity'))
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->groupBy('products.title')
            ->get();
        $data = [
            'header_title' => 'ISISIA | Dashboard',
            'productCount' => $productCount,
            'categoryCount' => $categoryCount,
            'shippedOrdersCount' => $shippedOrdersCount,
            'productQuantities' => $productQuantities,
        ];

        return view('admin.dashboard', $data);
    }
}
