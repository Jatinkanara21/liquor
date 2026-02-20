@extends('layouts.app')

@section('title', 'Manage Categories | Elite Liquor House')

@section('content')
<div class="bg-black-900 min-h-screen py-10">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center mb-10 border-b border-white/10 pb-6">
            <h1 class="text-3xl font-heading text-white">Manage <span class="text-gold-500">Categories</span></h1>
            <a href="{{ route('admin.categories.create') }}" class="px-6 py-3 bg-gold-600 text-white font-semibold uppercase tracking-widest hover:bg-gold-500 transition-all shadow-[0_4px_14px_0_rgba(184,134,11,0.39)] hover:shadow-[0_6px_20px_rgba(184,134,11,0.23)]">
                Add New Category
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-sm mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-sm mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <div class="glass rounded-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-black-950 text-gray-400 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4 font-normal">ID</th>
                            <th class="px-6 py-4 font-normal">Name</th>
                            <th class="px-6 py-4 font-normal">Product Count</th>
                            <th class="px-6 py-4 font-normal text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @foreach($categories as $category)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 font-mono text-gold-500">#{{ $category->id }}</td>
                                <td class="px-6 py-4 font-medium text-white">{{ $category->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide bg-blue-500/10 text-blue-500">
                                        {{ $category->products_count }} Products
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-400 hover:text-blue-300 transition-colors" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t border-white/10">
                {{-- Pagination if needed --}}
            </div>
        </div>
    </div>
</div>
@endsection
