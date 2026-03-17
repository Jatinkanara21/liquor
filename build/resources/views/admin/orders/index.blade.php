@extends('layouts.app')

@section('title', 'Manage Orders | ELM GROVE LIQUOR')

@section('content')
<div class="bg-black-900 min-h-screen py-10">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center mb-10 border-b border-white/10 pb-6">
            <h1 class="text-3xl font-heading text-white">Manage <span class="text-gold-500">Orders</span></h1>
        </div>

        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-sm mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="glass rounded-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-black-950 text-gray-400 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4 font-normal">Order ID</th>
                            <th class="px-6 py-4 font-normal">Customer</th>
                            <th class="px-6 py-4 font-normal">Date</th>
                            <th class="px-6 py-4 font-normal">Status</th>
                            <th class="px-6 py-4 font-normal text-right">Total</th>
                            <th class="px-6 py-4 font-normal text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @foreach($orders as $order)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 font-mono text-gold-500">#{{ $order->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-white">{{ $order->customer_name }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->customer_email }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm">{{ $order->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4">
                                     <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                                        @if($order->status == 'completed') bg-green-500/10 text-green-500
                                        @elseif($order->status == 'pending') bg-yellow-500/10 text-yellow-500
                                        @elseif($order->status == 'processing') bg-blue-500/10 text-blue-500
                                        @elseif($order->status == 'cancelled') bg-red-500/10 text-red-500
                                        @else bg-gray-500/10 text-gray-500 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-white">${{ number_format($order->total, 2) }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-gold-500 hover:text-white transition-colors text-sm uppercase tracking-wider font-semibold">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

             <div class="p-6 border-t border-white/10">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
