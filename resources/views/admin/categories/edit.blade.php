@extends('admin.layout')

@section('title', 'Edit Category')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4 animate-fade-in" style="animation-delay: 0.05s;">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Category</h1>
        <p class="text-sm text-slate-500 mt-1">Update category details and cover image.</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors shadow-sm">
            Cancel
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden max-w-2xl animate-fade-in" style="animation-delay: 0.1s;">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Category Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Description</label>
                <textarea name="description" rows="3" class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white">{{ old('description', $category->description) }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Cover Image</label>
                @if($category->image_path)
                    <div class="mb-3">
                        <img src="{{ $category->image_path }}" class="h-32 w-auto rounded-lg border border-slate-200 object-cover">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-50 file:text-slate-700 hover:file:bg-slate-100 border border-slate-200 rounded-lg focus:outline-none">
                <p class="mt-1.5 text-xs text-slate-500">Leave blank to keep the current image. PNG, JPG, WEBP up to 5MB.</p>
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex justify-end">
            <button type="submit" class="bg-[#0f2557] text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-[#0a183d] transition-colors shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                Update Category
            </button>
        </div>
    </form>
</div>
@endsection
