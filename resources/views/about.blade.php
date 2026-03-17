@extends('layouts.app')

@section('title', 'About Us - Elm Grove Liquor')

@section('content')
<section class="bg-modern-beige min-h-screen py-20">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-6xl font-heading text-modern-charcoal mb-12 text-center uppercase tracking-widest leading-tight">Our <span class="gold-gradient-text">Heritage</span></h1>
            
            <div class="glass-card p-12 mb-16 relative overflow-hidden border border-modern-gold/10">
                <div class="absolute top-0 right-0 w-32 h-32 bg-modern-gold/5 rounded-full -mr-16 -mt-16 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-modern-gold/5 rounded-full -ml-16 -mb-16 blur-2xl"></div>
                <div class="relative z-10">
                    <p class="text-xl text-modern-gold font-heading italic mb-8 border-l-4 border-modern-gold pl-6 leading-relaxed">
                        "Elegance is not about being noticed, it's about being remembered."
                    </p>
                    <div class="space-y-6 text-modern-text-muted leading-relaxed text-lg">
                        <p>
                            Welcome to <strong class="text-modern-charcoal font-semibold">Elm Grove Liquor</strong>, Hazelwood's premier destination for fine spirits, craft beers, and exceptional wines. Established with a passion for quality and community, we have been serving the St. Louis area for over a decade.
                        </p>
                        <p>
                            Our mission is simple: to provide an unparalleled selection of beverages coupled with knowledgeable, friendly service. Whether you are looking for a rare bourbon, a local craft brew, or the perfect wine for your dinner party, our staff is here to help you find exactly what you need.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-16">
                        <div class="glass-card p-10 border border-modern-gold/10">
                            <h3 class="text-2xl font-heading text-modern-charcoal mb-6 uppercase tracking-widest">Our Mission</h3>
                            <p class="text-modern-text-muted leading-relaxed">To curate the world's most exceptional spirits, providing our clientele with an unmatched selection of rare vintages and premium labels.</p>
                        </div>
                        <div class="glass-card p-10 border border-modern-gold/10">
                            <h3 class="text-2xl font-heading text-modern-charcoal mb-6 uppercase tracking-widest">The Experience</h3>
                            <p class="text-modern-text-muted leading-relaxed">Beyond a mere store, we offer a journey through history, craftsmanship, and the art of fine drinking.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Section -->
            <div class="relative w-full mt-16">
                <div class="relative z-10 rounded-sm overflow-hidden shadow-2xl glass-card p-3 border border-modern-gold/20">
                    <img src="{{ asset('images/defaults/store_interior.png') }}" alt="Elm Grove Store Interior" class="w-full h-full object-cover rounded-sm">
                </div>
                <!-- Decorative Elements -->
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-modern-gold/10 blur-3xl rounded-full"></div>
                <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-modern-charcoal/5 blur-3xl rounded-full"></div>
            </div>
        </div>
    </div>
</section>
@endsection
