<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart');
        if(!$cart || count($cart) == 0) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }
        
        $total = 0;
        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('checkout.index', compact('total'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'type' => 'required|in:pickup,delivery',
            'address' => 'required_if:type,delivery|nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cart = session()->get('cart');
        if(!$cart || count($cart) == 0) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        DB::beginTransaction();

        try {
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => auth()->id(), // Nullable if guest
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'status' => 'pending',
                'total' => $total,
                'type' => $request->type,
                'address' => $request->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach($cart as $id => $details) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('home')->with('success', 'Order placed successfully! We will contact you shortly.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
