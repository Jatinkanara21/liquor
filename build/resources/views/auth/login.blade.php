@extends('layouts.app')

@section('title', 'Login | ELM GROVE LIQUOR')

@section('content')
<div class="bg-black-900 min-h-screen py-20 flex items-center justify-center">
    <div class="container mx-auto px-6">
        <div class="max-w-md mx-auto glass p-10 rounded-sm relative overflow-hidden">
             <!-- Decorative Glow -->
             <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-gold-500/10 rounded-full blur-3xl"></div>
             <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-gold-500/10 rounded-full blur-3xl"></div>

            <div class="text-center mb-10 relative z-10">
                <h2 class="text-3xl font-heading text-white mb-2">Welcome Back</h2>
                <p class="text-gray-400">Access your premium collection.</p>
            </div>

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-sm mb-6 relative z-10">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="relative z-10">
                @csrf
                
                <div class="mb-6">
                    <label for="email" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Email Address</label>
                    <input type="email" name="email" id="email" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20 transition-all" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-8">
                    <label for="password" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide flex justify-between">
                        <span>Password</span>
                        {{-- <a href="#" class="text-gold-500 hover:text-white text-xs lowercase italic">Forgot Password?</a> --}}
                    </label>
                    <input type="password" name="password" id="password" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20 transition-all" required>
                </div>

                <div class="flex items-center mb-8">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 bg-black-950 border-gray-600 rounded focus:ring-gold-500 text-gold-600">
                    <label for="remember" class="ml-2 text-sm text-gray-400">Remember me</label>
                </div>

                <button type="submit" class="w-full bg-gold-600 text-white font-semibold uppercase tracking-widest py-4 hover:bg-gold-500 transition-all shadow-[0_4px_14px_0_rgba(184,134,11,0.39)] hover:shadow-[0_6px_20px_rgba(184,134,11,0.23)] mb-6">
                    Sign In
                </button>

                <p class="text-center text-gray-400 text-sm">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-gold-500 hover:text-white font-semibold transition-colors">Create one</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
