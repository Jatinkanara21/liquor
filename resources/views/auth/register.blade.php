@extends('layouts.app')

@section('title', 'Register | ELM GROVE LIQUOR')

@section('content')
<div class="bg-modern-white min-h-screen py-20 flex items-center justify-center relative">
    <div class="absolute inset-0 z-0 text-center">
        <img src="{{ asset('images/defaults/store_interior.png') }}" alt="Background" class="w-full h-full object-cover opacity-10">
        <div class="absolute inset-0 bg-gradient-to-br from-modern-white via-modern-white/80 to-modern-tan/30"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-md mx-auto bg-white p-10 rounded-sm relative overflow-hidden shadow-2xl border border-modern-gold/10">
             <!-- Decorative Glow -->
             <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-modern-gold/10 rounded-full blur-3xl"></div>
             <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-modern-gold/10 rounded-full blur-3xl"></div>

            <div class="text-center mb-10 relative z-10">
                <h2 class="text-3xl font-heading text-modern-charcoal mb-2 uppercase tracking-widest">Join the Reserve</h2>
                <p class="text-modern-charcoal/60 text-[10px] uppercase tracking-[0.3em] font-bold">Access exclusive barrel releases</p>
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
                    <label for="name" class="block text-modern-charcoal/60 text-[10px] mb-2 uppercase tracking-[0.2em] font-bold">Full Name</label>
                    <input type="text" name="name" id="name" class="w-full bg-white border border-modern-charcoal/10 text-modern-charcoal px-4 py-3 rounded-sm focus:border-modern-gold focus:outline-none transition-all" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-modern-charcoal/60 text-[10px] mb-2 uppercase tracking-[0.2em] font-bold">Email Address</label>
                    <input type="email" name="email" id="email" class="w-full bg-white border border-modern-charcoal/10 text-modern-charcoal px-4 py-3 rounded-sm focus:border-modern-gold focus:outline-none transition-all" value="{{ old('email') }}" required>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-modern-charcoal/60 text-[10px] mb-2 uppercase tracking-[0.2em] font-bold">Password</label>
                    <input type="password" name="password" id="password" class="w-full bg-white border border-modern-charcoal/10 text-modern-charcoal px-4 py-3 rounded-sm focus:border-modern-gold focus:outline-none transition-all" required>
                </div>

                <div class="mb-10">
                    <label for="password_confirmation" class="block text-modern-charcoal/60 text-[10px] mb-2 uppercase tracking-[0.2em] font-bold">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full bg-white border border-modern-charcoal/10 text-modern-charcoal px-4 py-3 rounded-sm focus:border-modern-gold focus:outline-none transition-all" required>
                </div>

                <button type="submit" class="w-full bg-modern-charcoal text-modern-beige font-bold uppercase tracking-[0.4em] py-5 hover:bg-modern-gold hover:text-modern-beige transition-all shadow-2xl mb-8 text-[10px]">
                    Create Account
                </button>

                <p class="text-center text-modern-charcoal/60 text-[10px] uppercase tracking-widest">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-modern-gold hover:text-modern-charcoal font-bold transition-colors ml-2">Sign In</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
