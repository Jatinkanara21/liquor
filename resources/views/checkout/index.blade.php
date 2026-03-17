@extends('layouts.app')

@section('title', 'Secure Checkout | ELM GROVE LIQUOR')

@section('content')
<div class="bg-modern-white min-h-screen py-20">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-heading text-modern-brown mb-12 border-b border-modern-gold/10 pb-8 uppercase tracking-[0.2em] leading-none">Security <span class="modern-gradient-text italic font-normal">Authentique</span></h1>
        
        <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
            @csrf
            <div class="flex flex-col lg:flex-row gap-12">
                
                <!-- Checkout Form -->
                <div class="w-full lg:w-2/3">
                    <!-- Contact Section -->
                    <div class="glass-card p-10 rounded-sm mb-10 border border-modern-gold/5 shadow-xl">
                        <h2 class="text-2xl font-heading text-modern-gold mb-10 flex items-center tracking-tight">
                            <span class="w-10 h-10 rounded-full bg-modern-brown text-white flex items-center justify-center mr-6 text-xs font-bold shadow-2xl font-sans">01</span>
                            Connoisseur Contact
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-modern-brown/60 text-xs uppercase tracking-widest mb-2">Full Name</label>
                                <input type="text" name="name" class="w-full bg-white border border-modern-brown/10 text-modern-brown px-4 py-3 rounded-sm focus:border-modern-gold focus:outline-none transition-all" value="{{ auth()->user()->name ?? '' }}" required>
                            </div>
                            
                            <div>
                                <label class="block text-modern-brown/60 text-xs uppercase tracking-widest mb-2">Email</label>
                                <input type="email" name="email" class="w-full bg-white border border-modern-brown/10 text-modern-brown px-4 py-3 rounded-sm focus:border-modern-gold focus:outline-none transition-all" value="{{ auth()->user()->email ?? '' }}" required>
                            </div>

                            <div class="md:col-span-2">
                                <label for="customer_phone" class="block text-modern-brown/60 text-xs uppercase tracking-widest mb-2">Phone Number</label>
                                <input type="tel" name="customer_phone" id="customer_phone" class="w-full bg-white border border-modern-brown/10 text-modern-brown px-4 py-3 rounded-sm focus:border-modern-gold focus:outline-none transition-all" value="{{ old('customer_phone') }}" required placeholder="+1 (555) 000-0000">
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Method -->
                    <div class="glass-card p-10 rounded-sm mb-10 border border-modern-gold/5 shadow-xl">
                        <h2 class="text-2xl font-heading text-modern-gold mb-10 flex items-center tracking-tight">
                            <span class="w-10 h-10 rounded-full bg-modern-brown text-white flex items-center justify-center mr-6 text-xs font-bold shadow-2xl font-sans">02</span>
                            Logistics Preference
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <label class="cursor-pointer relative">
                                <input type="radio" name="type" value="pickup" class="peer sr-only" checked onclick="toggleAddress(false)">
                                <div class="p-4 border border-modern-brown/10 rounded-sm bg-white peer-checked:border-modern-gold peer-checked:bg-modern-gold/5 transition-all">
                                    <div class="flex items-center mb-1">
                                        <div class="w-2 h-2 rounded-full bg-modern-tan peer-checked:bg-modern-gold mr-2"></div>
                                        <span class="text-modern-brown font-bold">Store Pickup</span>
                                    </div>
                                    <p class="text-modern-brown/60 text-sm ml-4">Pay at store. Ready in 1 hour.</p>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer relative">
                                <input type="radio" name="type" value="delivery" class="peer sr-only" onclick="toggleAddress(true)">
                                <div class="p-4 border border-modern-brown/10 rounded-sm bg-white peer-checked:border-modern-gold peer-checked:bg-modern-gold/5 transition-all">
                                    <div class="flex items-center mb-1">
                                        <div class="w-2 h-2 rounded-full bg-modern-tan peer-checked:bg-modern-gold mr-2"></div>
                                        <span class="text-modern-brown font-bold">Delivery</span>
                                    </div>
                                    <p class="text-modern-brown/60 text-sm ml-4">Cash/Card on delivery.</p>
                                </div>
                            </label>
                        </div>

                        <div id="address-field" style="display: none;">
                            <label for="address" class="block text-modern-brown/60 text-xs uppercase tracking-widest mb-2">Delivery Address</label>
                            <textarea name="address" id="address" rows="3" class="w-full bg-white border border-modern-brown/10 text-modern-brown px-4 py-3 rounded-sm focus:border-modern-gold focus:outline-none transition-all">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="glass-card p-10 rounded-sm border border-modern-gold/5 shadow-xl">
                        <h2 class="text-2xl font-heading text-modern-gold mb-10 flex items-center tracking-tight">
                            <span class="w-10 h-10 rounded-full bg-modern-brown text-white flex items-center justify-center mr-6 text-xs font-bold shadow-2xl font-sans">03</span>
                            Secure Handling
                        </h2>
                        
                        <div class="bg-modern-white border border-modern-gold/10 p-6 rounded-sm flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-modern-gold mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-modern-brown font-bold text-lg leading-none mb-1">Estate Collection Handling</p>
                                    <p class="text-modern-brown/60 text-[10px] uppercase tracking-widest font-bold">Secure physical payment upon handover.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dummy Credit Card Visual (Non-functional) -->
                        <div class="mt-8 border-t border-modern-gold/10 pt-8">
                            <p class="text-modern-text-muted text-[10px] uppercase tracking-widest mb-4 font-bold">Secure Encryption Active</p>
                            <div class="flex space-x-3 opacity-30">
                                <div class="w-12 h-8 bg-modern-gold/20 rounded-sm"></div>
                                <div class="w-12 h-8 bg-modern-gold/20 rounded-sm"></div>
                                <div class="w-12 h-8 bg-modern-gold/20 rounded-sm"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="glass-card p-8 rounded-sm sticky top-24 border border-modern-gold/10">
                        <h3 class="text-xl font-heading text-modern-brown mb-6 uppercase tracking-widest">Acquisition Summary</h3>
                        
                        <ul class="space-y-4 mb-6 max-h-60 overflow-y-auto custom-scrollbar pr-2">
                            @foreach(session('cart', []) as $details)
                                <li class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-white rounded-sm flex items-center justify-center mr-3 border border-modern-brown/5">
                                            @if(isset($details['image']) && $details['image'])
                                                <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="max-h-full max-w-full object-contain">
                                            @else
                                                <span class="text-xs text-gray-700">IMG</span>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-modern-brown text-sm font-bold font-heading line-clamp-1">{{ $details['name'] }}</h4>
                                            <p class="text-modern-text-muted text-xs">Qty: {{ $details['quantity'] }}</p>
                                        </div>
                                    </div>
                                    <div class="text-modern-gold font-bold text-sm">
                                        ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        
                        <div class="border-t border-modern-gold/10 pt-6 mb-8">
                            <div class="flex justify-between mb-3">
                                <span class="text-modern-text-muted text-sm">Subtotal</span>
                                <span class="text-modern-brown font-bold">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between mb-3">
                                <span class="text-modern-text-muted text-sm">Complimentary Delivery</span>
                                <span class="text-modern-gold text-xs font-bold uppercase tracking-widest">Included</span>
                            </div>
                            <div class="flex justify-between items-center mb-10 pt-6 border-t border-modern-gold/20">
                            <span class="text-xl font-bold text-modern-brown uppercase tracking-widest leading-none">Total Investment</span>
                            <span class="text-3xl font-heading text-modern-gold font-bold tracking-tighter leading-none">${{ number_format($total, 2) }}</span>
                        </div>

                        <button type="submit" class="w-full bg-modern-brown text-modern-gray font-bold uppercase tracking-[0.4em] py-6 hover:bg-modern-gold hover:text-modern-gray transition-all shadow-2xl rounded-sm text-xs">
                        Finalize Acquisition
                    </button>
                        
                        <p class="text-[9px] text-center text-modern-text-muted mt-6 uppercase tracking-widest leading-relaxed">
                            By placing your order, you agree to our Terms of Service. You must be 21+ to purchase spirits.
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
