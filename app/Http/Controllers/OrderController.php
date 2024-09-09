<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Notifications\OrderStatusUpdated;
class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');
        $orders = Order::where('status', $status)->with('user', 'orderItems.product')->paginate(10);
        $data['header_title'] = 'ISISIA | Order';
        $data['orders'] = $orders;
        return view('admin.orders.index',$data);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:shipped,accepted,rejected,waiting'
        ]);
        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $newStatus = str($request->input('status'));
        if ($oldStatus !== $newStatus) {
            $order->status = $newStatus;
            $order->save();
        $order->user->notify(new OrderStatusUpdated($order));
        return redirect()->route('orders.index')->with('success', 'Order status updated successfully.');
    }
}
}
