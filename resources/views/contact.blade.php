@extends('layouts.app')

@section('title', 'Contact Us - Elm Grove Liquor')

@section('content')
<div class="container mt-3">
    <h1 class="mb-2 text-center">Contact Us</h1>
    
    <div style="display: flex; flex-wrap: wrap; gap: 40px; margin-top: 40px;">
        <div style="flex: 1; min-width: 300px;">
            <h3 class="mb-1">Get in Touch</h3>
            <p class="mb-1">Have a question about a product or your order? Give us a call or visit us in store!</p>
            
            <div style="margin-bottom: 20px;">
                <strong>Address:</strong><br>
                7433 N Lindbergh Blvd,<br>
                Hazelwood, MO 63042
            </div>
            
            <div style="margin-bottom: 20px;">
                <strong>Phone:</strong><br>
                (314) 837-0090
            </div>

            <div style="margin-bottom: 20px;">
                <strong>Email:</strong><br>
                info@elmgroveliquor.com
            </div>

            <h3 class="mb-1 mt-2">Store Hours</h3>
            <ul style="list-style: none;">
                <li><strong>Mon - Thu:</strong> 9:00 AM - 12:00 AM</li>
                <li><strong>Fri - Sat:</strong> 9:00 AM - 1:30 AM</li>
                <li><strong>Sun:</strong> 10:00 AM - 11:00 PM</li>
            </ul>
        </div>

        <div style="flex: 1; min-width: 300px;">
            <div style="width: 100%; height: 400px; background: #eee; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                <!-- Embed Google Map here in production -->
                <p style="color: #666;">Google Map Embed Placeholder</p>
            </div>
        </div>
    </div>
</div>
@endsection
