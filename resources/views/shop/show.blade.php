@extends('layouts.app')

@section('title', $product->name . ' | ELM GROVE LIQUOR')

@section('meta_description', $product->description)

@section('content')
<div class="bg-modern-gray min-h-screen py-20">
    <div class="container mx-auto px-6">
        
        <!-- Breadcrumbs -->
        <nav class="text-[10px] mb-16 text-modern-charcoal/60 uppercase tracking-[0.4em] font-bold">
            <a href="{{ route('home') }}" class="hover:text-modern-gold transition-colors">Home</a>
            <span class="mx-3 opacity-30">/</span>
            <a href="{{ route('shop.index') }}" class="hover:text-modern-gold transition-colors">Collection</a>
            <span class="mx-3 opacity-30">/</span>
            <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="hover:text-modern-gold transition-colors">{{ $product->category->name }}</a>
            <span class="mx-3 opacity-30">/</span>
            <span class="text-modern-gold">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mb-20">
            <!-- Product Image -->
            <div class="relative group">
                <div class="aspect-[4/5] bg-white rounded-sm overflow-hidden flex items-center justify-center border border-modern-gold/10 relative glass-card p-8 shadow-lg">
                    <!-- Background Glow -->
                    <div class="absolute inset-0 bg-modern-gold/5 blur-3xl rounded-full opacity-50 group-hover:opacity-75 transition-opacity duration-700"></div>
                    
                    @php
                        $pName = strtolower($product->name);
                        $catName = strtolower($product->category->name ?? '');
                        $pFallback = 'whiskey_default.png';
                        if (str_contains($pName, 'macallan')) $pFallback = '../products/macallan18.png';
                        elseif (str_contains($pName, 'clase azul')) $pFallback = '../products/clase_azul.png';
                        elseif (str_contains($pName, 'dom perignon')) $pFallback = '../products/domperignon.png';
                        elseif (str_contains($catName, 'wine') || str_contains($pName, 'wine')) $pFallback = 'wine_default.png';
                        elseif (str_contains($catName, 'vodka')) $pFallback = 'vodka_default.png';
                        elseif (str_contains($catName, 'tequila')) $pFallback = 'tequila_default.png';
                        elseif (str_contains($catName, 'champagne')) $pFallback = 'champagne_default.png';
                        elseif (str_contains($catName, 'beer')) $pFallback = 'beer_default.png';
                        elseif (str_contains($catName, 'rum')) $pFallback = 'rum_default.png';
                    @endphp
                    @if($product->image && !str_contains($product->image, 'products/'))
                        <img src="{{ Str::startsWith($product->image, ['http', 'data:']) ? $product->image : Storage::url($product->image) }}" alt="{{ $product->name }}" class="relative z-10 max-h-full max-w-full object-contain bottle-shadow group-hover:scale-105 transition-transform duration-700">
                    @else
                        <img src="{{ asset('images/defaults/' . $pFallback) }}" alt="{{ $product->name }}" class="relative z-10 max-h-full max-w-full object-contain bottle-shadow-whiskey group-hover:scale-105 transition-transform duration-700">
                    @endif

                    @if($product->is_staff_pick)
                        <div class="absolute top-6 left-6 z-20">
                            <span class="bg-modern-gold text-white text-[10px] font-bold px-3 py-1 uppercase tracking-widest shadow-lg rounded-full">Distillery Choice</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="flex flex-col justify-center">
                <div class="mb-6">
                    <span class="text-modern-gold text-xs tracking-[0.4em] uppercase font-bold border-b border-modern-gold/20 pb-2">{{ $product->brand ?? 'Small Batch Distillery' }}</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-heading text-modern-charcoal mb-10 leading-none tracking-tighter uppercase">{{ $product->name }}</h1>
                
                <div class="flex flex-wrap items-center gap-6 mb-10 text-sm text-modern-charcoal/60 uppercase tracking-widest font-medium">
                    @if($product->alcohol_percentage)
                        <div class="flex items-center">
                            <span class="w-1.5 h-1.5 bg-modern-gold rounded-full mr-3"></span>
                            {{ $product->alcohol_percentage }}% VOL
                        </div>
                    @endif
                    @if($product->country)
                        <div class="flex items-center">
                             <span class="w-1.5 h-1.5 bg-modern-gold rounded-full mr-3"></span>
                            {{ $product->country }}
                        </div>
                    @endif
                    <div class="flex items-center">
                         <span class="w-1.5 h-1.5 bg-modern-gold rounded-full mr-3"></span>
                        750ML
                    </div>
                </div>

                <div class="text-5xl text-modern-gold font-bold mb-12 font-heading tracking-tighter leading-none">
                    ${{ number_format($product->price, 2) }}
                    <span class="text-[9px] text-modern-charcoal/40 block mt-4 uppercase tracking-[0.5em] font-bold">Exclusive Small Batch Acquisition</span>
                </div>

                <div class="prose max-w-none mb-12">
                    <p class="text-lg leading-relaxed font-light text-modern-charcoal/60 italic">"{{ $product->description }}"</p>
                </div>

                <!-- Tasting Notes -->
                @if($product->tasting_notes)
                    <div class="bg-white border-l-4 border-modern-gold p-10 mb-12 shadow-sm">
                        <h3 class="text-modern-gold font-heading text-sm mb-4 uppercase tracking-[0.3em] font-bold">Notes du Connoisseur</h3>
                        <p class="text-modern-charcoal/60 italic font-light leading-relaxed">"{{ $product->tasting_notes }}"</p>
                    </div>
                @endif

                <!-- Concierge Banner -->
                <div class="glass-card p-10 mt-16 rounded-sm border-l-4 border-modern-gold bg-gradient-to-r from-modern-tan/50 to-transparent">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                        <div>
                            <h3 class="text-2xl font-heading text-modern-charcoal mb-2">Concierge Assistance</h3>
                            <p class="text-modern-charcoal/60">Inquire about rare barrel releases or personalized collection advice.</p>
                        </div>
                        <a href="{{ route('contact') }}" class="px-8 py-4 border border-modern-charcoal text-modern-charcoal font-bold uppercase tracking-widest text-xs hover:bg-modern-charcoal hover:text-white transition-all">
                            Speak with a Connoisseur
                        </a>
                    </div>
                </div>

                <!-- Add to Cart -->
                <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col sm:flex-row gap-6 mt-12">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    
                    <div class="w-full sm:w-32">
                        <label for="quantity" class="sr-only">Quantity</label>
                        <select name="quantity" id="quantity" class="w-full bg-white border border-modern-gold/20 text-modern-charcoal py-4 px-6 focus:border-modern-gold focus:outline-none appearance-none cursor-pointer">
                            @for($i = 1; $i <= min($product->stock, 5); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <button type="submit" class="flex-1 bg-modern-charcoal text-modern-gray font-bold uppercase tracking-[0.3em] py-6 hover:bg-modern-gold transition-all shadow-2xl disabled:opacity-50 disabled:cursor-not-allowed rounded-sm text-xs">
                        {{ $product->stock > 0 ? 'Add to Private Reserve' : 'Currently Unavailable' }}
                    </button>
                </form>

                <div class="mt-8 flex items-center space-x-3 text-xs text-gray-500 uppercase tracking-widest">
                    <div class="w-2 h-2 rounded-full bg-green-500/50 animate-pulse"></div>
                    <span>Inventory Authenticated & Secured</span>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="border-t border-modern-gold/10 pt-20">
                <h2 class="text-3xl font-heading text-center text-modern-charcoal mb-12 uppercase tracking-widest">You May Also Like</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('shop.show', $related->slug) }}" class="group block">
                            <div class="bg-white p-4 rounded-sm border border-modern-gold/10 overflow-hidden relative group shadow-sm hover:shadow-md transition-all">
                                <div class="aspect-[4/5] bg-modern-gray/10 flex items-center justify-center p-8">
                                    @if($related->image && Str::startsWith($related->image, ['http', 'data:']))
                                        <img src="{{ $related->image }}" alt="{{ $related->name }}" class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-700 ease-out">
                                    @elseif($related->image)
                                        <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-700 ease-out">
                                    @else
                                        <img src="{{ asset('images/defaults/' . (Str::contains(strtolower($related->category->name ?? $related->name), 'wine') ? 'wine_default.png' : 'whiskey_default.png')) }}" alt="{{ $related->name }}" class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-700 ease-out">
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3 class="text-lg font-heading text-modern-charcoal group-hover:text-modern-gold transition-colors truncate mb-1 uppercase tracking-widest">{{ $related->name }}</h3>
                                    <p class="text-modern-gold font-bold tracking-tight">${{ number_format($related->price, 2) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
