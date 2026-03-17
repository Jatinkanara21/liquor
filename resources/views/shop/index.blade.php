@extends('layouts.app')

@section('title', 'Collection | ELM GROVE LIQUOR')

@section('content')
<div class="bg-premium-cream min-h-screen py-24">
    <div class="container mx-auto px-6">
        <div class="relative h-80 flex items-center mb-24 overflow-hidden rounded-sm bg-premium-black">
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/defaults/hero.png') }}" class="w-full h-full object-cover opacity-20 scale-110">
                <div class="absolute inset-0 bg-gradient-to-r from-premium-black via-transparent to-premium-black/20"></div>
            </div>
            <div class="container relative z-10 px-16">
                <h4 class="text-premium-gold tracking-[0.6em] uppercase text-[10px] font-bold mb-6">The Curator's Choice</h4>
                <h1 class="text-6xl font-heading text-premium-white mb-4 leading-none tracking-tighter uppercase">The <span class="gold-gradient-text italic font-normal lowercase">Estate</span> Collection</h1>
                <div class="h-[1px] w-24 bg-premium-gold mt-8"></div>
            </div>
        </div>
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-20 pb-10 border-b border-premium-gold/10">
            <div>
                <h2 class="text-4xl font-heading mb-2">
                    <span class="text-premium-black uppercase tracking-[0.2em] font-bold">Rare</span> <span class="gold-gradient-text italic font-normal">Selections</span>
                </h2>
                <p class="text-[10px] text-premium-black/40 uppercase tracking-[0.3em] font-bold">Refining your pursuit of excellence</p>
            </div>
            <div class="flex items-center mt-10 md:mt-0">
                <span class="text-premium-black/40 text-[9px] uppercase tracking-[0.4em] font-bold mr-6">Arrange By</span>
                <select onchange="window.location.href=this.value" class="bg-transparent border-0 border-b border-premium-gold/30 text-premium-black py-2 pr-10 focus:outline-none focus:border-premium-black transition-all text-[10px] font-bold uppercase tracking-[0.3em] cursor-pointer">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Latest Acquisitions</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Value: Low to High</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Value: High to Low</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar -->
            <aside class="w-full lg:w-1/4">
                <div class="bg-white p-10 rounded-sm sticky top-32 border border-premium-gold/10 premium-card-shadow">
                    <form action="{{ route('shop.index') }}" method="GET">
                        @if(request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif

                        <!-- Filter: Categories -->
                        <div class="mb-14">
                            <h3 class="text-premium-black font-heading text-lg mb-10 uppercase tracking-[0.3em] border-b border-premium-gold/10 pb-6 font-bold">Master Class</h3>
                            <ul class="space-y-4">
                                <li>
                                    <label class="flex items-center space-x-4 cursor-pointer group">
                                        <input type="radio" name="category" value="" class="hidden" {{ !request('category') ? 'checked' : '' }} onchange="this.form.submit()">
                                        <span class="w-5 h-5 border border-premium-gold/30 rounded-full flex items-center justify-center group-hover:border-premium-gold transition-all duration-300">
                                            @if(!request('category')) <span class="w-2 h-2 bg-premium-gold rounded-full"></span> @endif
                                        </span>
                                        <span class="text-premium-black/60 group-hover:text-premium-black transition-colors text-[11px] font-bold uppercase tracking-widest">All Collections</span>
                                    </label>
                                </li>
                                @foreach($categories as $cat)
                                    <li>
                                        <label class="flex items-center space-x-4 cursor-pointer group">
                                            <input type="radio" name="category" value="{{ $cat->slug }}" class="hidden" {{ request('category') == $cat->slug ? 'checked' : '' }} onchange="this.form.submit()">
                                            <span class="w-5 h-5 border border-premium-gold/30 rounded-full flex items-center justify-center group-hover:border-premium-gold transition-all duration-300">
                                                @if(request('category') == $cat->slug) <span class="w-2 h-2 bg-premium-gold rounded-full"></span> @endif
                                            </span>
                                            <span class="text-premium-black/60 group-hover:text-premium-black transition-colors text-[11px] font-bold uppercase tracking-widest">{{ $cat->name }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Filter: Brands -->
                        <div class="mb-14">
                            <h3 class="text-premium-black font-heading text-lg mb-10 uppercase tracking-[0.3em] border-b border-premium-gold/10 pb-6 font-bold">The Houses</h3>
                            <div class="space-y-4 max-h-64 overflow-y-auto pr-4 custom-scrollbar">
                                @foreach($brands as $brand)
                                    <label class="flex items-center space-x-4 cursor-pointer group">
                                        <input type="checkbox" name="brand[]" value="{{ $brand }}" class="form-checkbox bg-transparent border-premium-gold/30 rounded-sm text-premium-gold focus:ring-0 w-4 h-4" {{ in_array($brand, (array)request('brand')) ? 'checked' : '' }}>
                                        <span class="text-premium-black/60 group-hover:text-premium-black transition-colors text-[10px] font-bold uppercase tracking-widest">{{ $brand }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Filter: Price -->
                        <div class="mb-14">
                            <h3 class="text-premium-black font-heading text-lg mb-10 uppercase tracking-[0.3em] border-b border-premium-gold/10 pb-6 font-bold">Acquisition</h3>
                            <div class="flex gap-4">
                                <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="w-1/2 bg-premium-cream border border-premium-gold/10 rounded-sm px-4 py-3 text-premium-black text-[10px] font-bold focus:border-premium-gold focus:outline-none transition-all placeholder-premium-black/20">
                                <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="w-1/2 bg-premium-cream border border-premium-gold/10 rounded-sm px-4 py-3 text-premium-black text-[10px] font-bold focus:border-premium-gold focus:outline-none transition-all placeholder-premium-black/20">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-premium-black text-premium-gold font-bold py-5 rounded-sm hover:bg-premium-gold hover:text-premium-black transition-all duration-500 uppercase tracking-[0.4em] text-[10px] shadow-xl">
                            Refine Grid
                        </button>
                        @if(request()->hasAny(['category', 'brand', 'min_price', 'max_price']))
                             <a href="{{ route('shop.index') }}" class="block text-center text-[9px] text-premium-gold mt-8 hover:text-premium-black transition-colors uppercase tracking-[0.3em] underline decoration-premium-gold/30 underline-offset-4">Reset Parameters</a>
                        @endif
                    </form>
                </div>
            </aside>

            <!-- Product Grid -->
            <main class="w-full lg:w-3/4">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($products as $product)
                            <div class="group">
                                <div class="bg-white border border-premium-gold/10 overflow-hidden h-full flex flex-col group-hover:-translate-y-3 transition-all duration-700 rounded-sm premium-card-shadow">
                                    <!-- Image -->
                                    <a href="{{ route('shop.show', $product->slug) }}" class="aspect-[3/4] relative bg-premium-cream/50 flex items-center justify-center p-12 overflow-hidden">
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
                                        @if($product->is_staff_pick)
                                            <div class="absolute top-6 left-6 z-20">
                                                <span class="bg-premium-gold text-premium-black text-[9px] font-bold px-3 py-1 uppercase tracking-widest shadow-xl">Reserve Selection</span>
                                            </div>
                                        @endif
                                        @if($product->image && !str_contains($product->image, 'products/'))
                                            <img src="{{ Str::startsWith($product->image, ['http', 'data:']) ? $product->image : Storage::url($product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-contain bottle-shadow-modern group-hover:scale-110 transition-transform duration-1000 ease-out">
                                        @else
                                             <img src="{{ asset('images/defaults/' . $pFallback) }}" alt="{{ $product->name }}" class="h-full w-full object-contain bottle-shadow-modern group-hover:scale-110 transition-transform duration-1000 ease-out">
                                        @endif
                                        
                                        <!-- Quick Actions -->
                                        <div class="absolute bottom-0 left-0 right-0 p-8 translate-y-full group-hover:translate-y-0 transition-all duration-700 ease-in-out bg-gradient-to-t from-premium-black to-transparent">
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="name" value="{{ $product->name }}">
                                                <input type="hidden" name="price" value="{{ $product->price }}">
                                                <button type="submit" class="w-full bg-premium-gold text-premium-black py-4 font-bold uppercase tracking-[0.4em] text-[10px] hover:bg-premium-white transition-all shadow-2xl rounded-sm">
                                                    Acquire Now
                                                </button>
                                            </form>
                                        </div>
                                    </a>

                                    <!-- Details -->
                                    <div class="p-10 flex-grow flex flex-col justify-between text-center">
                                        <div>
                                            <div class="flex flex-col items-center mb-6">
                                                <p class="text-[10px] text-premium-gold uppercase tracking-[0.4em] font-bold mb-3">{{ $product->brand ?? 'The House' }}</p>
                                                @if($product->country)
                                                    <span class="text-[8px] text-premium-black/40 uppercase tracking-[0.2em]">{{ $product->country }}</span>
                                                @endif
                                            </div>
                                            <h3 class="text-2xl font-heading text-premium-black group-hover:text-premium-gold transition-colors duration-500 leading-tight uppercase tracking-widest">
                                                <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                                            </h3>
                                            @if($product->alcohol_percentage)
                                                <p class="text-premium-black/40 text-[10px] mt-4 font-sans tracking-[0.2em] font-bold">{{ $product->alcohol_percentage }}% ABV</p>
                                            @endif
                                        </div>
                                        <div class="mt-10 pt-8 border-t border-premium-gold/10 flex flex-col items-center">
                                            <span class="text-[9px] text-premium-black/30 uppercase tracking-[0.3em] mb-3 font-bold italic">Investment Value</span>
                                            <span class="text-3xl font-heading text-premium-gold font-bold tracking-tight">${{ number_format($product->price, 2) }}</span>
                                            
                                            <div class="mt-6">
                                                @if($product->stock > 0)
                                                    <span class="text-[8px] text-green-600 flex items-center bg-green-50 px-3 py-1 rounded-full uppercase tracking-widest font-bold border border-green-100">
                                                        <span class="w-1 h-1 bg-green-600 rounded-full mr-2"></span> Available
                                                    </span>
                                                @else
                                                     <span class="text-[8px] text-red-500 flex items-center bg-red-50 px-3 py-1 rounded-full uppercase tracking-widest font-bold border border-red-100">Sold Out</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-20 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-modern-gold mb-6 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-2xl font-heading text-modern-charcoal mb-2 uppercase tracking-widest">No products found</h3>
                        <p class="text-modern-text-muted mb-8 italic">Try adjusting your filters or search criteria.</p>
                        <a href="{{ route('shop.index') }}" class="text-modern-gold hover:text-modern-charcoal underline uppercase tracking-[0.2em] text-xs font-bold">Clear all filters</a>
                    </div>
                @endif
            </main>
        </div>
    </div>
</div>
@endsection
