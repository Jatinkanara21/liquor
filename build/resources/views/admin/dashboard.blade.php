@extends('layouts.app')

@section('title', 'Admin Dashboard | ELM GROVE LIQUOR')

@section('content')
<div class="bg-black-900 min-h-screen py-10">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center mb-10 border-b border-white/10 pb-6">
            <h1 class="text-3xl font-heading text-white">Admin <span class="text-gold-500">Dashboard</span></h1>
            <div class="flex space-x-4">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-white/10 text-gold-500 hover:text-white hover:border-gold-500 transition-colors rounded-sm text-sm uppercase tracking-wider font-semibold">
                    Manage Categories
                </a>
                <a href="{{ route('home') }}" class="px-4 py-2 border border-white/10 text-gray-400 hover:text-white hover:border-gold-500 transition-colors rounded-sm text-sm uppercase tracking-wider">
                    View Site
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 transition-colors rounded-sm text-sm uppercase tracking-wider">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Products -->
            <div class="glass p-6 rounded-sm border-l-4 border-gold-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-400 text-sm uppercase tracking-wider">Total Products</p>
                        <h3 class="text-3xl font-bold text-white mt-1">{{ $totalProducts }}</h3>
                    </div>
                    <div class="p-3 bg-gold-500/10 rounded-full text-gold-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
                <div class="text-xs text-green-400 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    <span>Inventory Status</span>
                </div>
            </div>

            <!-- Orders -->
            <div class="glass p-6 rounded-sm border-l-4 border-blue-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-400 text-sm uppercase tracking-wider">Total Orders</p>
                        <h3 class="text-3xl font-bold text-white mt-1">{{ $totalOrders }}</h3>
                    </div>
                    <div class="p-3 bg-blue-500/10 rounded-full text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
                <!-- Action Link -->
                <a href="#" class="text-xs text-blue-400 hover:text-blue-300 flex items-center transition-colors">
                    View All Orders
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <!-- Revenue -->
            <div class="glass p-6 rounded-sm border-l-4 border-green-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-400 text-sm uppercase tracking-wider">Total Revenue</p>
                        <h3 class="text-3xl font-bold text-white mt-1">${{ number_format($totalRevenue, 2) }}</h3>
                    </div>
                    <div class="p-3 bg-green-500/10 rounded-full text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-xs text-green-400 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    <span>+12% from last month</span>
                </div>
            </div>

            <!-- Categories -->
            <div class="glass p-6 rounded-sm border-l-4 border-purple-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-400 text-sm uppercase tracking-wider">Categories</p>
                        <h3 class="text-3xl font-bold text-white mt-1">{{ $totalCategories }}</h3>
                    </div>
                    <div class="p-3 bg-purple-500/10 rounded-full text-purple-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>
                <!-- Action Link -->
                <a href="{{ route('admin.categories.index') }}" class="text-xs text-purple-400 hover:text-purple-300 flex items-center transition-colors">
                    Manage Categories
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="glass rounded-sm overflow-hidden">
            <div class="p-6 border-b border-white/10 flex justify-between items-center">
                <h3 class="text-xl font-heading text-white">Recent Orders</h3>
                <a href="#" class="text-gold-500 hover:text-white text-sm uppercase tracking-wider transition-colors">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-black-950 text-gray-400 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4 font-normal">Order ID</th>
                            <th class="px-6 py-4 font-normal">Customer</th>
                            <th class="px-6 py-4 font-normal">Date</th>
                            <th class="px-6 py-4 font-normal">Status</th>
                            <th class="px-6 py-4 font-normal text-right">Total</th>
                            <th class="px-6 py-4 font-normal text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @foreach($recentOrders as $order)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 font-mono text-gold-500">#{{ $order->id }}</td>
                                <td class="px-6 py-4">{{ $order->customer_name }}</td>
                                <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                                        @if($order->status == 'completed') bg-green-500/10 text-green-500
                                        @elseif($order->status == 'pending') bg-yellow-500/10 text-yellow-500
                                        @elseif($order->status == 'cancelled') bg-red-500/10 text-red-500
                                        @else bg-gray-500/10 text-gray-500 @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-white">${{ number_format($order->total, 2) }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($recentOrders->isEmpty())
                <div class="p-8 text-center text-gray-400">
                    No orders found.
                </div>
            @endif
        </div>

        <!-- Recent Products -->
        <div class="glass rounded-sm overflow-hidden mt-8">
            <div class="p-6 border-b border-white/10 flex justify-between items-center">
                <h3 class="text-xl font-heading text-white">Recent Products</h3>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-gold-600 text-white text-xs font-semibold uppercase tracking-wider hover:bg-gold-500 transition-colors shadow-sm">
                        + Add New Product
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="text-gold-500 hover:text-white text-sm uppercase tracking-wider transition-colors">View All</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-black-950 text-gray-400 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4 font-normal">Image</th>
                            <th class="px-6 py-4 font-normal">Name</th>
                            <th class="px-6 py-4 font-normal">Category</th>
                            <th class="px-6 py-4 font-normal">Price</th>
                            <th class="px-6 py-4 font-normal text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @foreach($recentProducts as $product)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="w-10 h-10 bg-black-950 rounded-sm overflow-hidden">
                                        @if($product->image && !str_starts_with($product->image, 'http'))
                                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="https://placehold.co/100x100?text={{ urlencode($product->name) }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-white">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-400">{{ $product->category->name }}</td>
                                <td class="px-6 py-4 text-gold-500 font-bold">${{ number_format($product->price, 2) }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-400 hover:text-blue-300 transition-colors" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
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
            @if($recentProducts->isEmpty())
                <div class="p-8 text-center text-gray-400">
                    No products found.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
