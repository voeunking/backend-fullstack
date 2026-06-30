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
                    Create, edit and organize categories with a modern dashboard.
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
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-200">Catalog coverage</p>
                    <p class="mt-2 text-sm font-bold text-slate-200">Images + details</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-200">Fast actions</p>
                    <p class="mt-2 text-sm font-bold text-slate-200">Edit / delete</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="overflow-hidden rounded-[1.5rem] border border-slate-200/70 bg-white/90 shadow-lg shadow-slate-200/70">
    <table class="w-full">
        <thead class="bg-gradient-to-r from-slate-50 to-cyan-50/50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-slate-700">Category</th>
                <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-slate-700">Description</th>
                <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-wider text-slate-700">Created</th>
                <th class="px-6 py-4 text-right text-xs font-extrabold uppercase tracking-wider text-slate-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200/50">
            @forelse($categories as $category)
                <tr class="group transition hover:bg-slate-50/50">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-xl bg-gradient-to-br from-cyan-100/40 to-amber-100/40">
                                @if($category->image)
                                    <img
                                        src="{{ asset('storage/' . $category->image) }}"
                                        alt="{{ $category->name }}"
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
                                <h3 class="truncate text-sm font-black text-slate-900">{{ $category->name }}</h3>
                                <p class="mt-1 text-xs font-bold text-slate-500">Category #{{ $category->id }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm font-semibold text-slate-600">{{ \Illuminate\Support\Str::limit($category->description, 90) }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-xs font-bold text-slate-600">
                            {{ optional($category->created_at)->format('Y-m-d') ?? '-' }}
                        </p>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="rounded-xl bg-slate-900/5 px-3 py-2 text-xs font-bold text-slate-700 ring-1 ring-slate-200 transition hover:bg-slate-900/10">
                                Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
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
                    <td colspan="4" class="px-6 py-12 text-center">
                        <p class="text-sm font-bold text-slate-700">No categories found</p>
                        <p class="mt-2 text-sm font-semibold text-slate-500">Create your first category to start organizing products.</p>
                        <a href="{{ route('admin.categories.create') }}" class="mt-4 inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-bold text-slate-950 shadow-lg shadow-cyan-400/20 transition hover:bg-cyan-300">
                            Create Category
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($categories->hasPages())
    <div class="mt-8">
        {{ $categories->links() }}
    </div>
@endif
@endsection


