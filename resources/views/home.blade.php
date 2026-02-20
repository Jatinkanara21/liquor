@extends('layouts.app')

@section('title', 'Elite Liquor House | Premium Spirits')

@section('content')
<!-- Hero Section -->
<div class="relative h-screen flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1569937756-32af16a79016?q=80&w=2670&auto=format&fit=crop" alt="Premium Liquor Background" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-b from-black-900/10 via-black-900/60 to-black-900"></div>
    </div>
    
    <div class="container relative z-10 px-6 text-center">
        <div class="animate-fade-in-up">
            <h2 class="text-gold-300 tracking-[0.2em] text-sm uppercase mb-4">Est. 2024</h2>
            <h1 class="text-5xl md:text-7xl font-heading font-bold text-white mb-6 leading-tight">
                Refined Taste,<br><span class="text-gold-500">Unmatched Luxury</span>
            </h1>
            <p class="text-gray-300 text-lg md:text-xl max-w-2xl mx-auto mb-10 font-light">
                Discover our curated collection of rare whiskies, fine wines, and premium spirits. 
                Elevate your collection today.
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="{{ route('shop.index') }}" class="px-8 py-3 bg-gold-600 text-white font-semibold uppercase tracking-widest hover:bg-gold-500 transition-all duration-300 shadow-[0_0_20px_rgba(184,134,11,0.3)]">
                    Shop Collection
                </a>
                <a href="{{ route('about') }}" class="px-8 py-3 bg-transparent border border-gold-500 text-gold-500 font-semibold uppercase tracking-widest hover:bg-gold-500 hover:text-white transition-all duration-300">
                    Our Story
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Collections Grid -->
<section class="py-20 bg-black-900">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-heading text-center text-gold-500 mb-16">Curated Collections</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Whiskey -->
            <a href="{{ route('shop.category', 'whiskey') }}" class="group relative h-96 overflow-hidden rounded-sm glass-card hover:border-gold-500/50 transition-all duration-500">
                <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=2670&auto=format&fit=crop" alt="Whiskey" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black-950 via-transparent to-transparent opacity-90"></div>
                <div class="absolute bottom-0 left-0 p-8">
                    <h3 class="text-2xl font-heading text-white mb-2 group-hover:text-gold-400 transition-colors">Whiskey</h3>
                    <p class="text-gray-400 text-sm">Single Malt, Bourbon, Rye</p>
                </div>
            </a>

            <!-- Wine -->
            <a href="{{ route('shop.category', 'wine') }}" class="group relative h-96 overflow-hidden rounded-sm glass-card hover:border-gold-500/50 transition-all duration-500">
                <img src="https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?q=80&w=2670&auto=format&fit=crop" alt="Wine" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black-950 via-transparent to-transparent opacity-90"></div>
                <div class="absolute bottom-0 left-0 p-8">
                    <h3 class="text-2xl font-heading text-white mb-2 group-hover:text-gold-400 transition-colors">Fine Wines</h3>
                    <p class="text-gray-400 text-sm">Red, White, Sparkling</p>
                </div>
            </a>

            <!-- Premium -->
            <a href="{{ route('shop.category', 'premium-collection') }}" class="group relative h-96 overflow-hidden rounded-sm glass-card hover:border-gold-500/50 transition-all duration-500">
                <img src="https://images.unsplash.com/photo-1569937756-32af16a79016?q=80&w=2670&auto=format&fit=crop" alt="Premium Collection" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black-950 via-transparent to-transparent opacity-90"></div>
                <div class="absolute bottom-0 left-0 p-8">
                    <h3 class="text-2xl font-heading text-gold-500 mb-2 group-hover:text-white transition-colors">The Vault</h3>
                    <p class="text-gray-400 text-sm">Rare & Exclusive Bottles</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Staff Picks Section -->
<section class="py-20 bg-black-800 relative">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-5 pointer-events-none">
        <div class="absolute top-[-50%] left-[-50%] w-[200%] h-[200%] bg-[radial-gradient(circle,rgba(184,134,11,0.2)_0%,transparent_50%)]"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h4 class="text-gold-500 text-sm tracking-widest uppercase mb-2">Expert Selection</h4>
                <h2 class="text-3xl md:text-4xl font-heading text-white">Staff Picks</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="text-gold-500 hover:text-white transition-colors underline-offset-4 hover:underline hidden md:block">View All</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($staffPicks as $product)
                <div class="group block">
                    <div class="relative overflow-hidden rounded-sm bg-black-900 border border-white/5 group-hover:border-gold-500/30 transition-all duration-300">
                        <div class="aspect-[4/5] relative">
                            @if($product->image && !str_starts_with($product->image, 'http'))
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="https://images.unsplash.com/photo-1527281400683-1aadd77921fe?q=80&w=600&auto=format&fit=crop" alt="{{ $product->name }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                            @endif
                            <div class="absolute top-2 right-2 bg-gold-600 text-black text-xs font-bold px-2 py-1 uppercase tracking-wider">
                                Staff Pick
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-heading text-white group-hover:text-gold-500 transition-colors truncate">{{ $product->name }}</h3>
                            <p class="text-gray-400 text-sm mb-2">{{ $product->brand ?? 'Unknown Brand' }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-gold-500 font-bold">${{ number_format($product->price, 2) }}</span>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="name" value="{{ $product->name }}">
                                    <input type="hidden" name="price" value="{{ $product->price }}">
                                    <button type="submit" class="text-gray-400 hover:text-white transition-colors p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-20 bg-black-900">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-gold-500 text-6xl block mb-4">❝</span>
            <p class="text-2xl md:text-3xl font-heading text-white max-w-4xl mx-auto leading-relaxed">
                "Liquor is not just a drink, it's a story of craftsmanship, patience, and tradition. We bring you the legends."
            </p>
        </div>
        
        <h2 class="text-3xl md:text-4xl font-heading text-center text-gold-500 mb-12">New Arrivals</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
             @foreach($featuredProducts as $product)
                <a href="{{ route('shop.show', $product->slug) }}" class="group block">
                    <div class="relative overflow-hidden rounded-sm bg-black-800 border border-white/5 group-hover:border-gold-500/30 transition-all duration-300 h-full">
                        <div class="aspect-square relative flex items-center justify-center bg-black-950 p-4">
                            @if($product->image && !str_starts_with($product->image, 'http'))
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="https://images.unsplash.com/photo-1569937756-32af16a79016?q=80&w=600&auto=format&fit=crop" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-500">
                            @endif
                        </div>
                        <div class="p-4">
                            <p class="text-xs text-gold-500 uppercase tracking-widest mb-1">{{ $product->category->name ?? 'Spirit' }}</p>
                            <h3 class="text-lg font-heading text-white group-hover:text-gold-400 transition-colors mb-1 truncate">{{ $product->name }}</h3>
                            <p class="text-gray-400 text-sm font-light mb-3 line-clamp-2">{{ $product->description }}</p>
                            <span class="text-white font-semibold">${{ number_format($product->price, 2) }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
