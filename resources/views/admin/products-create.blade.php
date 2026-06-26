@extends('admin.layout')

@section('title', 'Create Product')

@section('content')
<div class="mb-8">
    <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-gradient-to-br from-slate-950 to-cyan-900/20 shadow-2xl shadow-cyan-900/10">
        <div class="grid gap-6 p-6 sm:p-8 lg:grid-cols-[1fr_auto] lg:items-center">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-200">Products</p>
                <h1 class="mt-3 text-3xl font-black tracking-tight text-white sm:text-4xl">Create Product</h1>
                <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">
                    Add the details that will appear in the storefront.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 xl:grid-cols-[1.2fr_0.8fr]">
    <div class="rounded-[2rem] border border-slate-200/70 bg-white/90 p-6 shadow-xl shadow-slate-200/70">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full rounded-2xl border-slate-300 border px-4 py-3 focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-bold text-slate-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-2xl border-slate-300 border px-4 py-3 focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-bold text-slate-700 mb-1">Price ($)</label>
                        <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price') }}" required
                            class="w-full rounded-2xl border-slate-300 border px-4 py-3 focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 @error('price') border-red-500 @enderror">
                        @error('price')
                            <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-bold text-slate-700 mb-1">Category</label>
                        <select name="category_id" id="category_id" required
                            class="w-full rounded-2xl border-slate-300 border px-4 py-3 focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 @error('category_id') border-red-500 @enderror">
                            <option value="">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="image" class="block text-sm font-bold text-slate-700 mb-1">Product Image</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full rounded-2xl border-slate-300 border px-4 py-3 @error('image') border-red-500 @enderror">
                    @error('image')
                        <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-5 py-3 text-sm font-bold rounded-2xl border border-slate-200 text-slate-700 hover:bg-slate-50">Cancel</a>
                <button type="submit" class="px-5 py-3 text-sm font-bold rounded-2xl bg-cyan-400 text-slate-950 shadow-lg shadow-cyan-400/20 hover:bg-cyan-300">
                    Create Product
                </button>
            </div>
        </form>
    </div>

    <aside class="rounded-[2rem] border border-slate-200/70 bg-slate-50/70 p-6 shadow-xl shadow-slate-200/70">
        <p class="text-sm font-bold uppercase tracking-[0.2em] text-cyan-700">Preview</p>

        <div class="mt-4 overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white">
            <div class="h-36 bg-gradient-to-br from-cyan-100/40 to-amber-100/40 flex items-center justify-center">
                <svg class="w-14 h-14 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="p-4">
                <p class="text-xs font-extrabold text-cyan-700">Product</p>
                <h3 class="mt-2 text-lg font-black text-slate-900">{{ old('name', 'New product') }}</h3>
                <p class="mt-2 text-sm font-semibold text-slate-600">
                    ${{ old('price', '0') }}
                </p>
                <p class="mt-2 text-sm font-semibold text-slate-600">
                    {{ \Illuminate\Support\Str::limit(old('description', 'Product description...'), 90) }}
                </p>
            </div>
        </div>

        <div class="mt-6 rounded-[1.5rem] bg-white p-4 border border-slate-200">
            <p class="text-sm font-bold text-slate-800">Best practices</p>
            <ul class="mt-2 space-y-2 text-sm font-semibold text-slate-600 list-disc pl-5">
                <li>Use clear product names.</li>
                <li>Add a short, helpful description.</li>
                <li>Upload a high-quality image.</li>
            </ul>
        </div>
    </aside>
</div>
@endsection

