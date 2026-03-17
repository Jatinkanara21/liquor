<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'ELM GROVE LIQUOR - Premium Spirits, Fine Wines, and Exclusive Collections. Experience luxury in every sip.')">
    <meta name="keywords" content="premium liquor, rare whiskey, fine wine, champagne, luxury alcohol, elm grove liquor">
    <title>@yield('title', 'ELM GROVE LIQUOR | Premium Spirits')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-black-900 text-gray-200 flex flex-col min-h-screen">

    <header class="fixed w-full z-50 transition-all duration-300 bg-black-900 border-b border-white/5" id="main-header">
        <div>
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-3xl font-heading font-bold text-gold-500 tracking-wider hover:text-gold-400 transition-colors">
                    ELM <span class="text-white">GROVE</span>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'text-gold-500' : 'text-gray-300 hover:text-gold-400' }}">Home</a>
                    <a href="{{ route('shop.index') }}" class="nav-link {{ request()->routeIs('shop.*') ? 'text-gold-500' : 'text-gray-300 hover:text-gold-400' }}">Collection</a>
                    <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'text-gold-500' : 'text-gray-300 hover:text-gold-400' }}">Our Story</a>
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'text-gold-500' : 'text-gray-300 hover:text-gold-400' }}">Contact</a>
                </nav>

                <!-- Icons -->
                <div class="flex items-center space-x-6">
                    <!-- Search Trigger (Optional) -->
                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gold-500 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                    </a>

                    <!-- Notifications -->
                    @auth
                    <div class="relative group hidden md:block">
                        <button class="flex items-center text-gold-500 hover:text-white focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ auth()->user()->unreadNotifications->count() }}</span>
                            @endif
                        </button>
                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-2 w-72 bg-black-800 border border-gold-500/20 rounded-md shadow-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform z-50 max-h-96 overflow-y-auto">
                            <div class="px-4 py-2 text-sm font-semibold text-gold-500 border-b border-gold-500/20 flex justify-between items-center">
                                <span>Notifications</span>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <form method="POST" action="{{ route('notifications.markAsRead') }}" class="inline m-0 p-0">
                                        @csrf
                                        <button type="submit" class="text-xs text-gray-400 hover:text-white underline">Mark all read</button>
                                    </form>
                                @endif
                            </div>
                            @forelse(auth()->user()->notifications->take(5) as $notification)
                                <div class="px-4 py-3 border-b border-white/5 {{ $notification->unread() ? 'bg-gold-500/10' : '' }}">
                                    <p class="text-sm text-gray-300">{{ $notification->data['message'] ?? 'New notification' }}</p>
                                    <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            @empty
                                <div class="px-4 py-3 text-sm text-gray-500">No new notifications</div>
                            @endforelse
                        </div>
                    </div>
                    @endauth

                    <!-- User Menu -->
                    <div class="relative group hidden md:block">
                        @auth
                            <button class="flex items-center space-x-2 text-gold-500 hover:text-white focus:outline-none">
                                <span class="font-medium hidden sm:block">{{ auth()->user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </button>
                            <!-- Dropdown -->
                            <div class="absolute right-0 mt-2 w-48 bg-black-800 border border-gold-500/20 rounded-md shadow-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform z-50">
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gold-500/10 hover:text-gold-500">Dashboard</a>
                                @endif
                                <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gold-500/10 hover:text-gold-500">Orders</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-red-500/10 hover:text-red-400">Logout</button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gold-500 hover:text-white border border-gold-500 hover:border-white px-4 py-2 rounded transition-all">
                                LOGIN
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    <button class="md:hidden text-gold-500 focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-black-900 border-b border-white/5 max-h-screen overflow-y-auto">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-gold-500 hover:bg-white/5">Home</a>
                <a href="{{ route('shop.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-gold-500 hover:bg-white/5">Collection</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-gold-500 hover:bg-white/5">Our Story</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-gold-500 hover:bg-white/5">Contact</a>
                
                @auth
                    <div class="border-t border-white/10 my-2 pt-2">
                        <div class="px-3 py-2 text-gold-500 font-medium flex justify-between items-center">
                            <span>Notifications</span>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="bg-red-600 text-white text-xs font-bold rounded-full px-2 py-1">{{ auth()->user()->unreadNotifications->count() }} New</span>
                            @endif
                        </div>
                        <div class="space-y-1 pb-2">
                            @forelse(auth()->user()->notifications->take(3) as $notification)
                                <div class="px-4 py-2 text-sm text-gray-300 {{ $notification->unread() ? 'bg-gold-500/10' : '' }}">
                                    <p>{{ $notification->data['message'] ?? 'New notification' }}</p>
                                    <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            @empty
                                <div class="px-4 py-2 text-sm text-gray-500">No new notifications</div>
                            @endforelse
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <form method="POST" action="{{ route('notifications.markAsRead') }}" class="px-4 py-2 m-0">
                                    @csrf
                                    <button type="submit" class="text-sm text-gold-500 hover:text-white underline">Mark all read</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    
                    <div class="border-t border-white/10 my-2 pt-2 pb-2">
                        <div class="px-3 py-2 text-gold-500 font-medium">{{ auth()->user()->name }}</div>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-gold-500 hover:bg-white/5">Dashboard</a>
                        @endif
                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-gold-500 hover:bg-white/5">Orders</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-red-400 hover:text-red-300 hover:bg-white/5">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="border-t border-white/10 my-2 pt-4 pb-2">
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gold-500 hover:text-white border border-gold-500 hover:border-white text-center transition-all mx-3">LOGIN</a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    <footer class="bg-black-950 border-t border-gold-500/20 pt-16 pb-8">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-1">
                    <a href="{{ route('home') }}" class="text-2xl font-heading font-bold text-gold-500 tracking-wider">
                        ELITE <span class="text-white">LIQUOR</span>
                    </a>
                    <p class="mt-4 text-gray-400 text-sm leading-relaxed">
                        Curating the world's finest spirits for the discerning connoisseur. Experience luxury in every bottle.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-gold-500 font-heading text-lg mb-6">Collections</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="{{ route('shop.category', 'whiskey') }}" class="hover:text-gold-500 transition-colors">Rare Whiskey</a></li>
                        <li><a href="{{ route('shop.category', 'wine') }}" class="hover:text-gold-500 transition-colors">Fine Wine</a></li>
                        <li><a href="{{ route('shop.category', 'tequila') }}" class="hover:text-gold-500 transition-colors">Premium Tequila</a></li>
                        <li><a href="{{ route('shop.index') }}" class="hover:text-gold-500 transition-colors">All Products</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-gold-500 font-heading text-lg mb-6">Support</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-gold-500 transition-colors">Contact Concierge</a></li>
                        <li><a href="#" class="hover:text-gold-500 transition-colors">Shipping & Returns</a></li>
                        <li><a href="#" class="hover:text-gold-500 transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-gold-500 transition-colors">Terms of Service</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-gold-500 font-heading text-lg mb-6">Visit Us</h4>
                    <p class="text-gray-400 text-sm mb-2">7433 N Lindbergh Blvd</p>
                    <p class="text-gray-400 text-sm mb-4">Hazelwood, MO 63042</p>
                    <p class="text-gold-500 text-lg font-heading">(314) 837-0090</p>
                </div>
            </div>
            
            <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} ELM GROVE LIQUOR. All rights reserved.</p>
                <div class="mt-4 md:mt-0">
                    <span class="text-xs text-gray-600 uppercase tracking-widest">Drink Responsibly</span>
                </div>
            </div>
        </div>
    </footer>

    @include('partials.age-gate')

    @stack('scripts')
</body>
</html>
