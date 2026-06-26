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

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
    @forelse($products as $product)
        <div class="group relative overflow-hidden rounded-[1.5rem] border border-slate-200/70 bg-white/90 shadow-lg shadow-slate-200/70 transition hover:-translate-y-1 hover:shadow-xl">
            <div class="relative h-44 overflow-hidden bg-gradient-to-br from-cyan-100/40 to-amber-100/40">
                @if($product->image)
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.05]"
                    />
                @else
                    <div class="h-full w-full flex items-center justify-center text-slate-400">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif

                @if(isset($product->discount_percent) && $product->discount_percent > 0)
                    <div class="absolute left-4 top-4 rounded-full bg-orange-500/95 px-3 py-1 text-[11px] font-black text-white shadow">
                        -{{ $product->discount_percent }}%
                    </div>
                @endif

                @if(isset($product->stock) && $product->stock < 5 && $product->stock > 0)
                    <div class="absolute right-4 top-4 rounded-full bg-amber-100 px-3 py-1 text-[11px] font-black text-amber-700 ring-1 ring-amber-200 shadow">
                        Low stock
                    </div>
                @endif

                @if(isset($product->stock) && $product->stock === 0)
                    <div class="absolute right-4 top-4 rounded-full bg-red-100 px-3 py-1 text-[11px] font-black text-red-700 ring-1 ring-red-200 shadow">
                        Sold out
                    </div>
                @endif
            </div>

            <div class="p-5">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <p class="inline-flex items-center rounded-full bg-cyan-50 px-3 py-1 text-[11px] font-extrabold text-cyan-700">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </p>
                        <h2 class="mt-3 truncate text-lg font-black text-slate-900">{{ $product->name }}</h2>
                        <p class="mt-2 text-sm font-semibold text-slate-600">${{ number_format($product->price, 2) }}</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <span class="inline-flex items-center rounded-xl bg-slate-100 px-3 py-1 text-[11px] font-bold text-slate-600">
                                #{{ $product->index + 1 }}
                            </span>
                            <span class="inline-flex items-center rounded-xl bg-slate-100 px-3 py-1 text-[11px] font-bold text-slate-600">
                                {{ $product->created_at->format('Y-m-d') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 flex items-center gap-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="flex-1 rounded-2xl bg-slate-900/5 px-3 py-2 text-center text-xs font-bold text-slate-700 ring-1 ring-slate-200 transition hover:bg-slate-900/10">
                        Edit
                    </a>

                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full rounded-2xl bg-red-500/10 px-3 py-2 text-center text-xs font-bold text-red-700 ring-1 ring-red-500/20 transition hover:bg-red-500/15">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center">
            <p class="text-sm font-bold text-slate-700">No products found</p>
            <p class="mt-2 text-sm font-semibold text-slate-500">Create your first product to start selling.</p>
            <a href="{{ route('admin.products.create') }}" class="mt-5 inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-bold text-slate-950 shadow-lg shadow-cyan-400/20 transition hover:bg-cyan-300">
                Create Product
            </a>
        </div>
    @endforelse
</div>

@if($products->hasPages())
    <div class="mt-8">
        {{ $products->links() }}
    </div>
@endif
@endsection

