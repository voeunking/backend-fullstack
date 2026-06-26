@extends('admin.layout')

@section('title', 'Products Management')

@section('content')
<div class="mb-8">
    <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-gradient-to-br from-slate-950 to-cyan-900/20 shadow-2xl shadow-cyan-900/10">
        <div class="grid gap-6 p-6 sm:p-8 lg:grid-cols-[1fr_auto] lg:items-center">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-200">Products</p>
                <h1 class="mt-3 text-3xl font-black tracking-tight text-white sm:text-4xl">Manage your store inventory</h1>
                <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">
                    Edit products quickly, see stock status at a glance, and keep your catalog looking great.
                </p>
            </div>

            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-bold text-slate-950 shadow-lg shadow-cyan-400/20 transition hover:bg-cyan-300">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Product
            </a>
        </div>

        <div class="px-6 pb-6">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="rounded-3xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-200">Total products</p>
                    <p class="mt-2 text-3xl font-black text-white">{{ $products->total() }}</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-200">Catalog quality</p>
                    <p class="mt-2 text-sm font-bold text-slate-200">Images + details</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-200">Fast actions</p>
                    <p class="mt-2 text-sm font-bold text-slate-200">Edit / delete cards</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="overflow-hidden rounded-[1.5rem] border border-slate-200/70 bg-white/90 shadow-lg shadow-slate-200/70">
    <table class="w-full">
        <thead class="bg-gradient-to-r from-slate-50 to-cyan-50/50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-slate-700">Product</th>
                <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-slate-700">Category</th>
                <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-slate-700">Price</th>
                <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-slate-700">Stock</th>
                <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-slate-700">Status</th>
                <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-slate-700">Created</th>
                <th class="px-6 py-4 text-right text-xs font-extrabold uppercase tracking-wider text-slate-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200/50">
            @forelse($products as $product)
                <tr class="group transition hover:bg-slate-50/50">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-xl bg-gradient-to-br from-cyan-100/40 to-amber-100/40">
                                @if($product->image)
                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="h-full w-full object-cover"
                                    />
                                @else
                                    <div class="h-full w-full flex items-center justify-center text-slate-400">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <h3 class="truncate text-sm font-black text-slate-900">{{ $product->name }}</h3>
                                @if(isset($product->discount_percent) && $product->discount_percent > 0)
                                    <span class="mt-1 inline-flex items-center rounded-full bg-orange-500/95 px-2 py-0.5 text-[10px] font-black text-white">
                                        -{{ $product->discount_percent }}%
                                    </span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center rounded-full bg-cyan-50 px-3 py-1 text-xs font-extrabold text-cyan-700">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm font-black text-slate-900">${{ number_format($product->price, 2) }}</p>
                        @if(isset($product->discount_percent) && $product->discount_percent > 0)
                            <p class="text-xs font-semibold text-slate-400 line-through">${{ number_format($product->price, 2) }}</p>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm font-bold text-slate-700">{{ $product->stock ?? 0 }}</p>
                    </td>
                    <td class="px-6 py-4">
                        @if(isset($product->stock) && $product->stock === 0)
                            <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-[11px] font-black text-red-700 ring-1 ring-red-200">
                                Sold out
                            </span>
                        @elseif(isset($product->stock) && $product->stock < 5)
                            <span class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1 text-[11px] font-black text-amber-700 ring-1 ring-amber-200">
                                Low stock
                            </span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-[11px] font-black text-green-700 ring-1 ring-green-200">
                                In stock
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-xs font-bold text-slate-600">{{ $product->created_at->format('Y-m-d') }}</p>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="rounded-xl bg-slate-900/5 px-3 py-2 text-xs font-bold text-slate-700 ring-1 ring-slate-200 transition hover:bg-slate-900/10">
                                Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-xl bg-red-500/10 px-3 py-2 text-xs font-bold text-red-700 ring-1 ring-red-500/20 transition hover:bg-red-500/15">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <p class="text-sm font-bold text-slate-700">No products found</p>
                        <p class="mt-2 text-sm font-semibold text-slate-500">Create your first product to start selling.</p>
                        <a href="{{ route('admin.products.create') }}" class="mt-4 inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-bold text-slate-950 shadow-lg shadow-cyan-400/20 transition hover:bg-cyan-300">
                            Create Product
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($products->hasPages())
    <div class="mt-8">
        {{ $products->links() }}
    </div>
@endif
@endsection

