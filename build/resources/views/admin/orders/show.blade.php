@extends('layouts.app')

@section('title', 'Order #'. $order->id .' | ELM GROVE LIQUOR')

@section('content')
<div class="bg-black-900 min-h-screen py-10">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center mb-10 border-b border-white/10 pb-6">
            <h1 class="text-3xl font-heading text-white">Order <span class="text-gold-500">#{{ $order->id }}</span></h1>
            <a href="{{ route('admin.orders.index') }}" class="text-gray-400 hover:text-white transition-colors flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Orders
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Items -->
                <div class="glass rounded-sm overflow-hidden p-6">
                    <h3 class="text-xl font-heading text-white mb-4">Order Items</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-black-950 text-gray-400 uppercase text-xs tracking-wider">
                                <tr>
                                    <th class="px-4 py-2 font-normal">Product</th>
                                    <th class="px-4 py-2 font-normal text-center">Price</th>
                                    <th class="px-4 py-2 font-normal text-center">Qty</th>
                                    <th class="px-4 py-2 font-normal text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 text-gray-300">
                                @foreach($order->items as $item)
                                    <tr>
                                        <td class="px-4 py-3 flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-black-950 rounded-sm overflow-hidden border border-white/5 flex-shrink-0">
                                                 @if($item->product && $item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full bg-gray-800"></div>
                                                @endif
                                            </div>
                                            <span class="text-white font-medium">{{ $item->product ? $item->product->name : 'Product Deleted' }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-center text-gray-400">${{ number_format($item->price, 2) }}</td>
                                        <td class="px-4 py-3 text-center text-gray-400">{{ $item->quantity }}</td>
                                        <td class="px-4 py-3 text-right text-white font-bold">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Status Update -->
                <div class="glass rounded-sm p-6">
                    <h3 class="text-xl font-heading text-white mb-4">Update Status</h3>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex items-center gap-4">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="bg-black-950 border border-white/10 text-white px-4 py-3 rounded-sm focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/20 flex-grow">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="px-6 py-3 bg-gold-600 text-white font-semibold uppercase tracking-widest hover:bg-gold-500 transition-all shadow-lg">
                            Update
                        </button>
                    </form>
                </div>
            </div>

            <!-- Customer & Summary -->
            <div class="space-y-6">
                <!-- Customer Info -->
                <div class="glass rounded-sm p-6">
                    <h3 class="text-xl font-heading text-white mb-4">Customer Details</h3>
                    <div class="space-y-3 text-gray-300">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Name:</span>
                            <span class="text-white">{{ $order->customer_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Email:</span>
                            <span class="text-white">{{ $order->customer_email }}</span>
                        </div>
                        {{-- Add address/phone if available --}}
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="glass rounded-sm p-6">
                    <h3 class="text-xl font-heading text-white mb-4">Order Summary</h3>
                    <div class="space-y-3 text-gray-300 border-b border-white/10 pb-4 mb-4">
                         <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal</span>
                            <span>${{ number_format($order->total, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Shipping</span>
                            <span>Free</span>
                        </div>
                         <div class="flex justify-between">
                            <span class="text-gray-500">Tax</span>
                            <span>$0.00</span>
                        </div>
                    </div>
                    <div class="flex justify-between text-xl font-bold text-gold-500">
                        <span>Total</span>
                        <span>${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
