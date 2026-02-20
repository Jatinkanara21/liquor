@extends('layouts.app')

@section('title', 'Register | Elite Liquor House')

@section('content')
<div class="bg-black-900 min-h-screen py-20 flex items-center justify-center">
    <div class="container mx-auto px-6">
        <div class="max-w-md mx-auto glass p-10 rounded-sm relative overflow-hidden">
             <!-- Decorative Glow -->
             <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-gold-500/10 rounded-full blur-3xl"></div>
             <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-gold-500/10 rounded-full blur-3xl"></div>

            <div class="text-center mb-10 relative z-10">
                <h2 class="text-3xl font-heading text-white mb-2">Join the Elite</h2>
                <p class="text-gray-400">Create an account to unlock exclusive offers.</p>
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

            <form action="{{ route('register') }}" method="POST" class="relative z-10">
                @csrf
                
                <div class="mb-6">
                    <label for="name" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Full Name</label>
                    <input type="text" name="name" id="name" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20 transition-all" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Email Address</label>
                    <input type="email" name="email" id="email" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20 transition-all" value="{{ old('email') }}" required>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Password</label>
                    <input type="password" name="password" id="password" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20 transition-all" required>
                </div>

                <div class="mb-8">
                    <label for="password_confirmation" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20 transition-all" required>
                </div>

                <button type="submit" class="w-full bg-gold-600 text-white font-semibold uppercase tracking-widest py-4 hover:bg-gold-500 transition-all shadow-[0_4px_14px_0_rgba(184,134,11,0.39)] hover:shadow-[0_6px_20px_rgba(184,134,11,0.23)] mb-6">
                    Create Account
                </button>

                <p class="text-center text-gray-400 text-sm">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-gold-500 hover:text-white font-semibold transition-colors">Sign In</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
