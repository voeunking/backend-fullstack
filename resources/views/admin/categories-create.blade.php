@extends('admin.layout')

@section('title', 'Create Category')

@section('content')
<div class="mb-8">
    <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-gradient-to-br from-slate-950 to-cyan-900/20 shadow-2xl shadow-cyan-900/10">
        <div class="grid gap-6 p-6 sm:p-8 lg:grid-cols-[1fr_auto] lg:items-center">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-200">Categories</p>
                <h1 class="mt-3 text-3xl font-black tracking-tight text-white sm:text-4xl">Create Category</h1>
                <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">
                    Add details so customers can find products faster.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 xl:grid-cols-[1.2fr_0.8fr]">
    <div class="rounded-[2rem] border border-slate-200/70 bg-white/90 p-6 shadow-xl shadow-slate-200/70">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Category Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full rounded-2xl border-slate-300 border px-4 py-3 focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="dec" class="block text-sm font-bold text-slate-700 mb-1">Description</label>
                    <textarea name="description" id="dec" rows="4" required
                        class="w-full rounded-2xl border-slate-300 border px-4 py-3 focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}" class="px-5 py-3 text-sm font-bold rounded-2xl border border-slate-200 text-slate-700 hover:bg-slate-50">Cancel</a>
                <button type="submit" class="px-5 py-3 text-sm font-bold rounded-2xl bg-cyan-400 text-slate-950 shadow-lg shadow-cyan-400/20 hover:bg-cyan-300">
                    Create Category
                </button>
            </div>
        </form>
    </div>

    <aside class="rounded-[2rem] border border-slate-200/70 bg-slate-50/70 p-6 shadow-xl shadow-slate-200/70">
        <p class="text-sm font-bold uppercase tracking-[0.2em] text-cyan-700">Preview</p>
        <div class="mt-4 rounded-[1.5rem] border border-slate-200 bg-white p-4">
            <p class="text-xs font-extrabold text-cyan-700">Category</p>
            <h3 class="mt-2 text-lg font-black text-slate-900">{{ old('name', 'New category') }}</h3>
            <p class="mt-2 text-sm font-semibold text-slate-600">{{ \Illuminate\Support\Str::limit(old('description', 'Write a short description...'), 120) }}</p>
            <div class="mt-4 flex items-center justify-between">
                <span class="inline-flex items-center rounded-xl bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">Ready</span>
                <span class="text-xs font-black text-slate-900 opacity-50">→</span>
            </div>
        </div>

        <div class="mt-6 rounded-[1.5rem] bg-white p-4 border border-slate-200">
            <p class="text-sm font-bold text-slate-800">Tips</p>
            <ul class="mt-2 space-y-2 text-sm font-semibold text-slate-600 list-disc pl-5">
                <li>Keep the name short and clear.</li>
                <li>Descriptions help search & filtering.</li>
            </ul>
        </div>
    </aside>
</div>
@endsection

