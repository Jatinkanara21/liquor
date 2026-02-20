<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = \App\Models\Product::where('is_featured', true)->limit(8)->get();
        $staffPicks = \App\Models\Product::where('is_staff_pick', true)->limit(4)->get();
            
        return view('home', compact('featuredProducts', 'staffPicks'));
    }
}
