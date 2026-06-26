@extends('admin.layout')

@section('title', 'Live Orders')

@php
    $statusClasses = [
        'pending' => 'bg-amber-100 text-amber-800 border-amber-200',
        'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
        'confirmed' => 'bg-cyan-100 text-cyan-800 border-cyan-200',
        'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
        'cancelled' => 'bg-red-100 text-red-800 border-red-200',
    ];
@endphp

@section('content')
<div class="mb-6 overflow-hidden rounded-3xl bg-slate-950 text-white shadow-xl shadow-slate-900/10">
    <div class="flex flex-wrap items-end justify-between gap-5 p-6 sm:p-8">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.22em] text-cyan-200">Customer workflow</p>
            <h1 class="mt-2 text-3xl font-black sm:text-4xl">Live Orders</h1>
            <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">Confirm new orders, prepare fulfillment, and let customers see progress from their order page.</p>
        </div>
        <a href="{{ route('admin.orders.history') }}" class="rounded-xl border border-white/15 px-4 py-2 text-sm font-bold text-white transition hover:bg-white/10">View History</a>
    </div>
</div>

<div class="grid gap-4">
    @forelse($orders as $order)
        <article class="overflow-hidden rounded-2xl border border-white bg-white/95 shadow-xl shadow-slate-200/70">
            <div class="grid gap-5 border-b border-slate-100 p-5 lg:grid-cols-[1fr_auto] lg:items-center">
                <div>
                    <div class="flex flex-wrap items-center gap-3">
                        <h2 class="text-xl font-black text-slate-950">Order #{{ $order->id }}</h2>
                        <span class="rounded-full border px-3 py-1 text-xs font-black capitalize {{ $statusClasses[$order->status] ?? 'bg-slate-100 text-slate-700 border-slate-200' }}">{{ $order->status }}</span>
                    </div>
                    <p class="mt-2 text-sm text-slate-500">{{ $order->user->name ?? 'Customer' }} - {{ $order->user->email ?? 'No email' }} - {{ $order->created_at->format('M d, Y h:i A') }}</p>
                </div>
                <div class="text-left lg:text-right">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ strtoupper($order->payment_method) }}</p>
                    <p class="text-2xl font-black text-emerald-600">${{ number_format($order->total, 2) }}</p>
                </div>
            </div>

            <div class="grid gap-5 p-5 xl:grid-cols-[1fr_22rem]">
                <div class="grid gap-2">
                    @foreach($order->items ?? [] as $item)
                        <div class="flex items-center justify-between gap-4 rounded-xl bg-slate-50 px-4 py-3 text-sm">
                            <div>
                                <p class="font-bold text-slate-900">{{ $item['name'] ?? 'Product' }}</p>
                                <p class="text-xs text-slate-500">Quantity: {{ $item['quantity'] ?? 1 }}</p>
                            </div>
                            <strong class="text-slate-950">${{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}</strong>
                        </div>
                    @endforeach
                </div>

                <div class="rounded-2xl border border-slate-100 bg-white p-4">
                    <p class="text-sm font-black text-slate-950">Update status</p>
                    <p class="mt-1 text-xs text-slate-500">Customers will see the new status on their orders page.</p>
                    <div class="mt-4 grid grid-cols-2 gap-2">
                        @foreach(['processing' => 'Process', 'confirmed' => 'Confirm', 'completed' => 'Complete', 'cancelled' => 'Cancel'] as $status => $label)
                            <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ $status }}">
                                <button type="submit" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm font-bold text-slate-700 transition hover:border-cyan-300 hover:bg-cyan-50 hover:text-cyan-800">
                                    {{ $label }}
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </article>
    @empty
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white/80 p-12 text-center">
            <h2 class="text-xl font-black text-slate-950">No live orders right now</h2>
            <p class="mt-2 text-sm text-slate-500">New customer orders will appear here as soon as they checkout.</p>
        </div>
    @endforelse
</div>

@if($orders->hasPages())
    <div class="mt-6 rounded-2xl bg-white px-5 py-4 shadow-sm">
        {{ $orders->links() }}
    </div>
@endif
@endsection
