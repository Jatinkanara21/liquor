@extends('layouts.app')

@section('title', 'Secure Checkout | Elite Liquor House')

@section('content')
<div class="bg-black-900 min-h-screen py-10">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-heading text-white mb-8 border-b border-white/10 pb-4">Secure Checkout</h1>
        
        <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
            @csrf
            <div class="flex flex-col lg:flex-row gap-12">
                
                <!-- Checkout Form -->
                <div class="w-full lg:w-2/3">
                    <!-- Contact Section -->
                    <div class="glass p-8 rounded-sm mb-8">
                        <h2 class="text-xl font-heading text-gold-500 mb-6 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-gold-500/10 flex items-center justify-center mr-3 text-sm font-bold border border-gold-500/20">1</span>
                            Contact Information
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="customer_name" class="block text-gray-400 text-sm mb-2">Full Name</label>
                                <input type="text" name="customer_name" id="customer_name" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required>
                            </div>
                            
                            <div>
                                <label for="customer_email" class="block text-gray-400 text-sm mb-2">Email Address</label>
                                <input type="email" name="customer_email" id="customer_email" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20" value="{{ old('customer_email', auth()->user()->email ?? '') }}" required>
                            </div>

                            <div class="md:col-span-2">
                                <label for="customer_phone" class="block text-gray-400 text-sm mb-2">Phone Number</label>
                                <input type="tel" name="customer_phone" id="customer_phone" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20" value="{{ old('customer_phone') }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Method -->
                    <div class="glass p-8 rounded-sm mb-8">
                        <h2 class="text-xl font-heading text-gold-500 mb-6 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-gold-500/10 flex items-center justify-center mr-3 text-sm font-bold border border-gold-500/20">2</span>
                            Delivery Method
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <label class="cursor-pointer relative">
                                <input type="radio" name="type" value="pickup" class="peer sr-only" checked onclick="toggleAddress(false)">
                                <div class="p-4 border border-white/10 rounded-sm bg-black-950 peer-checked:border-gold-500 peer-checked:bg-gold-500/5 transition-all">
                                    <div class="flex items-center mb-1">
                                        <div class="w-2 h-2 rounded-full bg-white peer-checked:bg-gold-500 mr-2"></div>
                                        <span class="text-white font-bold">Store Pickup</span>
                                    </div>
                                    <p class="text-gray-400 text-sm ml-4">Pay at store. Ready in 1 hour.</p>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer relative">
                                <input type="radio" name="type" value="delivery" class="peer sr-only" onclick="toggleAddress(true)">
                                <div class="p-4 border border-white/10 rounded-sm bg-black-950 peer-checked:border-gold-500 peer-checked:bg-gold-500/5 transition-all">
                                    <div class="flex items-center mb-1">
                                        <div class="w-2 h-2 rounded-full bg-white peer-checked:bg-gold-500 mr-2"></div>
                                        <span class="text-white font-bold">Delivery</span>
                                    </div>
                                    <p class="text-gray-400 text-sm ml-4">Cash/Card on delivery.</p>
                                </div>
                            </label>
                        </div>

                        <div id="address-field" style="display: none;">
                            <label for="address" class="block text-gray-400 text-sm mb-2">Delivery Address</label>
                            <textarea name="address" id="address" rows="3" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="glass p-8 rounded-sm">
                        <h2 class="text-xl font-heading text-gold-500 mb-6 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-gold-500/10 flex items-center justify-center mr-3 text-sm font-bold border border-gold-500/20">3</span>
                            Payment Information
                        </h2>
                        
                        <div class="bg-black-950 border border-white/10 p-4 rounded-sm flex items-center justify-between opacity-75">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-white font-bold text-sm">Payment Handling</p>
                                    <p class="text-gray-500 text-xs">Payment will be collected upon pickup or delivery.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dummy Credit Card Visual (Non-functional) -->
                        <div class="mt-6 border-t border-white/10 pt-6">
                            <p class="text-gray-400 text-sm mb-4">Secure Encryption</p>
                            <div class="flex space-x-2">
                                <div class="w-10 h-6 bg-white/10 rounded"></div>
                                <div class="w-10 h-6 bg-white/10 rounded"></div>
                                <div class="w-10 h-6 bg-white/10 rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="glass p-8 rounded-sm sticky top-24">
                        <h3 class="text-xl font-heading text-white mb-6">Order Summary</h3>
                        
                        <ul class="space-y-4 mb-6 max-h-60 overflow-y-auto custom-scrollbar pr-2">
                            @foreach(session('cart', []) as $details)
                                <li class="flex justify-between items-start">
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 bg-black-950 rounded-sm flex items-center justify-center mr-3 border border-white/5">
                                            @if(isset($details['image']) && $details['image'])
                                                <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="max-h-full max-w-full object-contain">
                                            @else
                                                <span class="text-xs text-gray-700">IMG</span>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-white text-sm font-medium line-clamp-1">{{ $details['name'] }}</p>
                                            <p class="text-gray-500 text-xs">Qty: {{ $details['quantity'] }}</p>
                                        </div>
                                    </div>
                                    <span class="text-gray-300 text-sm">${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                                </li>
                            @endforeach
                        </ul>
                        
                        <div class="border-t border-white/10 pt-4 mb-6">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-400">Subtotal</span>
                                <span class="text-white">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-400">Shipping</span>
                                <span class="text-white text-sm">Free</span>
                            </div>
                            <div class="flex justify-between items-center mt-4 pt-4 border-t border-white/10">
                                <span class="text-lg font-bold text-white">Total</span>
                                <span class="text-2xl font-heading text-gold-500 font-bold">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gold-600 text-white font-semibold uppercase tracking-widest py-4 hover:bg-gold-500 transition-all shadow-[0_4px_14px_0_rgba(184,134,11,0.39)] hover:shadow-[0_6px_20px_rgba(184,134,11,0.23)]">
                            Place Order
                        </button>
                        
                        <p class="text-xs text-center text-gray-500 mt-4">
                            By placing your order, you agree to our Terms of Service and Privacy Policy. You must be 21+ to purchase.
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleAddress(show) {
        const addressField = document.getElementById('address-field');
        const addressInput = document.getElementById('address');
        
        if (show) {
            addressField.style.display = 'block';
            addressInput.required = true;
            addressField.classList.add('animate-fade-in-up');
        } else {
            addressField.style.display = 'none';
            addressInput.required = false;
        }
    }
</script>
@endsection
