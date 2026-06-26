<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private array $activeStatuses = ['pending', 'processing', 'confirmed'];

    public function live()
    {
        $orders = Order::with('user')
            ->whereIn('status', $this->activeStatuses)
            ->latest()
            ->paginate(12);

        return view('admin.orders-live', [
            'orders' => $orders,
            'title' => 'Live Orders',
            'subtitle' => 'Confirm customer orders and keep fulfillment moving.',
        ]);
    }

    public function history()
    {
        $orders = Order::with('user')
            ->whereNotIn('status', $this->activeStatuses)
            ->latest()
            ->paginate(12);

        return view('admin.orders-history', [
            'orders' => $orders,
            'title' => 'Order History',
            'subtitle' => 'Review completed and cancelled orders.',
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,confirmed,completed,cancelled',
        ]);

        $order->update($validated);

        return back()->with('success', 'Order status updated successfully.');
    }
}
