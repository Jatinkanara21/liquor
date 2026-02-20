@extends('layouts.app')

@section('title', 'Edit Category | Elite Liquor House')

@section('content')
<div class="bg-black-900 min-h-screen py-10">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center mb-10 border-b border-white/10 pb-6">
            <h1 class="text-3xl font-heading text-white">Edit <span class="text-gold-500">Category</span></h1>
            <a href="{{ route('admin.categories.index') }}" class="text-gray-400 hover:text-white transition-colors flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Categories
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

        <div class="max-w-2xl mx-auto">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="glass p-8 rounded-sm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-8">
                    <label for="name" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Category Name</label>
                    <input type="text" name="name" id="name" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20" value="{{ old('name', $category->name) }}" required>
                    <p class="text-gray-500 text-xs mt-2">The slug will be automatically updated.</p>
                </div>

                <div class="mb-8">
                    <label for="description" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Description</label>
                    <textarea name="description" id="description" rows="4" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="mb-8">
                    <label for="image" class="block text-gray-400 text-sm mb-2 uppercase tracking-wide">Category Image</label>
                    
                    @if($category->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $category->image) }}" class="w-32 h-32 object-cover rounded-sm border border-white/10">
                            <p class="text-gray-500 text-xs mt-1">Current Image</p>
                        </div>
                    @endif

                    <input type="file" name="image" id="image" class="w-full bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20" accept="image/*">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-gold-600 text-white font-semibold uppercase tracking-widest hover:bg-gold-500 transition-all shadow-lg">
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
