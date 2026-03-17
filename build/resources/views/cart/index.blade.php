@extends('layouts.app')

@section('title', 'Your Cart | ELM GROVE LIQUOR')

@section('content')
<div class="bg-black-900 min-h-screen py-10">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-heading text-white mb-8 border-b border-white/10 pb-4">Shopping Cart</h1>

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
                            <div class="flex flex-col sm:flex-row items-center bg-black-800 border border-white/5 p-6 rounded-sm hover:border-gold-500/20 transition-colors">
                                <!-- Image -->
                                <div class="w-full sm:w-24 h-24 flex-shrink-0 bg-black-950 flex items-center justify-center p-2 mb-4 sm:mb-0">
                                    @if(isset($details['image']) && $details['image'])
                                        <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="max-h-full max-w-full object-contain">
                                    @else
                                        <img src="https://placehold.co/100x100?text={{ urlencode($details['name']) }}" alt="{{ $details['name'] }}" class="max-h-full max-w-full object-contain">
                                    @endif
                                </div>

                                <!-- Details -->
                                <div class="flex-1 sm:ml-6 text-center sm:text-left">
                                    <h3 class="text-lg font-heading text-white mb-1"><a href="{{ route('shop.show', \Illuminate\Support\Str::slug($details['name'])) }}" class="hover:text-gold-500 transition-colors">{{ $details['name'] }}</a></h3>
                                    <p class="text-gold-500 font-bold">${{ number_format($details['price'], 2) }}</p>
                                </div>

                                <!-- Quantity -->
                                <div class="flex items-center mt-4 sm:mt-0">
                                    <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 bg-black-950 border border-white/10 text-white text-center py-2 rounded-sm focus:border-gold-500 focus:outline-none">
                                        <button type="submit" class="ml-2 text-gray-400 hover:text-white transition-colors" title="Update">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                <!-- Subtotal -->
                                <div class="mt-4 sm:mt-0 sm:ml-8 w-24 text-center sm:text-right">
                                    <p class="text-white font-bold">${{ number_format($details['price'] * $details['quantity'], 2) }}</p>
                                </div>

                                <!-- Remove -->
                                <div class="mt-4 sm:mt-0 sm:ml-8">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="text-red-500 hover:text-red-400 transition-colors p-2" title="Remove">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-8 flex justify-between">
                        <a href="{{ route('shop.index') }}" class="text-gold-500 hover:text-white transition-colors flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="glass p-8 rounded-sm sticky top-24">
                        <h3 class="text-xl font-heading text-white mb-6">Order Summary</h3>
                        
                        <div class="flex justify-between mb-4 pb-4 border-b border-white/10">
                            <span class="text-gray-400">Subtotal</span>
                            <span class="text-white">${{ number_format($total, 2) }}</span>
                        </div>
                        
                        <div class="flex justify-between mb-4 pb-4 border-b border-white/10">
                            <span class="text-gray-400">Shipping</span>
                            <span class="text-white italic text-sm">Calculated at checkout</span>
                        </div>

                        <div class="flex justify-between items-center mb-8">
                            <span class="text-lg font-bold text-white">Total</span>
                            <span class="text-2xl font-heading text-gold-500 font-bold">${{ number_format($total, 2) }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="block w-full text-center bg-gold-600 text-white font-semibold uppercase tracking-widest py-4 hover:bg-gold-500 transition-all shadow-lg hover:shadow-gold-500/20">
                            Proceed to Checkout
                        </a>
                        
                        <div class="mt-6 flex justify-center space-x-4 opacity-50">
                            <span class="text-xs text-gray-500" title="Secure Payment"><svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14h-2v-2h2v2zm0-4h-2V7h2v5z"/></svg></span>
                            <span class="text-xs text-gray-500">Secure Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-20 text-center glass rounded-sm">
                <div class="bg-black-900 p-6 rounded-full mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gold-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-heading text-white mb-2">Your cart is empty</h3>
                <p class="text-gray-400 mb-8 max-w-sm">Looks like you haven't added any premium spirits to your cart yet.</p>
                <a href="{{ route('shop.index') }}" class="px-8 py-3 bg-gold-600 text-white font-semibold uppercase tracking-widest hover:bg-gold-500 transition-all">
                    Browse Collection
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
