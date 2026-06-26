@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-8 overflow-hidden rounded-[2rem] bg-slate-950 text-white shadow-2xl shadow-slate-900/10">
    <div class="grid gap-8 p-6 sm:p-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-200">Admin Overview</p>
            <h1 class="mt-3 text-3xl font-black tracking-tight sm:text-5xl">Manage your store with clarity.</h1>
            <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">
                Watch catalog growth, manage inventory, and jump into product work from one focused control room.
            </p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('admin.products.create') }}" class="inline-flex items-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-bold text-slate-950 shadow-lg shadow-cyan-400/20 transition hover:bg-cyan-300">
                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add Product
                </a>
                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center rounded-2xl border border-white/15 px-5 py-3 text-sm font-bold text-white transition hover:bg-white/10">
                    View Catalog
                </a>
            </div>
        </div>
        <div class="grid w-full min-w-64 gap-3 rounded-3xl border border-white/10 bg-white/10 p-4 backdrop-blur lg:w-72">
            <div class="flex items-center justify-between">
                <span class="text-sm text-slate-300">Store Pulse</span>
                <span class="rounded-full bg-emerald-400/20 px-3 py-1 text-xs font-bold text-emerald-200">Live</span>
            </div>
            <div class="rounded-2xl bg-white p-4 text-slate-950">
                <p class="text-sm font-semibold text-slate-500">Total Sales</p>
                <p class="mt-1 text-3xl font-black" id="hero_total_sales">{{ $stats['total_sales'] }}</p>
            </div>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div class="rounded-2xl bg-white/10 p-3">
                    <p class="text-slate-400">Products</p>
                    <p class="mt-1 text-xl font-bold" id="hero_total_products">{{ $stats['total_products'] }}</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-3">
                    <p class="text-slate-400">Users</p>
                    <p class="mt-1 text-xl font-bold" id="hero_total_users">{{ $stats['total_users'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
    <div class="rounded-3xl border border-white bg-white/90 p-5 shadow-xl shadow-slate-200/70">
        <div class="flex items-center justify-between">
            <p class="text-sm font-semibold text-slate-500">Users</p>
            <span class="rounded-2xl bg-indigo-50 p-3 text-indigo-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m8-4.13a4 4 0 10-8 0 4 4 0 008 0z"></path></svg>
            </span>
        </div>
        <h3 class="mt-5 text-3xl font-black text-slate-950" id="total_users">{{ $stats['total_users'] }}</h3>
        <p class="mt-2 text-xs font-medium text-slate-400">Registered customers and admins</p>
    </div>
    <div class="rounded-3xl border border-white bg-white/90 p-5 shadow-xl shadow-slate-200/70">
        <div class="flex items-center justify-between">
            <p class="text-sm font-semibold text-slate-500">Products</p>
            <span class="rounded-2xl bg-cyan-50 p-3 text-cyan-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4M4 7l8 4M4 7v10l8 4"></path></svg>
            </span>
        </div>
        <h3 class="mt-5 text-3xl font-black text-slate-950" id="total_products">{{ $stats['total_products'] }}</h3>
        <p class="mt-2 text-xs font-medium text-slate-400">Items currently in the catalog</p>
    </div>
    <div class="rounded-3xl border border-white bg-white/90 p-5 shadow-xl shadow-slate-200/70">
        <div class="flex items-center justify-between">
            <p class="text-sm font-semibold text-slate-500">Categories</p>
            <span class="rounded-2xl bg-amber-50 p-3 text-amber-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7h.01M7 3h5c.53 0 1.04.21 1.41.59l7 7a2 2 0 010 2.82l-7 7a2 2 0 01-2.82 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"></path></svg>
            </span>
        </div>
        <h3 class="mt-5 text-3xl font-black text-slate-950" id="total_categories">{{ $stats['total_categories'] }}</h3>
        <p class="mt-2 text-xs font-medium text-slate-400">Organized shopping sections</p>
    </div>
    <div class="rounded-3xl border border-white bg-white/90 p-5 shadow-xl shadow-slate-200/70">
        <div class="flex items-center justify-between">
            <p class="text-sm font-semibold text-slate-500">Sales</p>
            <span class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-1.66 0-3 .9-3 2s1.34 2 3 2 3 .9 3 2-1.34 2-3 2m0-8c1.11 0 2.08.4 2.6 1M12 8V6m0 10v2m8-6a8 8 0 11-16 0 8 8 0 0116 0z"></path></svg>
            </span>
        </div>
        <h3 class="mt-5 text-3xl font-black text-slate-950" id="total_sales">{{ $stats['total_sales'] }}</h3>
        <p class="mt-2 text-xs font-medium text-slate-400">Completed revenue activity</p>
    </div>
</section>

<section class="grid gap-6 xl:grid-cols-[1fr_22rem]">
    <div class="overflow-hidden rounded-3xl border border-white bg-white/95 shadow-xl shadow-slate-200/70">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 px-6 py-5">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-600">Inventory</p>
                <h2 class="mt-1 text-xl font-black text-slate-950">Recent Products</h2>
            </div>
            <a href="{{ route('admin.products.index') }}" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-bold text-slate-700 transition hover:border-cyan-300 hover:text-cyan-700">View all</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Created</th>
                    </tr>
                </thead>
                <tbody id="recent_products_body" class="divide-y divide-slate-100">
                    @forelse($stats['recent_products'] ?? [] as $product)
                        <tr class="transition hover:bg-cyan-50/40">
                            <td class="px-6 py-4 font-bold text-slate-400">#{{ $product->id }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-900">{{ $product->name }}</td>
                            <td class="px-6 py-4 font-bold text-emerald-600">${{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $product->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-500">No products yet. Create your first product to fill this table.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="rounded-3xl border border-white bg-white/95 p-6 shadow-xl shadow-slate-200/70">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-600">Quick Actions</p>
        <h2 class="mt-1 text-xl font-black text-slate-950">Run the shop</h2>
        <div class="mt-5 space-y-3">
            <a href="{{ route('admin.products.create') }}" class="flex items-center justify-between rounded-2xl border border-slate-100 p-4 font-bold text-slate-800 transition hover:border-cyan-200 hover:bg-cyan-50">
                Add product
                <span class="text-cyan-600">+</span>
            </a>
            <a href="{{ route('admin.categories.create') }}" class="flex items-center justify-between rounded-2xl border border-slate-100 p-4 font-bold text-slate-800 transition hover:border-amber-200 hover:bg-amber-50">
                Add category
                <span class="text-amber-600">+</span>
            </a>
            <a href="{{ route('admin.users.create') }}" class="flex items-center justify-between rounded-2xl border border-slate-100 p-4 font-bold text-slate-800 transition hover:border-indigo-200 hover:bg-indigo-50">
                Add user
                <span class="text-indigo-600">+</span>
            </a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    fetch('{{ route("admin.dashboard.stats") }}')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total_users').textContent = data.total_users;
            document.getElementById('total_products').textContent = data.total_products;
            document.getElementById('total_categories').textContent = data.total_categories;
            document.getElementById('total_sales').textContent = data.total_sales;
            document.getElementById('hero_total_users').textContent = data.total_users;
            document.getElementById('hero_total_products').textContent = data.total_products;
            document.getElementById('hero_total_sales').textContent = data.total_sales;

            const tbody = document.getElementById('recent_products_body');
            const recentProducts = data.recent_products || [];
            tbody.innerHTML = '';
            if (!recentProducts.length) {
                tbody.innerHTML = '<tr><td colspan="4" class="px-6 py-12 text-center text-slate-500">No products yet. Create your first product to fill this table.</td></tr>';
                return;
            }

            recentProducts.forEach(product => {
                tbody.innerHTML += `
                    <tr class="transition hover:bg-cyan-50/40">
                        <td class="px-6 py-4 font-bold text-slate-400">#${product.id}</td>
                        <td class="px-6 py-4 font-semibold text-slate-900">${product.name}</td>
                        <td class="px-6 py-4 font-bold text-emerald-600">$${Number(product.price).toFixed(2)}</td>
                        <td class="px-6 py-4 text-slate-500">${product.created_at}</td>
                    </tr>
                `;
            });
        });
</script>
@endsection
