@extends('layouts.app')

@section('title', $product->name . ' | Elite Liquor House')

@section('meta_description', $product->description)

@section('content')
<div class="bg-black-900 min-h-screen py-12">
    <div class="container mx-auto px-6">
        
        <!-- Breadcrumbs -->
        <nav class="text-sm mb-8 text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-gold-500 transition-colors">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('shop.index') }}" class="hover:text-gold-500 transition-colors">Collection</a>
            <span class="mx-2">/</span>
            <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="hover:text-gold-500 transition-colors">{{ $product->category->name }}</a>
            <span class="mx-2">/</span>
            <span class="text-gold-500">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mb-20">
            <!-- Product Image -->
            <div class="relative group">
                <div class="aspect-[4/5] bg-black-950 rounded-sm overflow-hidden flex items-center justify-center border border-white/5 relative glass-card">
                    <!-- Background Glow -->
                    <div class="absolute inset-0 bg-gold-500/5 blur-3xl rounded-full opacity-50 group-hover:opacity-75 transition-opacity duration-700"></div>
                    
                    @if($product->image && !str_starts_with($product->image, 'http'))
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="relative z-10 max-h-[80%] max-w-[80%] object-contain drop-shadow-2xl group-hover:scale-105 transition-transform duration-700">
                    @else
                        <img src="https://placehold.co/600x800/101010/gold?text={{ urlencode($product->name) }}" alt="{{ $product->name }}" class="relative z-10 max-h-full max-w-full object-cover">
                    @endif

                    @if($product->is_staff_pick)
                        <div class="absolute top-6 left-6 z-20 bg-gold-600 text-black text-xs font-bold px-3 py-1 uppercase tracking-widest shadow-lg">
                            Staff Pick
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="flex flex-col justify-center">
                <div class="mb-2">
                    <span class="text-gold-500 text-sm tracking-widest uppercase">{{ $product->brand ?? 'Premium Spirit' }}</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-heading text-white mb-6 leading-tight">{{ $product->name }}</h1>
                
                <div class="flex items-center space-x-6 mb-8 text-sm text-gray-400">
                    @if($product->alcohol_percentage)
                        <div class="flex items-center">
                            <span class="w-1.5 h-1.5 bg-gray-600 rounded-full mr-2"></span>
                            {{ $product->alcohol_percentage }}% ABV
                        </div>
                    @endif
                    @if($product->country)
                        <div class="flex items-center">
                             <span class="w-1.5 h-1.5 bg-gray-600 rounded-full mr-2"></span>
                            {{ $product->country }}
                        </div>
                    @endif
                    <div class="flex items-center">
                         <span class="w-1.5 h-1.5 bg-gray-600 rounded-full mr-2"></span>
                        750ml
                    </div>
                </div>

                <div class="text-3xl text-gold-500 font-bold mb-8 font-heading">
                    ${{ number_format($product->price, 2) }}
                </div>

                <div class="prose prose-invert prose-p:text-gray-300 max-w-none mb-10">
                    <p class="text-lg leading-relaxed">{{ $product->description }}</p>
                </div>

                <!-- Tasting Notes -->
                @if($product->tasting_notes)
                    <div class="bg-black-800 border-l-2 border-gold-500 p-6 mb-10">
                        <h3 class="text-gold-500 font-heading text-lg mb-2">Tasting Notes</h3>
                        <p class="text-gray-300 italic">"{{ $product->tasting_notes }}"</p>
                    </div>
                @endif

                <!-- Add to Cart -->
                <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    
                    <div class="w-full sm:w-32">
                        <label for="quantity" class="sr-only">Quantity</label>
                        <select name="quantity" id="quantity" class="w-full bg-black-800 border border-white/10 text-white py-4 px-4 focus:border-gold-500 focus:outline-none">
                            @for($i = 1; $i <= min($product->stock, 5); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <button type="submit" class="flex-1 bg-gold-600 text-white font-semibold uppercase tracking-widest py-4 hover:bg-gold-500 transition-all shadow-[0_4px_14px_0_rgba(184,134,11,0.39)] hover:shadow-[0_6px_20px_rgba(184,134,11,0.23)] disabled:opacity-50 disabled:cursor-not-allowed" {{ $product->stock < 1 ? 'disabled' : '' }}>
                        {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                    </button>
                </form>

                <div class="mt-6 flex items-center space-x-2 text-sm text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>In Stock & Ready to Ship</span>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="border-t border-white/10 pt-20">
                <h2 class="text-3xl font-heading text-center text-white mb-12">You May Also Like</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('shop.show', $related->slug) }}" class="group block">
                            <div class="relative overflow-hidden rounded-sm bg-black-800 border border-white/5 group-hover:border-gold-500/30 transition-all duration-300">
                                <div class="aspect-[4/5] bg-black-950 flex items-center justify-center p-4">
                                    @if($related->image && !str_starts_with($related->image, 'http'))
                                        <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <img src="https://placehold.co/400x500/101010/gold?text={{ urlencode($related->name) }}" alt="{{ $related->name }}" class="max-h-full max-w-full object-cover">
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-heading text-white group-hover:text-gold-400 transition-colors truncate">{{ $related->name }}</h3>
                                    <p class="text-gold-500 font-bold mt-1">${{ number_format($related->price, 2) }}</p>
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
