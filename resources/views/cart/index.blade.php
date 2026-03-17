@extends('layouts.app')

@section('title', 'Your Cart | ELM GROVE LIQUOR')

@section('content')
<div class="bg-modern-gray min-h-screen py-20">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-heading text-modern-brown mb-12 border-b border-modern-gold/10 pb-8 uppercase tracking-widest leading-none">Your <span class="modern-gradient-text italic">Private Reserve</span></h1>

        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-sm mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('cart') && count(session('cart')) > 0)
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Cart Items -->
                <div class="w-full lg:w-2/3">
                    <div class="space-y-6">
                        @foreach(session('cart') as $id => $details)
                            <div class="grid grid-cols-1 md:grid-cols-6 items-center bg-white border border-modern-gold/5 p-8 rounded-sm hover:border-modern-gold/20 transition-all shadow-sm">
                                <!-- Image -->
                                <div class="col-span-3 flex items-center mb-4 md:mb-0">
                                    <div class="w-20 h-24 bg-modern-gray/30 flex items-center justify-center p-2 rounded-sm shrink-0">
                                        @if(isset($details['image']) && $details['image'])
                                            <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="max-h-full object-contain">
                                        @else
                                            @php
                                                $pName = strtolower($details['name']);
                                                $fallback = 'vodka_default.png';
                                                if(str_contains($pName, 'whiskey') || str_contains($pName, 'scotch')) $fallback = 'whiskey_default.png';
                                                elseif(str_contains($pName, 'wine') || str_contains($pName, 'merlot')) $fallback = 'wine_default.png';
                                                elseif(str_contains($pName, 'tequila')) $fallback = 'tequila_default.png';
                                                elseif(str_contains($pName, 'champagne') || str_contains($pName, 'dom')) $fallback = 'champagne_default.png';
                                            @endphp
                                            <img src="{{ asset('images/defaults/' . $fallback) }}" alt="{{ $details['name'] }}" class="max-h-full object-contain">
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-modern-brown font-heading font-bold text-lg leading-tight"><a href="{{ route('shop.show', \Illuminate\Support\Str::slug($details['name'])) }}" class="hover:text-modern-gold transition-colors">{{ $details['name'] }}</a></h4>
                                        <form action="{{ route('cart.remove') }}" method="POST" class="mt-2">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="text-modern-brown/50 hover:text-red-600 text-[10px] uppercase tracking-widest transition-colors flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Price, Quantity, Subtotal -->
                                <div class="col-span-3 grid grid-cols-3 gap-4 items-center mt-4 md:mt-0">
                                    <div class="text-center font-bold text-modern-brown">${{ number_format($details['price'], 2) }}</div>
                                    <div class="text-center">
                                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center justify-center">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 bg-modern-gray/50 border border-modern-brown/10 text-modern-brown text-center py-2 rounded-sm focus:border-modern-gold focus:outline-none">
                                            <button type="submit" class="ml-2 text-modern-brown/50 hover:text-modern-gold transition-colors" title="Update">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="text-right font-bold text-modern-gold">${{ number_format($details['price'] * $details['quantity'], 2) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-12 flex justify-between items-center bg-modern-gray/30 p-8 rounded-sm">
                        <a href="{{ route('shop.index') }}" class="text-modern-brown hover:text-modern-gold transition-colors font-bold uppercase tracking-widest text-xs flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                            Continue Browsing
                        </a>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white p-10 rounded-sm shadow-xl sticky top-28 border border-modern-gold/10">
                        <h3 class="text-2xl font-heading text-modern-brown mb-8 uppercase tracking-widest border-b border-modern-gold/10 pb-4">Bar Summary</h3>
                        
                        <div class="flex justify-between mb-4 pb-4 border-b border-modern-gold/10">
                            <span class="text-modern-brown/60 font-medium text-xs uppercase tracking-widest">Initial Investment</span>
                            <span class="text-modern-brown font-bold">${{ number_format($total, 2) }}</span>
                        </div>
                        
                        <div class="flex justify-between mb-8 pb-4 border-b border-modern-gold/10">
                            <span class="text-modern-text-muted italic text-sm">Logistics & duties calculated at next step</span>
                        </div>

                        <div class="flex justify-between items-center mb-10">
                            <span class="text-xl font-bold text-modern-brown uppercase tracking-widest leading-none">Total Investment</span>
                            <span class="text-3xl font-heading text-modern-gold font-bold tracking-tighter leading-none">${{ number_format($total, 2) }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="block w-full bg-modern-brown text-modern-gray text-center font-bold uppercase tracking-[0.3em] py-6 hover:bg-modern-gold transition-all shadow-2xl rounded-sm text-xs">
                        Finalize Acquisition
                    </a>
                        
                        <div class="mt-8 flex justify-center items-center space-x-3 opacity-60">
                            <svg class="h-4 w-4 text-modern-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14h-2v-2h2v2zm0-4h-2V7h2v5z"/></svg>
                            <span class="text-[10px] text-modern-brown/60 uppercase tracking-[0.2em] font-bold">Secure Acquisition</span>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-32 text-center bg-white border border-modern-gold/10 rounded-sm shadow-sm">
                <div class="bg-modern-gray/20 p-8 rounded-full mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-modern-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-3xl font-heading text-modern-brown mb-4 uppercase tracking-widest">Your seleciton is empty</h3>
                <p class="text-modern-text-muted mb-12 max-w-sm italic">Explore our curated collections of the world's finest whiskies and spirits.</p>
                <a href="{{ route('shop.index') }}" class="px-12 py-5 bg-modern-brown text-white font-bold uppercase tracking-[0.3em] hover:bg-modern-gold transition-all shadow-xl text-xs rounded-sm">
                    Browse Collection
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
