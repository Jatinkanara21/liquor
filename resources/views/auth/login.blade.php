@extends('layouts.app')

@section('title', 'Login | ELM GROVE LIQUOR')

@section('content')
<div class="bg-modern-white min-h-screen py-20 flex items-center justify-center">
    <div class="container mx-auto px-6">
        <div class="max-w-md mx-auto bg-white p-10 rounded-sm relative overflow-hidden shadow-2xl border border-modern-gold/10">
             <!-- Decorative Glow -->
             <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/defaults/store_interior.png') }}" alt="Background" class="w-full h-full object-cover opacity-10">
                <div class="absolute inset-0 bg-gradient-to-br from-modern-white via-modern-white/80 to-modern-tan/30"></div>
            </div>

            <div class="text-center mb-10 relative z-10">
                <h2 class="text-3xl font-heading text-modern-charcoal mb-2">Welcome Back</h2>
                <p class="text-modern-charcoal/60 text-sm italic uppercase tracking-widest">Access your private reserve.</p>
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
                    <label for="email" class="block text-modern-charcoal/60 text-[10px] mb-2 uppercase tracking-[0.2em] font-bold">Email Address</label>
                    <input type="email" name="email" id="email" class="w-full bg-white border border-modern-charcoal/10 text-modern-charcoal px-4 py-3 rounded-sm focus:border-modern-gold focus:outline-none transition-all" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-8">
                    <label for="password" class="block text-modern-charcoal/60 text-[10px] mb-2 uppercase tracking-[0.2em] font-bold">Password</label>
                    <input type="password" name="password" id="password" class="w-full bg-white border border-modern-charcoal/10 text-modern-charcoal px-4 py-3 rounded-sm focus:border-modern-gold focus:outline-none transition-all" required>
                </div>

                <div class="mb-6">
                    <button type="submit" class="w-full bg-modern-charcoal text-modern-beige py-4 rounded-sm hover:bg-modern-gold hover:text-modern-beige transition-all uppercase font-bold tracking-[0.3em] text-[10px] shadow-2xl">Login to Reserve</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
