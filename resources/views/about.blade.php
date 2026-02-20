@extends('layouts.app')

@section('title', 'About Us - Elm Grove Liquor')

@section('content')
<div class="container mt-3">
    <h1 class="mb-2 text-center">About Elm Grove Liquor</h1>
    <div style="max-width: 800px; margin: 0 auto; line-height: 1.8;">
        <p class="mb-2">
            Welcome to <strong>Elm Grove Liquor</strong>, Hazelwood's premier destination for fine spirits, craft beers, and exceptional wines. Established with a passion for quality and community, we have been serving the St. Louis area for over a decade.
        </p>
        <p class="mb-2">
            Our mission is simple: to provide an unparalleled selection of beverages coupled with knowledgeable, friendly service. Whether you are looking for a rare bourbon, a local craft brew, or the perfect wine for your dinner party, our staff is here to help you find exactly what you need.
        </p>
        <div style="text-align: center; margin: 40px 0;">
            <img src="https://placehold.co/800x400?text=Store+Interior" alt="Store Interior" style="max-width: 100%; border-radius: 8px;">
        </div>
        <h3 class="mb-1">Why Choose Us?</h3>
        <ul style="list-style-type: disc; padding-left: 20px;">
            <li><strong>Expert Selection:</strong> Hand-picked items from around the globe.</li>
            <li><strong>Local Focus:</strong> We proudly support Missouri breweries and distilleries.</li>
            <li><strong>Convenience:</strong> Easy online ordering with pickup and delivery options.</li>
        </ul>
    </div>
</div>
@endsection
