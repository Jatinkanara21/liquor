@extends('layouts.app')

@section('title', 'Collection | Elite Liquor House')

@section('content')
<div class="bg-black-900 min-h-screen py-10">
    <div class="container mx-auto px-6">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 pb-6 border-b border-white/10">
            <h1 class="text-3xl font-heading text-white mb-4 md:mb-0">
                Premium <span class="text-gold-500">Collection</span>
            </h1>
            <div class="flex items-center space-x-4">
                <span class="text-gray-400 text-sm">Sort By:</span>
                <select onchange="window.location.href=this.value" class="bg-black-800 border border-white/10 text-white rounded-sm px-4 py-2 focus:outline-none focus:border-gold-500">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <aside class="w-full lg:w-1/4">
                <div class="glass p-6 rounded-sm sticky top-24">
                    <form action="{{ route('shop.index') }}" method="GET">
                        @if(request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif

                        <!-- Filter: Categories -->
                        <div class="mb-8">
                            <h3 class="text-gold-500 font-heading text-lg mb-4 border-b border-white/10 pb-2">Category</h3>
                            <ul class="space-y-2">
                                <li>
                                    <label class="flex items-center space-x-2 cursor-pointer group">
                                        <input type="radio" name="category" value="" class="hidden" {{ !request('category') ? 'checked' : '' }} onchange="this.form.submit()">
                                        <span class="w-4 h-4 border border-gray-600 rounded-full flex items-center justify-center group-hover:border-gold-500">
                                            @if(!request('category')) <span class="w-2 h-2 bg-gold-500 rounded-full"></span> @endif
                                        </span>
                                        <span class="text-gray-400 group-hover:text-white transition-colors">All Categories</span>
                                    </label>
                                </li>
                                @foreach($categories as $cat)
                                    <li>
                                        <label class="flex items-center space-x-2 cursor-pointer group">
                                            <input type="radio" name="category" value="{{ $cat->slug }}" class="hidden" {{ request('category') == $cat->slug ? 'checked' : '' }} onchange="this.form.submit()">
                                            <span class="w-4 h-4 border border-gray-600 rounded-full flex items-center justify-center group-hover:border-gold-500">
                                                @if(request('category') == $cat->slug) <span class="w-2 h-2 bg-gold-500 rounded-full"></span> @endif
                                            </span>
                                            <span class="text-gray-400 group-hover:text-white transition-colors">{{ $cat->name }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Filter: Brands -->
                        <div class="mb-8">
                            <h3 class="text-gold-500 font-heading text-lg mb-4 border-b border-white/10 pb-2">Brand</h3>
                            <div class="space-y-2 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                @foreach($brands as $brand)
                                    <label class="flex items-center space-x-2 cursor-pointer group">
                                        <input type="checkbox" name="brand[]" value="{{ $brand }}" class="form-checkbox bg-black-800 border-gray-600 rounded text-gold-500 focus:ring-0 mr-2" {{ in_array($brand, (array)request('brand')) ? 'checked' : '' }}>
                                        <span class="text-gray-400 group-hover:text-white transition-colors text-sm">{{ $brand }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Filter: Price -->
                        <div class="mb-6">
                            <h3 class="text-gold-500 font-heading text-lg mb-4 border-b border-white/10 pb-2">Price Range</h3>
                            <div class="flex gap-2">
                                <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="w-1/2 bg-black-800 border border-white/10 rounded-sm px-3 py-2 text-white text-sm focus:border-gold-500 focus:outline-none">
                                <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="w-1/2 bg-black-800 border border-white/10 rounded-sm px-3 py-2 text-white text-sm focus:border-gold-500 focus:outline-none">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gold-600 text-white font-semibold py-2 rounded-sm hover:bg-gold-500 transition-colors uppercase tracking-wider text-sm">
                            Apply Filters
                        </button>
                        @if(request()->hasAny(['category', 'brand', 'min_price', 'max_price']))
                             <a href="{{ route('shop.index') }}" class="block text-center text-xs text-gray-500 mt-2 hover:text-white underline">Clear All</a>
                        @endif
                    </form>
                </div>
            </aside>

            <!-- Product Grid -->
            <main class="w-full lg:w-3/4">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="group block h-full">
                                <div class="relative overflow-hidden rounded-sm bg-black-800 border border-white/5 group-hover:border-gold-500/30 transition-all duration-300 h-full flex flex-col">
                                    <!-- Image -->
                                    <a href="{{ route('shop.show', $product->slug) }}" class="aspect-[4/5] relative bg-black-950 flex items-center justify-center p-4 overflow-hidden">
                                        @if($product->image && !str_starts_with($product->image, 'http'))
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-contain group-hover:scale-110 transition-transform duration-500">
                                        @else
                                             <img src="https://placehold.co/400x500/101010/gold?text={{ urlencode($product->name) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                        @endif
                                        
                                        <!-- Quick Actions -->
                                        <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="name" value="{{ $product->name }}">
                                                <input type="hidden" name="price" value="{{ $product->price }}">
                                                <button type="submit" class="w-full bg-gold-500 text-white py-3 font-semibold uppercase tracking-wider text-sm hover:bg-white hover:text-black transition-colors shadow-lg">
                                                    Add to Cart
                                                </button>
                                            </form>
                                        </div>
                                    </a>

                                    <!-- Details -->
                                    <div class="p-5 flex-grow flex flex-col justify-between">
                                        <div>
                                            <div class="flex justify-between items-start mb-2">
                                                 <p class="text-xs text-gold-500 uppercase tracking-widest">{{ $product->brand ?? 'Premium' }}</p>
                                                 @if($product->country)
                                                    <span class="text-[10px] text-gray-500 border border-gray-700 px-1 rounded">{{ $product->country }}</span>
                                                 @endif
                                            </div>
                                            <h3 class="text-xl font-heading text-white group-hover:text-gold-400 transition-colors mb-1">
                                                <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                                            </h3>
                                            @if($product->alcohol_percentage)
                                                <p class="text-gray-500 text-xs mb-3">{{ $product->alcohol_percentage }}% ABV</p>
                                            @endif
                                        </div>
                                        <div class="mt-2 flex items-center justify-between">
                                            <span class="text-lg font-bold text-white">${{ number_format($product->price, 2) }}</span>
                                            @if($product->stock > 0)
                                                <span class="text-xs text-green-500 flex items-center">
                                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1"></span> In Stock
                                                </span>
                                            @else
                                                 <span class="text-xs text-red-500">Out of Stock</span>
                                            @endif
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-2xl font-heading text-white mb-2">No products found</h3>
                        <p class="text-gray-400 mb-6">Try adjusting your filters or search criteria.</p>
                        <a href="{{ route('shop.index') }}" class="text-gold-500 hover:text-white underline">Clear all filters</a>
                    </div>
                @endif
            </main>
        </div>
    </div>
</div>
@endsection
