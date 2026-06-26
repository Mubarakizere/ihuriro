@extends('admin.layout')

@section('title', 'Manage Categories')

@section('content')
<div x-data="{
    showModal: false,
    modalTitle: '',
    modalMessage: '',
    modalAction: '',
    modalMethod: 'DELETE',
    confirmText: 'Delete',
    confirmColor: 'bg-red-600 hover:bg-red-700 focus:ring-red-500',
    openModal(title, message, action, method, confirmBtn, color) {
        this.modalTitle = title;
        this.modalMessage = message;
        this.modalAction = action;
        this.modalMethod = method;
        this.confirmText = confirmBtn;
        this.confirmColor = color;
        this.showModal = true;
    }
}">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4 animate-fade-in" style="animation-delay: 0.05s;">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Categories</h1>
            <p class="text-sm text-slate-500 mt-1">Manage service categories and their display images.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.categories.create') }}" class="px-4 py-2.5 bg-[#0f2557] text-white rounded-lg text-sm font-medium hover:bg-[#0a183d] transition-colors shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add Category
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 animate-fade-in" style="animation-delay: 0.1s;">
        @forelse($categories as $category)
        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group flex flex-col">
            <div class="aspect-w-16 aspect-h-9 bg-slate-100 h-48 relative overflow-hidden">
                @if($category->image_path)
                    <img src="{{ $category->image_path }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="flex items-center justify-center h-full text-slate-400">
                        <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
                
                <div class="absolute top-3 right-3 flex gap-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="p-2 bg-white/90 backdrop-blur text-slate-700 rounded-lg hover:text-blue-600 hover:bg-white transition-colors shadow-sm" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </a>
                    <button type="button" @click.prevent="openModal('Delete Category', 'Are you sure you want to permanently delete this category? This will also affect all services tied to it.', '{{ route('admin.categories.destroy', $category) }}', 'DELETE', 'Delete Category', 'bg-red-600 hover:bg-red-700 focus:ring-red-500')" class="p-2 bg-white/90 backdrop-blur text-red-600 rounded-lg hover:text-red-700 hover:bg-white transition-colors shadow-sm" title="Delete">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            </div>
            <div class="p-5 flex-1 flex flex-col">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-slate-900 text-lg">{{ $category->name }}</h3>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                        {{ $category->services_count }} Services
                    </span>
                </div>
                <p class="text-sm text-slate-600 line-clamp-2 flex-1">{{ $category->description ?? 'No description provided.' }}</p>
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <p class="text-xs text-slate-400 font-mono">{{ $category->slug }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center border-2 border-dashed border-slate-200 rounded-xl bg-slate-50">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white shadow-sm mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h3 class="text-sm font-medium text-slate-900">No categories found</h3>
            <p class="mt-1 text-sm text-slate-500 mb-4">Get started by creating your first service category.</p>
            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-[#0f2557] hover:bg-[#0a183d] transition-colors">
                Add Category
            </a>
        </div>
        @endforelse
    </div>

    <!-- Reusable Alpine Modal -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="showModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200">
                <form :action="modalAction" method="POST">
                    @csrf
                    <input type="hidden" name="_method" :value="modalMethod">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-slate-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-slate-900" id="modal-title" x-text="modalTitle"></h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500" x-text="modalMessage"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100">
                        <button type="submit" :class="confirmColor" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm transition-colors" x-text="confirmText">
                        </button>
                        <button type="button" @click="showModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0f2557] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
