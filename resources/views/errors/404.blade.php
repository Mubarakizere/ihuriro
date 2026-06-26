@extends('layouts.app')

@section('title', 'Page Not Found - IHURIRO')

@section('content')
<section class="min-h-[70vh] flex items-center justify-center bg-white relative overflow-hidden px-4 sm:px-6 lg:px-8">
    <!-- Decorative background elements -->
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-blue-50 blur-3xl opacity-50"></div>
    <div class="absolute top-1/2 right-0 w-64 h-64 rounded-full bg-slate-100 blur-3xl opacity-50 translate-x-1/2"></div>
    
    <div class="max-w-2xl mx-auto text-center relative z-10 mt-16 mb-16">
        <div class="font-display text-9xl md:text-[12rem] font-extrabold text-slate-100 mb-4 drop-shadow-sm select-none leading-none">404</div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full flex items-center justify-center z-10 pointer-events-none pb-20 md:pb-32">
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight font-display bg-white/60 backdrop-blur-md px-8 py-3 rounded-2xl shadow-sm border border-white/50">Page Not Found</h1>
        </div>
        
        <p class="mt-8 text-lg md:text-xl text-slate-500 mb-10 max-w-lg mx-auto leading-relaxed">
            Oops! It seems you've ventured into uncharted territory. The page you're looking for doesn't exist or has been moved.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('home') }}" class="w-full sm:w-auto px-8 py-4 bg-slate-900 text-white rounded-xl font-semibold text-lg hover:bg-slate-800 transition-all hover:-translate-y-1 shadow-lg shadow-slate-900/10">
                Return Home
            </a>
            <a href="{{ route('services.index') }}" class="w-full sm:w-auto px-8 py-4 bg-white border border-slate-200 text-slate-700 rounded-xl font-semibold text-lg hover:bg-slate-50 transition-all hover:-translate-y-1">
                Explore Services
            </a>
        </div>
    </div>
</section>
@endsection
