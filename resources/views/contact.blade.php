@extends('layouts.app')

@section('title', 'Contact Us - Elm Grove Liquor')

@section('content')
<section class="bg-modern-gray min-h-screen py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-20 text-balance">
            <h1 class="text-5xl md:text-6xl font-heading text-modern-charcoal mb-16 text-center uppercase tracking-[0.2em] leading-tight">Private <span class="gold-gradient-text">Concierge</span></h1>
            <p class="text-modern-text-muted text-lg max-w-2xl mx-auto font-light">Whether you're seeking a rare acquisition or local favorites, our connoisseurs are ready to assist you.</p>
        </div>

            <!-- Contact Form Section -->
            <div class="max-w-4xl mx-auto mb-20 animate-fade-in">
                <div class="bg-white p-12 rounded-sm shadow-xl border border-modern-gold/10">
                    <h2 class="text-3xl font-heading text-modern-charcoal mb-8 text-center uppercase tracking-widest">Send an <span class="gold-gradient-text">Inquiry</span></h2>
                    <form action="#" method="POST" class="space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="text-[10px] text-modern-gold uppercase tracking-[0.2em] font-bold">Full Name</label>
                                <input type="text" name="name" class="w-full bg-modern-gray/30 border-b border-modern-gold/30 py-3 px-0 focus:border-modern-gold focus:outline-none text-modern-charcoal transition-all placeholder-modern-charcoal/30" placeholder="e.g. Julian Vane">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] text-modern-gold uppercase tracking-[0.2em] font-bold">Email Address</label>
                                <input type="email" name="email" class="w-full bg-modern-gray/30 border-b border-modern-gold/30 py-3 px-0 focus:border-modern-gold focus:outline-none text-modern-charcoal transition-all placeholder-modern-charcoal/30" placeholder="julian@vane.com">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] text-modern-gold uppercase tracking-[0.2em] font-bold">Subject of Inquiry</label>
                            <select name="subject" class="w-full bg-modern-gray/30 border-b border-modern-gold/30 py-3 px-0 focus:border-modern-gold focus:outline-none text-modern-charcoal transition-all appearance-none cursor-pointer">
                                <option>Private Acquisition</option>
                                <option>Tasting Event Inquiry</option>
                                <option>Concierge Recommendation</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] text-modern-gold uppercase tracking-[0.2em] font-bold">Your Message</label>
                            <textarea name="message" rows="4" class="w-full bg-modern-gray/30 border-b border-modern-gold/30 py-3 px-0 focus:border-modern-gold focus:outline-none text-modern-charcoal transition-all placeholder-modern-charcoal/30 resize-none" placeholder="How may we assist you?"></textarea>
                        </div>
                        <div class="flex justify-center pt-6">
                            <button type="submit" class="bg-modern-charcoal text-white px-16 py-5 font-bold uppercase tracking-[0.3em] text-[12px] hover:bg-modern-gold transition-all shadow-xl rounded-sm">
                                Submit Inquiry
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Map Area -->
            <div class="p-1 rounded-sm overflow-hidden h-96 relative border border-modern-gold/10 shadow-xl">
                <iframe 
                    class="w-full h-full opacity-90 shadow-inner"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3110.749455355605!2d-90.35474642407062!3d38.77093287175143!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87df2e3a6a9b40b1%3A0xe7a5050f75745778!2s7433%20N%20Lindbergh%20Blvd%2C%20Hazelwood%2C%20MO%2063042!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>
@endsection
