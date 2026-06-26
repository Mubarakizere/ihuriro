@extends('layouts.app')

@section('title', 'Create Account | IHURIRO')

@section('content')
<div class="min-h-screen flex flex-row-reverse">
    <!-- Form Section -->
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white relative z-10">
        <div class="mx-auto w-full max-w-sm lg:w-96 animate-fade-in-up">
            <div class="mb-8 text-center lg:text-left">
                <a href="{{ route('home') }}" class="inline-block font-display text-4xl font-bold text-[#0f2557] hover:opacity-80 transition-opacity tracking-tight">IHURIRO</a>
            </div>
            <div class="text-center lg:text-left">
                <h2 class="text-3xl font-extrabold text-gray-900 font-display tracking-tight">Create Account</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Join us for a premium experience tailored just for you.
                </p>
            </div>

            <div class="mt-10">
                <form action="{{ route('register') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                        <div class="mt-1 relative">
                            <input type="text" name="name" id="name" required autofocus value="{{ old('name') }}"
                                class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0f2557] focus:border-transparent transition-all duration-200 ease-in-out bg-gray-50 hover:bg-white focus:bg-white text-gray-900">
                        </div>
                        @error('name') <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <div class="mt-1 relative">
                            <input type="email" name="email" id="email" required value="{{ old('email') }}"
                                class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0f2557] focus:border-transparent transition-all duration-200 ease-in-out bg-gray-50 hover:bg-white focus:bg-white text-gray-900">
                        </div>
                        @error('email') <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <div class="mt-1 relative">
                            <input type="password" name="password" id="password" required
                                class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0f2557] focus:border-transparent transition-all duration-200 ease-in-out bg-gray-50 hover:bg-white focus:bg-white text-gray-900">
                        </div>
                        @error('password') <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                        <div class="mt-1 relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0f2557] focus:border-transparent transition-all duration-200 ease-in-out bg-gray-50 hover:bg-white focus:bg-white text-gray-900">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-[#0f2557] hover:bg-[#051638] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0f2557] transform hover:-translate-y-0.5 transition-all duration-200">
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center text-sm text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-bold text-[#0f2557] hover:text-[#2851a6] hover:underline transition-colors">Sign In</a>
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
                <h3 class="text-3xl font-display font-bold mb-4">Your Journey Starts Here</h3>
                <p class="text-lg text-gray-200 leading-relaxed max-w-xl">Create your account today and unlock a world of personalized luxury, seamless booking, and exclusive benefits at IHURIRO.</p>
            </div>
        </div>
    </div>
</div>
@endsection
