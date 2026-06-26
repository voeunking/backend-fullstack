<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'total' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:qr,cod',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $request->total,
            'payment_method' => $request->payment_method,
            'items' => $request->items,
            'status' => $request->payment_method === 'qr' ? 'processing' : 'pending',
        ]);

        return response()->json([
            'success' => true,
            'data' => $order,
            'message' => 'Order placed successfully',
        ], 201);
    }

    public function adminIndex(Request $request)
    {
        $orders = Order::with('user')
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,processing,confirmed,completed,cancelled',
        ]);

        $order->update($validated);

        return response()->json([
            'success' => true,
            'data' => $order->fresh('user'),
            'message' => 'Order status updated successfully',
        ]);
    }
}
