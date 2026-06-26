@extends('admin.layout')

@section('title', 'Create Category')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <p class="text-sm text-slate-500">Add a new category</p>
        <h1 class="text-3xl font-semibold">Create Category</h1>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Category Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full rounded-lg border-slate-300 border px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="dec" class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                    <textarea name="dec" id="dec" rows="4" required
                        class="w-full rounded-lg border-slate-300 border px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('dec') border-red-500 @enderror">{{ old('dec') }}</textarea>
                    @error('dec')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Create Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
