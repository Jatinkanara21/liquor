<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => DB::table('products')->count(),
            'categories' => DB::table('categories')->count(),
            'orders' => DB::table('orders')->count(),
            'revenue' => DB::table('orders')->sum('total'),
        ];

        $recentOrders = DB::table('orders')->orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
