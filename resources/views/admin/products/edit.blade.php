@extends('layouts.app')

@section('title', 'Edit Product - Admin')

@section('content')
<div class="bg-black-900 min-h-screen py-10">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center mb-10 border-b border-white/10 pb-6">
            <h1 class="text-3xl font-heading text-white">Edit <span class="text-gold-500">Product</span></h1>
            <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-white transition-colors flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Products
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-sm mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="glass p-8 rounded-sm">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <label for="name" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Product Name</label>
                    <input type="text" name="name" id="name" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20" value="{{ old('name', $product->name) }}" required>
                </div>
                <div>
                    <label for="category_id" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Category</label>
                    <select name="category_id" id="category_id" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none border-r-8 border-transparent" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-8">
                <label for="description" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Description</label>
                <textarea name="description" id="description" rows="5" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <label for="price" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Price ($)</label>
                    <input type="number" name="price" id="price" step="0.01" min="0" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20" value="{{ old('price', $product->price) }}" required>
                </div>
                <div>
                    <label for="stock" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Stock Quantity</label>
                    <input type="number" name="stock" id="stock" min="0" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20" value="{{ old('stock', $product->stock) }}" required>
                </div>
            </div>

            <div class="mb-8">
                <label for="image" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Main Product Image</label>
                
                @if($product->image)
                    <div class="mb-4 flex items-center space-x-4">
                        <div class="w-20 h-20 bg-black-950 border border-white/10 rounded-sm overflow-hidden flex-shrink-0">
                            @if(!str_starts_with($product->image, 'http'))
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="w-full h-full object-cover">
                            @else
                                <img src="{{ $product->image }}" alt="Current Image" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <p class="text-gray-500 text-sm">Current Image</p>
                    </div>
                @endif
                
                <input type="file" name="image" id="image" accept="image/*" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20">
            </div>

            <div class="mb-8">
                <label for="gallery_images" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Additional Gallery Images</label>
                
                @if(isset($gallery_images) && $gallery_images->count() > 0)
                    <div class="mb-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($gallery_images as $gImage)
                            <div class="relative group w-full h-24 bg-black-950 border border-white/10 rounded-sm overflow-hidden">
                                @if(!str_starts_with($gImage->image, 'http'))
                                    <img src="{{ asset('storage/' . $gImage->image) }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ $gImage->image }}" class="w-full h-full object-cover">
                                @endif
                                <label class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer">
                                    <input type="checkbox" name="delete_gallery[]" value="{{ $gImage->id }}" class="mr-2 rounded text-red-500 focus:ring-red-500/20">
                                    <span class="text-xs text-white font-semibold">Delete</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <p class="text-xs text-red-400 mb-4">* Select overlay on images above to mark them for deletion upon updating.</p>
                @endif
                
                <input type="file" name="gallery_images[]" id="gallery_images" accept="image/*" multiple class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20">
                <p class="text-xs text-gray-500 mt-2">Add more images. You can select multiple images to display a gallery for this product.</p>
            </div>

            <div class="mb-8 flex items-center">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" class="w-5 h-5 bg-black-950 border-white/10 rounded-sm text-gold-500 focus:ring-gold-500/20 focus:ring-offset-0 mr-3" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                <label for="is_featured" class="text-gray-300">Feature this product (Show on Home Page)</label>
            </div>

            <div class="flex justify-start space-x-4">
                <button type="submit" class="px-8 py-3 bg-gold-600 text-white font-semibold uppercase tracking-widest hover:bg-gold-500 transition-all shadow-[0_4px_14px_0_rgba(184,134,11,0.39)]">
                    Update Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="px-8 py-3 bg-transparent border border-white/20 text-white font-semibold uppercase tracking-widest hover:bg-white/5 transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
