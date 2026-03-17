@extends('layouts.app')

@section('title', 'GRAND MAISON | Premium Spirits & Fine Liquor')
@section('meta_description', 'Grand Maison — curating the world\'s most exceptional spirits. Rare whiskeys, fine wines, and exclusive collections for the true connoisseur.')

@push('styles')
<style>
/* ────────────────────────────────────────────────
   PALETTE
   Background : #F4F4F4  (Light Gray)
   Primary    : #2C2C2C  (Charcoal)
   Accent     : #B87333  (Copper)
   Secondary  : #444444
   Text       : #1A1A1A
──────────────────────────────────────────────── */

/* ── Hero ── */
.hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: #2C2C2C;
}
.hero-overlay {
    background: linear-gradient(
        160deg,
        rgba(44, 44, 44, 0.94) 0%,
        rgba(44, 44, 44, 0.80) 40%,
        rgba(68, 68, 68, 0.92) 100%
    );
}
@keyframes heroFadeUp {
    from { opacity:0; transform:translateY(28px); }
    to   { opacity:1; transform:translateY(0); }
}
.hero-content > * { animation: heroFadeUp 0.9s ease both; }
.hero-content > *:nth-child(1) { animation-delay: 0.10s; }
.hero-content > *:nth-child(2) { animation-delay: 0.28s; }
.hero-content > *:nth-child(3) { animation-delay: 0.44s; }
.hero-content > *:nth-child(4) { animation-delay: 0.60s; }

/* ── Copper CTA ── */
.btn-copper {
    display: inline-block;
    background: linear-gradient(135deg, #D29052 0%, #B87333 60%, #8E5624 100%);
    color: #FFFFFF;
    font-weight: 700;
    font-size: 11px;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    padding: 18px 46px;
    border-radius: 2px;
    transition: all 0.35s ease;
    box-shadow: 0 6px 28px rgba(184, 115, 51, 0.35);
    position: relative;
    overflow: hidden;
}
.btn-copper:hover { transform: translateY(-2px); box-shadow: 0 10px 36px rgba(184, 115, 51, 0.45); }

.btn-outline-copper {
    display: inline-block;
    color: #B87333;
    font-weight: 700;
    font-size: 11px;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    padding: 17px 46px;
    border-radius: 2px;
    border: 1.5px solid rgba(184, 115, 51, 0.50);
    transition: all 0.35s ease;
    background: transparent;
}
.btn-outline-copper:hover {
    background: rgba(184, 115, 51, 0.10);
    border-color: #B87333;
    color: #D29052;
    transform: translateY(-2px);
}

/* ── Scroll indicator ── */
@keyframes scrollBounce {
    0%,100% { transform:translateY(0); }
    50%      { transform:translateY(8px); }
}
.scroll-dot { animation: scrollBounce 2s ease-in-out infinite; }

/* ── Copper divider ── */
.copper-divider {
    width: 48px;
    height: 2px;
    background: linear-gradient(90deg, #B87333, #D29052, #B87333);
    border-radius: 1px;
}

/* ── Section label ── */
.section-tag {
    font-size: 10px;
    letter-spacing: 0.5em;
    text-transform: uppercase;
    font-weight: 700;
    color: #B87333;
}

/* ── Stats strip ── */
.stats-strip { background: linear-gradient(135deg, #2C2C2C 0%, #444444 50%, #2C2C2C 100%); }

/* ── Category cards ── */
.cat-card {
    position: relative;
    height: 520px;
    overflow: hidden;
    background: #2C2C2C;
    transition: all 0.6s cubic-bezier(0.165,0.84,0.44,1);
    border-radius: 3px;
}
.cat-card img { transition: transform 1.1s ease, opacity 0.6s ease; }
.cat-card:hover img { transform: scale(1.12); opacity: 0.60; }
.cat-card .cat-border {
    position:absolute; inset:16px;
    border: 1px solid rgba(184, 115, 51, 0);
    transition: border-color 0.6s;
    pointer-events:none;
    border-radius:2px;
    z-index:2;
}
.cat-card:hover .cat-border { border-color: rgba(184, 115, 51, 0.40); }
.cat-card .cat-copper-line {
    width:0; height:1px;
    background:#B87333;
    margin:0 auto;
    transition: width 0.5s ease;
}
.cat-card:hover .cat-copper-line { width:44px; }
.cat-card .cat-link {
    opacity:0; transform:translateY(12px);
    transition: all 0.55s ease 0.1s;
}
.cat-card:hover .cat-link { opacity:1; transform:translateY(0); }

/* ── Staff pick cards ── */
.staff-card {
    border: 1px solid rgba(184, 115, 51, 0.12);
    transition: border-color 0.45s, transform 0.4s;
    background: rgba(255,255,255,0.03);
    border-radius: 2px;
}
.staff-card:hover {
    border-color: rgba(184, 115, 51, 0.40);
    transform: translateY(-4px);
}
.staff-card .bottle-wrap { transition: transform 0.65s ease; }
.staff-card:hover .bottle-wrap { transform: scale(1.10); }

/* ── New Arrivals cards ── */
.arrival-card {
    background: #fff;
    border: 1px solid rgba(44, 44, 44, 0.08);
    transition: all 0.4s ease;
    border-radius: 3px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
}
.arrival-card:hover {
    border-color: rgba(184, 115, 51, 0.42);
    box-shadow: 0 12px 40px rgba(0,0,0,0.08);
    transform: translateY(-5px);
}
.arrival-card .product-img { transition: transform 0.65s ease; }
.arrival-card:hover .product-img { transform: scale(1.08); }

/* ── Feature card ── */
.feature-card {
    background: #fff;
    border: 1px solid rgba(44, 44, 44, 0.08);
    border-radius: 3px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.04);
    transition: all 0.4s ease;
}
.feature-card:hover {
    border-color: rgba(184, 115, 51, 0.40);
    box-shadow: 0 12px 40px rgba(0,0,0,0.08);
}
</style>
@endpush

@section('content')

{{-- ════════════════════════════════════════════
     HERO
════════════════════════════════════════════ --}}
<div class="hero-section">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/defaults/hero.png') }}"
             alt="Premium Spirits" class="w-full h-full object-cover"
             style="opacity:0.35;transform:scale(1.06);">
        <div class="hero-overlay absolute inset-0"></div>
        <div class="absolute bottom-0 left-0 right-0 h-48"
             style="background:linear-gradient(to top,#2C2C2C,transparent);"></div>
    </div>

    {{-- Side label --}}
    <div class="absolute left-8 top-1/2 -translate-y-1/2 hidden xl:flex flex-col items-center gap-4 z-10">
        <span class="text-[9px] uppercase tracking-[0.5em] font-bold"
              style="color:rgba(184, 115, 51, 0.50);writing-mode:vertical-rl;transform:rotate(180deg);">Est. 1920</span>
        <div style="width:1px;height:80px;background:linear-gradient(to bottom,transparent,rgba(184, 115, 51, 0.50));"></div>
    </div>

    <div class="container relative z-10 px-6 text-center">
        <div class="max-w-5xl mx-auto hero-content">
            <span class="inline-block px-6 py-2 text-[10px] font-bold uppercase tracking-[0.6em] mb-8 rounded-full"
                  style="color:#B87333;border:1px solid rgba(184, 115, 51, 0.32);background:rgba(184, 115, 51, 0.12);">
                Established 1920 · Premium Spirits
            </span>

            <h1 class="font-heading font-medium text-white mb-8 leading-none tracking-tight"
                style="font-size:clamp(3.5rem,10vw,8rem);">
                The Art of<br>
                <span style="background:linear-gradient(135deg,#D29052 0%,#B87333 50%,#8E5624 100%);
                             -webkit-background-clip:text;-webkit-text-fill-color:transparent;
                             background-clip:text;font-style:italic;font-weight:400;">
                    Fine Spirits
                </span>
            </h1>

            <p class="text-lg md:text-xl max-w-2xl mx-auto mb-12 font-light italic leading-relaxed"
               style="color:rgba(255,255,255,0.65);">
                "Curating the world's most exceptional vintages and rare barrel captures for the true connoisseur."
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-5">
                <a href="{{ route('shop.index') }}" class="btn-copper">Shop Collection</a>
                <a href="{{ route('about') }}" class="btn-outline-copper">Our Heritage</a>
            </div>
        </div>
    </div>

    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-3 z-10">
        <span class="text-[8px] uppercase tracking-[0.5em]" style="color:rgba(255,255,255,0.35);">Scroll</span>
        <div class="scroll-dot w-5 h-5 rounded-full flex items-center justify-center"
             style="border:1px solid rgba(184, 115, 51, 0.40);">
            <div class="w-1.5 h-1.5 rounded-full" style="background:#B87333;"></div>
        </div>
    </div>
</div>

{{-- ════════════════════════════════════════════
     STATS STRIP
════════════════════════════════════════════ --}}
<div class="stats-strip py-12">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            @foreach([
                ['500+','Premium Labels'],
                ['100+','Rare Vintages'],
                ['50+','Countries Served'],
                ['20K+','Happy Clients'],
            ] as [$num, $label])
            <div>
                <p class="font-heading text-3xl md:text-4xl font-bold mb-1" style="color:#B87333;">{{ $num }}</p>
                <p class="text-[10px] uppercase tracking-[0.4em] font-bold" style="color:rgba(255,255,255,0.60);">{{ $label }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ════════════════════════════════════════════
     COLLECTIONS GRID  (light gray bg)
════════════════════════════════════════════ --}}
<section class="py-32" style="background:#F4F4F4;">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <p class="section-tag mb-4">Curated</p>
            <h2 class="font-heading text-4xl md:text-5xl uppercase tracking-wide mb-5" style="color:#2C2C2C;">
                The Collections
            </h2>
            <div class="copper-divider mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($categories as $category)
                <a href="{{ route('shop.category', $category->slug) }}" class="cat-card group">
                    @php
                        $catName = strtolower($category->name);
                        $fallback = 'whiskey_default.png';
                        if (str_contains($catName,'wine'))      $fallback='wine_default.png';
                        elseif(str_contains($catName,'vodka'))  $fallback='vodka_default.png';
                        elseif(str_contains($catName,'rum'))    $fallback='rum_default.png';
                        elseif(str_contains($catName,'tequila'))$fallback='tequila_default.png';
                        elseif(str_contains($catName,'champagne'))$fallback='champagne_default.png';
                        elseif(str_contains($catName,'beer'))   $fallback='beer_default.png';
                        elseif(str_contains($catName,'premium'))$fallback='hero.png';
                    @endphp
                    @if($category->image && !str_contains($category->image,'categories/'))
                        <img src="{{ Str::startsWith($category->image,['http','data:']) ? $category->image : Storage::url($category->image) }}"
                             alt="{{ $category->name }}" class="absolute inset-0 w-full h-full object-cover" style="opacity:0.55;">
                    @else
                        <img src="{{ asset('images/defaults/'.$fallback) }}"
                             alt="{{ $category->name }}" class="absolute inset-0 w-full h-full object-cover" style="opacity:0.55;">
                    @endif
                    <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(44, 44, 44, 0.95) 0%,rgba(44, 44, 44, 0.40) 50%,transparent 100%);"></div>
                    <div class="cat-border"></div>
                    <div class="cat-info absolute bottom-0 left-0 w-full p-10 text-center">
                        <h3 class="font-heading text-3xl uppercase tracking-widest leading-none mb-5 text-white transition-colors duration-400 group-hover:text-amber-200">
                            {{ $category->name }}
                        </h3>
                        <div class="cat-copper-line mb-5"></div>
                        <p class="cat-link text-[10px] font-bold uppercase tracking-[0.3em]" style="color:rgba(184, 115, 51, 0.90);">View Collection →</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     EXPERT SELECTION  (charcoal bg)
════════════════════════════════════════════ --}}
<section class="py-32 relative overflow-hidden" style="background:#2C2C2C;">
    <div class="absolute inset-0 opacity-10 pointer-events-none"
         style="background-image:repeating-linear-gradient(45deg,rgba(184, 115, 51, 0.06) 0,rgba(184, 115, 51, 0.06) 1px,transparent 0,transparent 50%);background-size:24px 24px;"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16">
            <div class="text-center md:text-left">
                <p class="section-tag mb-4">Cellar Master's Choice</p>
                <h2 class="font-heading text-4xl md:text-5xl uppercase tracking-wide leading-tight text-white">Expert Selection</h2>
            </div>
            <a href="{{ route('shop.index') }}"
               class="mt-8 md:mt-0 text-[10px] uppercase tracking-[0.4em] font-bold pb-1.5 transition-colors"
               style="color:#B87333;border-bottom:1px solid rgba(184, 115, 51, 0.35);"
               onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#B87333'">Discover All →</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($staffPicks as $product)
                <div class="staff-card group p-7 text-center flex flex-col items-center h-full">
                    <div class="aspect-[3/4] relative w-full flex items-center justify-center mb-8">
                        @php
                            $pn=strtolower($product->name);$pf='whiskey_default.png';
                            if(str_contains($pn,'macallan'))$pf='../products/macallan18.png';
                            elseif(str_contains($pn,'clase azul'))$pf='../products/clase_azul.png';
                            elseif(str_contains($pn,'dom perignon'))$pf='../products/domperignon.png';
                            elseif(str_contains($pn,'wine'))$pf='wine_default.png';
                            elseif(str_contains($pn,'vodka'))$pf='vodka_default.png';
                            elseif(str_contains($pn,'tequila'))$pf='tequila_default.png';
                            elseif(str_contains($pn,'champagne'))$pf='champagne_default.png';
                            elseif(str_contains($pn,'beer'))$pf='beer_default.png';
                        @endphp
                        @if($product->image && !str_contains($product->image,'products/'))
                            <img src="{{ Str::startsWith($product->image,['http','data:']) ? $product->image : Storage::url($product->image) }}"
                                 alt="{{ $product->name }}" class="max-h-full object-contain bottle-wrap"
                                 style="filter:drop-shadow(0 20px 40px rgba(0,0,0,0.50));">
                        @else
                            <img src="{{ asset('images/defaults/'.$pf) }}"
                                 alt="{{ $product->name }}" class="max-h-full object-contain bottle-wrap"
                                 style="filter:drop-shadow(0 20px 40px rgba(0,0,0,0.50));">
                        @endif
                        <div class="absolute top-0 right-0">
                            <span class="text-[8px] font-bold px-3 py-1 uppercase tracking-widest rounded-sm"
                                  style="background:#B87333;color:#FFFFFF;">Reserve</span>
                        </div>
                    </div>
                    <div class="mt-auto w-full">
                        <span class="text-[9px] uppercase tracking-[0.3em] block mb-2" style="color:rgba(184, 115, 51, 0.70);">{{ $product->brand ?? 'Exclusive' }}</span>
                        <h3 class="font-heading text-lg uppercase tracking-wider mb-3 line-clamp-1 text-white transition-colors"
                            onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='#fff'">{{ $product->name }}</h3>
                        <div class="copper-divider mx-auto mb-5"></div>
                        <span class="font-bold text-xl block mb-5" style="color:#B87333;">${{ number_format($product->price,2) }}</span>
                        <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="id"    value="{{ $product->id }}">
                            <input type="hidden" name="name"  value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <button type="submit"
                                    class="w-full py-3.5 text-[9px] font-bold uppercase tracking-[0.3em] rounded-sm transition-all"
                                    style="border:1px solid rgba(184, 115, 51, 0.35);color:#B87333;background:transparent;"
                                    onmouseover="this.style.background='#B87333';this.style.color='#FFFFFF';this.style.borderColor='#B87333'"
                                    onmouseout="this.style.background='transparent';this.style.color='#B87333';this.style.borderColor='rgba(184, 115, 51, 0.35)'">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     NEW ARRIVALS  (light gray bg)
════════════════════════════════════════════ --}}
<section class="py-32" style="background:#F4F4F4;">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <p class="section-tag mb-4">Latest</p>
            <h2 class="font-heading text-4xl md:text-5xl uppercase tracking-wide mb-5" style="color:#1A1A1A;">New Arrivals</h2>
            <div class="copper-divider mx-auto mb-4"></div>
            <p class="text-sm italic font-light max-w-lg mx-auto mt-6" style="color:rgba(26, 26, 26, 0.65);">
                Freshly added to our curated cellar — discover what's new this season.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredProducts as $product)
                <a href="{{ route('shop.show', $product->slug) }}" class="group block h-full">
                    <div class="arrival-card h-full flex flex-col overflow-hidden">
                        <div class="relative flex items-center justify-center p-10 overflow-hidden"
                             style="background:#EAEAEA;aspect-ratio:1;">
                            @php
                                $pn=strtolower($product->name);$pf='whiskey_default.png';
                                if(str_contains($pn,'macallan'))$pf='../products/macallan18.png';
                                elseif(str_contains($pn,'clase azul'))$pf='../products/clase_azul.png';
                                elseif(str_contains($pn,'dom perignon'))$pf='../products/domperignon.png';
                                elseif(str_contains($pn,'wine'))$pf='wine_default.png';
                                elseif(str_contains($pn,'vodka'))$pf='vodka_default.png';
                                elseif(str_contains($pn,'tequila'))$pf='tequila_default.png';
                                elseif(str_contains($pn,'champagne'))$pf='champagne_default.png';
                                elseif(str_contains($pn,'beer'))$pf='beer_default.png';
                            @endphp
                            @if($product->image && !str_contains($product->image,'products/'))
                                <img src="{{ Str::startsWith($product->image,['http','data:']) ? $product->image : Storage::url($product->image) }}"
                                     alt="{{ $product->name }}" class="max-h-full max-w-full object-contain product-img"
                                     style="filter:drop-shadow(0 16px 32px rgba(44, 44, 44, 0.15));">
                            @else
                                <img src="{{ asset('images/defaults/'.$pf) }}"
                                     alt="{{ $product->name }}" class="max-h-full max-w-full object-contain product-img"
                                     style="filter:drop-shadow(0 16px 32px rgba(44, 44, 44, 0.15));">
                            @endif
                            <div class="absolute top-4 left-4">
                                <span class="text-[8px] font-bold px-2.5 py-1 uppercase tracking-wider"
                                      style="background:#2C2C2C;color:#B87333;border-radius:2px;">New</span>
                            </div>
                        </div>
                        <div class="p-7 flex-grow flex flex-col justify-between text-center">
                            <div>
                                <p class="text-[9px] font-bold uppercase tracking-[0.3em] mb-3" style="color:#B87333;">{{ $product->category->name ?? 'Spirit' }}</p>
                                <h3 class="font-heading text-lg uppercase tracking-wider leading-tight mb-3 line-clamp-1 transition-colors"
                                    style="color:#1A1A1A;"
                                    onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='#1A1A1A'">{{ $product->name }}</h3>
                                <p class="text-xs italic font-light leading-relaxed line-clamp-2 mb-5" style="color:rgba(26, 26, 26, 0.70);">{{ $product->description }}</p>
                            </div>
                            <div class="flex items-center justify-between pt-4" style="border-top:1px solid rgba(26, 26, 26, 0.10);">
                                <span class="font-bold text-lg" style="color:#B87333;">${{ number_format($product->price,2) }}</span>
                                <span class="text-[9px] font-bold uppercase tracking-widest transition-colors" style="color:#2C2C2C;">View →</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="text-center mt-14">
            <a href="{{ route('shop.index') }}" class="btn-copper">Explore Full Collection</a>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     BRAND QUOTE  (dark secondary bg)
════════════════════════════════════════════ --}}
<section class="py-28 relative overflow-hidden" style="background:#444444;">
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-5">
        <span class="font-heading text-white select-none" style="font-size:30vw;line-height:1;">"</span>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <div class="copper-divider mx-auto mb-12"></div>
            <p class="font-heading text-3xl md:text-4xl leading-relaxed italic font-light text-white mb-10">
                Whiskey is what gas is to a car —<br>
                <span style="color:#B87333;">it makes the world go round</span>, and keeps the engine of life purring with excellence.
            </p>
            <div class="copper-divider mx-auto mt-10"></div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     WHY GRAND MAISON  (light gray bg)
════════════════════════════════════════════ --}}
<section class="py-28" style="background:#F4F4F4;">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <p class="section-tag mb-4">Our Promise</p>
            <h2 class="font-heading text-4xl md:text-5xl uppercase tracking-wide" style="color:#1A1A1A;">Why Grand Maison</h2>
            <div class="copper-divider mx-auto mt-5"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach([
                ['🏅','Authenticated Labels','Every bottle verified authentic, sourced directly from distilleries and award-winning cellars worldwide.'],
                ['🚚','White-Glove Delivery','Temperature-controlled, discreet shipping to your door — anywhere in the world.'],
                ['🥃','Expert Curation','Our master sommeliers hand-select each product to ensure only the finest reach your glass.'],
            ] as [$icon, $title, $desc])
            <div class="feature-card text-center px-8 py-10">
                <div class="text-4xl mb-5">{{ $icon }}</div>
                <h3 class="font-heading text-xl uppercase tracking-widest mb-4" style="color:#1A1A1A;">{{ $title }}</h3>
                <div class="copper-divider mx-auto mb-4"></div>
                <p class="text-sm leading-relaxed italic font-light" style="color:rgba(26, 26, 26, 0.70);">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
