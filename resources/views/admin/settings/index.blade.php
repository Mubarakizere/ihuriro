@extends('admin.layout')

@section('title', 'Site Settings')

@section('content')
<div class="max-w-4xl">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Site Settings</h1>
        <p class="text-slate-500 mt-1">Manage hero images and other site-wide settings.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- Services Page Hero Image --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">
                <h2 class="text-lg font-bold text-slate-800 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    Services Page Hero Image
                </h2>
                <p class="text-sm text-slate-500 mt-1 ml-[52px]">This image appears as the banner at the top of the Services page.</p>
            </div>
            
            <div class="p-6" x-data="imagePreview()">
                {{-- Current Image Preview --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-3">Current Image</label>
                    
                    @if($settings['services_hero_image'])
                        <div class="relative group rounded-xl overflow-hidden border border-slate-200 shadow-sm" id="current-hero-image">
                            <img src="{{ asset('storage/' . $settings['services_hero_image']) }}" 
                                 alt="Services Hero Image" 
                                 class="w-full h-56 object-cover">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                                <span class="opacity-0 group-hover:opacity-100 transition-opacity text-white font-semibold text-sm bg-black/50 px-4 py-2 rounded-lg">
                                    Upload new image to replace
                                </span>
                            </div>
                        </div>
                        
                        {{-- Remove button --}}
                        <label class="inline-flex items-center gap-2 mt-3 cursor-pointer text-sm text-red-600 hover:text-red-700 transition-colors">
                            <input type="checkbox" name="remove_services_hero_image" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-500">
                            Remove current image (revert to default)
                        </label>
                    @else
                        <div class="w-full h-56 rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 flex flex-col items-center justify-center text-slate-400">
                            <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-sm font-medium">No custom image set</p>
                            <p class="text-xs mt-1">Using default Unsplash image</p>
                        </div>
                    @endif
                </div>

                {{-- Upload New Image --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">Upload New Image</label>
                    <div class="relative">
                        <input type="file" 
                               name="services_hero_image" 
                               accept="image/jpeg,image/png,image/jpg,image/webp" 
                               @change="previewFile($event)"
                               class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:cursor-pointer file:transition-colors cursor-pointer border border-slate-200 rounded-xl">
                        <p class="mt-2 text-xs text-slate-400">Accepted formats: JPG, PNG, WEBP. Max size: 5MB. Recommended: 1920×600px or wider.</p>
                    </div>
                    
                    {{-- Preview --}}
                    <template x-if="preview">
                        <div class="mt-4">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Preview</label>
                            <div class="rounded-xl overflow-hidden border border-blue-200 shadow-sm ring-2 ring-blue-100">
                                <img :src="preview" alt="Preview" class="w-full h-56 object-cover">
                            </div>
                        </div>
                    </template>
                </div>

                @error('services_hero_image')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Save Button --}}
        <div class="flex justify-end">
            <button type="submit" class="px-8 py-3 bg-[#0f2557] text-white font-bold rounded-xl hover:bg-[#0a183d] transition-all shadow-md hover:shadow-lg focus:ring-4 focus:ring-blue-100 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Save Settings
            </button>
        </div>
    </form>
</div>

<script>
    function imagePreview() {
        return {
            preview: null,
            previewFile(event) {
                const file = event.target.files[0];
                if (file) {
                    this.preview = URL.createObjectURL(file);
                } else {
                    this.preview = null;
                }
            }
        }
    }
</script>
@endsection
