<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'GRAND MAISON - Premium Spirits, Fine Wines, and Exclusive Collections. Experience luxury in every sip.')">
    <meta name="keywords" content="premium liquor, rare whiskey, fine wine, champagne, luxury alcohol, grand maison">
    <title>@yield('title', 'GRAND MAISON | Premium Spirits')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
        /* ── Navbar bottom border ── */
        #main-header {
            border-bottom: 1px solid rgba(184, 115, 51, 0.20);
        }
        /* ── Copper underline nav hover effect ── */
        .nav-link-underline {
            position: relative;
            padding-bottom: 3px;
        }
        .nav-link-underline::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0;
            width: 0; height: 1px;
            background: #B87333;
            transition: width 0.35s ease;
        }
        .nav-link-underline:hover::after,
        .nav-link-underline.active::after { width: 100%; }
        /* ── Page fade-in ── */
        @keyframes pageFadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        main { animation: pageFadeIn 0.6s ease both; }
    </style>
</head>

<body class="bg-premium-cream text-gm-dark font-sans antialiased flex flex-col min-h-screen">

    <!-- ══════════════════════ NAVBAR ══════════════════════ -->
    <header class="fixed w-full z-50 transition-all duration-500" id="main-header"
            style="background-color:#2C2C2C;">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center group">
                <span class="text-3xl md:text-4xl font-heading tracking-tight"
                      style="color:#B87333;text-shadow:0 2px 12px rgba(184, 115, 51, 0.30);">
                    Grand
                    <span class="font-bold italic ml-1"
                          style="background:linear-gradient(135deg,#D29052,#B87333,#8E5624);
                                 -webkit-background-clip:text;-webkit-text-fill-color:transparent;
                                 background-clip:text;">Maison</span>
                </span>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center space-x-10 text-[11px] font-bold tracking-[0.4em] uppercase">
                <a href="{{ route('home') }}"
                   class="nav-link-underline transition-colors duration-300 {{ request()->routeIs('home') ? 'active' : '' }}"
                   style="color:{{ request()->routeIs('home') ? '#B87333' : 'rgba(255,255,255,0.85)' }};"
                   onmouseover="this.style.color='#B87333'"
                   onmouseout="this.style.color='{{ request()->routeIs('home') ? '#B87333' : 'rgba(255,255,255,0.85)' }}'">Home</a>

                <a href="{{ route('shop.index') }}"
                   class="nav-link-underline transition-colors duration-300 {{ request()->routeIs('shop*') ? 'active' : '' }}"
                   style="color:{{ request()->routeIs('shop*') ? '#B87333' : 'rgba(255,255,255,0.85)' }};"
                   onmouseover="this.style.color='#B87333'"
                   onmouseout="this.style.color='{{ request()->routeIs('shop*') ? '#B87333' : 'rgba(255,255,255,0.85)' }}'">Collection</a>

                <a href="{{ route('about') }}"
                   class="nav-link-underline transition-colors duration-300 {{ request()->routeIs('about') ? 'active' : '' }}"
                   style="color:{{ request()->routeIs('about') ? '#B87333' : 'rgba(255,255,255,0.85)' }};"
                   onmouseover="this.style.color='#B87333'"
                   onmouseout="this.style.color='{{ request()->routeIs('about') ? '#B87333' : 'rgba(255,255,255,0.85)' }}'">Heritage</a>

                <a href="{{ route('contact') }}"
                   class="nav-link-underline transition-colors duration-300 {{ request()->routeIs('contact') ? 'active' : '' }}"
                   style="color:{{ request()->routeIs('contact') ? '#B87333' : 'rgba(255,255,255,0.85)' }};"
                   onmouseover="this.style.color='#B87333'"
                   onmouseout="this.style.color='{{ request()->routeIs('contact') ? '#B87333' : 'rgba(255,255,255,0.85)' }}'">Concierge</a>
            </nav>

            <!-- Icons / Actions -->
            <div class="flex items-center space-x-7">
                <!-- Search -->
                <button class="transition-colors" title="Search"
                        style="color:rgba(255,255,255,0.75);"
                        onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='rgba(255,255,255,0.75)'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="relative transition-colors"
                   style="color:rgba(255,255,255,0.75);"
                   onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='rgba(255,255,255,0.75)'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    @if(count(session('cart', [])) > 0)
                        <span class="absolute -top-1 -right-1 text-[9px] font-bold w-4 h-4 flex items-center justify-center rounded-full"
                              style="background:#B87333;color:#2C2C2C;">{{ count(session('cart')) }}</span>
                    @endif
                </a>

                @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-2 transition-colors focus:outline-none"
                                style="color:rgba(255,255,255,0.75);"
                                onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='rgba(255,255,255,0.75)'">
                            <span class="font-medium hidden sm:block text-[10px] uppercase tracking-widest">{{ auth()->user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </button>
                        <div class="absolute right-0 w-52 mt-3 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 rounded-sm"
                             style="background:#444444;border:1px solid rgba(184, 115, 51, 0.22);">
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}"
                                   class="block px-5 py-2.5 text-[10px] uppercase tracking-widest transition-colors"
                                   style="color:rgba(255,255,255,0.70);"
                                   onmouseover="this.style.color='#B87333';this.style.background='rgba(184,115,51,0.08)'"
                                   onmouseout="this.style.color='rgba(255,255,255,0.70)';this.style.background='transparent'">Dashboard</a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-5 py-2.5 text-[10px] uppercase tracking-widest transition-colors"
                                        style="color:rgba(255,255,255,0.70);"
                                        onmouseover="this.style.color='#B87333';this.style.background='rgba(184,115,51,0.08)'"
                                        onmouseout="this.style.color='rgba(255,255,255,0.70)';this.style.background='transparent'">Sign Out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="transition-colors"
                       style="color:rgba(255,255,255,0.75);"
                       onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='rgba(255,255,255,0.75)'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                    </a>
                @endauth

                <!-- Mobile toggle -->
                <button class="md:hidden focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                        style="color:rgba(255,255,255,0.90);">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden max-h-screen overflow-y-auto"
             style="background:#444444;border-top:1px solid rgba(184, 115, 51, 0.16);">
            <div class="px-6 pt-4 pb-8 space-y-1">
                <a href="{{ route('home') }}"
                   class="block py-4 text-[11px] font-bold uppercase tracking-[0.3em] border-b transition-colors"
                   style="color:{{ request()->routeIs('home') ? '#B87333' : 'rgba(255,255,255,0.75)' }};border-color:rgba(184, 115, 51, 0.12);">Home</a>
                <a href="{{ route('shop.index') }}"
                   class="block py-4 text-[11px] font-bold uppercase tracking-[0.3em] border-b transition-colors"
                   style="color:{{ request()->routeIs('shop.*') ? '#B87333' : 'rgba(255,255,255,0.75)' }};border-color:rgba(184, 115, 51, 0.12);">Collection</a>
                <a href="{{ route('about') }}"
                   class="block py-4 text-[11px] font-bold uppercase tracking-[0.3em] border-b transition-colors"
                   style="color:{{ request()->routeIs('about') ? '#B87333' : 'rgba(255,255,255,0.75)' }};border-color:rgba(184, 115, 51, 0.12);">Heritage</a>
                <a href="{{ route('contact') }}"
                   class="block py-4 text-[11px] font-bold uppercase tracking-[0.3em] border-b transition-colors"
                   style="color:{{ request()->routeIs('contact') ? '#B87333' : 'rgba(255,255,255,0.75)' }};border-color:rgba(184, 115, 51, 0.12);">Concierge</a>
                @auth
                    <div class="pt-4 mt-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="block w-full text-left py-4 text-[11px] font-bold uppercase tracking-[0.3em] transition-colors"
                                    style="color:rgba(255,255,255,0.65);">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="mt-6">
                        <a href="{{ route('login') }}"
                           class="block w-full text-center py-4 font-bold tracking-[0.3em] text-[11px] uppercase rounded-sm"
                           style="background:#B87333;color:#FFFFFF;">LOGIN</a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow pt-24">
        @yield('content')
    </main>

    <!-- ══════════════════════ FOOTER ══════════════════════ -->
    <footer style="background:#2C2C2C;border-top:1px solid rgba(184, 115, 51, 0.20);" class="pt-20 pb-10">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-14 mb-20">

                <!-- Brand -->
                <div class="col-span-1 md:col-span-1">
                    <a href="{{ route('home') }}" class="font-heading tracking-tight text-2xl"
                       style="color:#B87333;">
                        Grand <span class="font-bold italic">Maison</span>
                    </a>
                    <p class="mt-6 text-sm leading-relaxed max-w-xs italic font-light"
                       style="color:rgba(255,255,255,0.55);">
                        "Curating the world's most exceptional spirits for the discerning clientele. A legacy of excellence since 1920."
                    </p>
                    <div class="mt-8 flex space-x-5">
                        <a href="#" style="color:#B87333;" class="transition-colors"
                           onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#B87333'">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" style="color:#B87333;" class="transition-colors"
                           onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#B87333'">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" style="color:#B87333;" class="transition-colors"
                           onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#B87333'">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Collections -->
                <div>
                    <h4 class="font-heading text-sm mb-8 uppercase tracking-[0.3em] font-bold" style="color:#B87333;">Collections</h4>
                    <ul class="space-y-4 text-[11px] uppercase tracking-widest" style="color:rgba(255,255,255,0.60);">
                        <li><a href="{{ route('shop.index') }}" class="transition-colors"
                               onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='rgba(255,255,255,0.60)'">Private Reserve</a></li>
                        <li><a href="{{ route('shop.index') }}" class="transition-colors"
                               onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='rgba(255,255,255,0.60)'">Rare Vintages</a></li>
                        <li><a href="{{ route('shop.index') }}" class="transition-colors"
                               onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='rgba(255,255,255,0.60)'">Limited Editions</a></li>
                        <li><a href="{{ route('shop.index') }}" class="transition-colors"
                               onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='rgba(255,255,255,0.60)'">Gift Sets</a></li>
                    </ul>
                </div>

                <!-- The House -->
                <div>
                    <h4 class="font-heading text-sm mb-8 uppercase tracking-[0.3em] font-bold" style="color:#B87333;">The House</h4>
                    <ul class="space-y-4 text-[11px] uppercase tracking-widest" style="color:rgba(255,255,255,0.60);">
                        <li><a href="{{ route('about') }}" class="transition-colors"
                               onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='rgba(255,255,255,0.60)'">Our Heritage</a></li>
                        <li><a href="{{ route('contact') }}" class="transition-colors"
                               onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='rgba(255,255,255,0.60)'">Concierge Service</a></li>
                        <li><a href="#" class="transition-colors"
                               onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='rgba(255,255,255,0.60)'">Global Shipping</a></li>
                        <li><a href="#" class="transition-colors"
                               onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='rgba(255,255,255,0.60)'">Returns Policy</a></li>
                    </ul>
                </div>

                <!-- Address -->
                <div>
                    <h4 class="font-heading text-sm mb-8 uppercase tracking-[0.3em] font-bold" style="color:#B87333;">Establishment</h4>
                    <address class="not-italic text-[11px] uppercase tracking-widest leading-loose mb-8"
                             style="color:rgba(255,255,255,0.60);">
                        7433 N Lindbergh Blvd<br>
                        Hazelwood, MO 63042<br>
                        United States
                    </address>
                    <a href="{{ route('contact') }}"
                       class="inline-block text-[10px] uppercase tracking-[0.3em] font-bold px-6 py-3 rounded-sm transition-all"
                       style="border:1px solid rgba(184, 115, 51, 0.40);color:#B87333;"
                       onmouseover="this.style.background='#B87333';this.style.color='#FFFFFF'"
                       onmouseout="this.style.background='transparent';this.style.color='#B87333'">Contact Us</a>
                </div>
            </div>

            <!-- Bottom bar -->
            <div class="flex flex-col md:flex-row justify-between items-center pt-10"
                 style="border-top:1px solid rgba(255,255,255,0.08);">
                <p class="text-[10px] tracking-[0.2em] uppercase" style="color:rgba(255,255,255,0.30);">
                    &copy; {{ date('Y') }} GRAND MAISON. All Rights Reserved. Drink Responsibly.
                </p>
                <div class="mt-5 md:mt-0">
                    <span class="text-[10px] uppercase tracking-[0.4em] font-bold italic" style="color:#B87333;">Excellence in every sip</span>
                </div>
            </div>
        </div>
    </footer>

    @include('partials.age-gate')
    @stack('scripts')
</body>
</html>
