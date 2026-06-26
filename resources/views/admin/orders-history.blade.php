@extends('admin.layout')

@section('title', 'Order History')

@php
    $statusClasses = [
        'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
        'cancelled' => 'bg-red-100 text-red-800 border-red-200',
        'pending' => 'bg-amber-100 text-amber-800 border-amber-200',
        'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
        'confirmed' => 'bg-cyan-100 text-cyan-800 border-cyan-200',
    ];
@endphp

@section('content')
<div class="mb-6 flex flex-wrap items-end justify-between gap-4">
    <div>
        <p class="text-xs font-bold uppercase tracking-[0.22em] text-cyan-600">Archive</p>
        <h1 class="mt-2 text-3xl font-black text-slate-950">Order History</h1>
        <p class="mt-2 text-sm text-slate-500">Completed and cancelled orders stay here for review.</p>
    </div>
    <a href="{{ route('admin.orders.live') }}" class="rounded-xl bg-slate-950 px-4 py-2 text-sm font-bold text-white transition hover:bg-slate-800">Back to Live Orders</a>
</div>

<div class="overflow-hidden rounded-3xl border border-white bg-white/95 shadow-xl shadow-slate-200/70">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-slate-50 text-left text-xs font-black uppercase tracking-wider text-slate-500">
                    <th class="px-6 py-4">Order</th>
                    <th class="px-6 py-4">Customer</th>
                    <th class="px-6 py-4">Items</th>
                    <th class="px-6 py-4">Payment</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($orders as $order)
                    <tr class="transition hover:bg-cyan-50/40">
                        <td class="px-6 py-4">
                            <p class="font-black text-slate-950">#{{ $order->id }}</p>
                            <p class="text-xs text-slate-500">{{ $order->created_at->format('M d, Y') }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-900">{{ $order->user->name ?? 'Customer' }}</p>
                            <p class="text-xs text-slate-500">{{ $order->user->email ?? 'No email' }}</p>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ count($order->items ?? []) }} products</td>
                        <td class="px-6 py-4 font-bold uppercase text-slate-600">{{ $order->payment_method }}</td>
                        <td class="px-6 py-4">
                            <span class="rounded-full border px-3 py-1 text-xs font-black capitalize {{ $statusClasses[$order->status] ?? 'bg-slate-100 text-slate-700 border-slate-200' }}">{{ $order->status }}</span>
                        </td>
                        <td class="px-6 py-4 text-right text-base font-black text-emerald-600">${{ number_format($order->total, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">No archived orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
        <div class="border-t border-slate-100 px-6 py-4">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
