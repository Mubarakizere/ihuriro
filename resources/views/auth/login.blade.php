@extends('layouts.app')

@section('title', 'Sign In | IHURIRO')

@section('content')
<div class="min-h-screen flex">
    <!-- Form Section -->
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white relative z-10">
        <div class="mx-auto w-full max-w-sm lg:w-96 animate-fade-in-up">
            <div class="mb-8 text-center lg:text-left">
                <a href="{{ route('home') }}" class="inline-block font-display text-4xl font-bold text-[#0f2557] hover:opacity-80 transition-opacity tracking-tight">IHURIRO</a>
            </div>
            <div class="text-center lg:text-left">
                <h2 class="text-3xl font-extrabold text-gray-900 font-display tracking-tight">Welcome Back</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Sign in to manage your appointments and discover premium beauty.
                </p>
            </div>

            <div class="mt-10">
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <div class="mt-1 relative">
                            <input type="email" name="email" id="email" required autofocus value="{{ old('email') }}"
                                class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0f2557] focus:border-transparent transition-all duration-200 ease-in-out bg-gray-50 hover:bg-white focus:bg-white text-gray-900">
                        </div>
                        @error('email') <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="font-medium text-[#0f2557] hover:text-[#2851a6] transition-colors">
                                    Forgot password?
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="mt-1">
                            <input type="password" name="password" id="password" required
                                class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0f2557] focus:border-transparent transition-all duration-200 ease-in-out bg-gray-50 hover:bg-white focus:bg-white text-gray-900">
                        </div>
                        @error('password') <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-[#0f2557] focus:ring-[#0f2557] border-gray-300 rounded cursor-pointer transition-colors">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700 cursor-pointer">
                            Remember me
                        </label>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-[#0f2557] hover:bg-[#051638] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0f2557] transform hover:-translate-y-0.5 transition-all duration-200">
                            Sign In
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center text-sm text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="font-bold text-[#0f2557] hover:text-[#2851a6] hover:underline transition-colors">Create Account</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Image Section -->
    <div class="hidden lg:block relative w-0 flex-1 overflow-hidden">
        <img class="absolute inset-0 h-full w-full object-cover transform hover:scale-105 transition-transform duration-1000 ease-out" src="{{ asset('images/auth-bg.png') }}" alt="Premium Salon Interior">
        <div class="absolute inset-0 bg-[#0f2557] mix-blend-multiply opacity-30"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0f2557] via-transparent to-transparent opacity-80"></div>
        <div class="absolute bottom-0 left-0 right-0 p-12 text-white">
            <div class="animate-fade-in-up" style="animation-delay: 0.3s;">
                <h3 class="text-3xl font-display font-bold mb-4">Elevate Your Beauty Routine</h3>
                <p class="text-lg text-gray-200 leading-relaxed max-w-xl">Join the exclusive IHURIRO community and experience a new standard of personalized care, luxury treatments, and uncompromising quality.</p>
            </div>
        </div>
    </div>
</div>
@endsection
