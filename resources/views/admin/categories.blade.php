@extends('admin.layout')

@section('title', 'Categories Management')

@section('content')
<div class="mb-8">
    <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-gradient-to-br from-slate-950 to-cyan-900/20 shadow-2xl shadow-cyan-900/10">
        <div class="grid gap-6 p-6 sm:p-8 lg:grid-cols-[1fr_auto] lg:items-center">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-200">Categories</p>
                <h1 class="mt-3 text-3xl font-black tracking-tight text-white sm:text-4xl">Manage your store categories</h1>
                <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">
                    Create, edit and organize categories with a clean, modern dashboard.
                </p>
            </div>

            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-bold text-slate-950 shadow-lg shadow-cyan-400/20 transition hover:bg-cyan-300">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Category
            </a>
        </div>

        <div class="px-6 pb-6">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="rounded-3xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-200">Total categories</p>
                    <p class="mt-2 text-3xl font-black text-white">{{ $categories->total() }}</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-200">Organized catalog</p>
                    <p class="mt-2 text-sm font-bold text-slate-200">Better browsing for customers</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-200">Fast management</p>
                    <p class="mt-2 text-sm font-bold text-slate-200">Quick edit / delete actions</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
    @forelse($categories as $category)
        @php
            $desc = \Illuminate\Support\Str::limit($category->dec, 90);
        @endphp
        <div class="group relative overflow-hidden rounded-[1.5rem] border border-slate-200/70 bg-white/90 p-5 shadow-lg shadow-slate-200/70 transition hover:-translate-y-1 hover:shadow-xl">
            <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-cyan-500/15 blur-xl transition group-hover:bg-cyan-500/25"></div>

            <div class="relative flex items-start justify-between gap-4">
                <div class="min-w-0">
                    <p class="inline-flex items-center rounded-full bg-cyan-50 px-3 py-1 text-xs font-extrabold text-cyan-700">
                        Category #{{ $category->index + 1 }}
                    </p>
                    <h2 class="mt-3 truncate text-lg font-black text-slate-900">{{ $category->name }}</h2>
                    <p class="mt-2 text-sm font-semibold leading-6 text-slate-600">{{ $desc }}</p>
                    <div class="mt-4 flex items-center gap-2 text-xs font-bold text-slate-500">
                        {{-- <span class="inline-flex h-8 items-center rounded-xl bg-slate-100 px-3">{{ $category->created_at->format('Y-m-d') }}</span> --}}
                    </div>
                </div>

                <div class="flex flex-col items-end gap-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="rounded-2xl bg-slate-900/5 px-3 py-2 text-xs font-bold text-slate-700 ring-1 ring-slate-200 transition hover:bg-slate-900/10">
                        Edit
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-2xl bg-red-500/10 px-3 py-2 text-xs font-bold text-red-700 ring-1 ring-red-500/20 transition hover:bg-red-500/15">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="relative mt-5 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-cyan-500"></span>
                    <span class="text-xs font-bold text-slate-500">Ready in catalog</span>
                </div>
                <span class="text-xs font-black text-slate-900 opacity-60 group-hover:opacity-100">→</span>
            </div>
        </div>
    @empty
        <div class="col-span-full rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center">
            <p class="text-sm font-bold text-slate-700">No categories found</p>
            <p class="mt-2 text-sm font-semibold text-slate-500">Create your first category to start organizing products.</p>
            <a href="{{ route('admin.categories.create') }}" class="mt-5 inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-bold text-slate-950 shadow-lg shadow-cyan-400/20 transition hover:bg-cyan-300">
                Create Category
            </a>
        </div>
    @endforelse
</div>

@if($categories->hasPages())
    <div class="mt-8">
        {{ $categories->links() }}
    </div>
@endif
@endsection

