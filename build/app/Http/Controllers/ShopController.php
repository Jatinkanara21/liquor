<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Product::query();

        // Filter by Category (if passed as query param or route param logic handled in category method)
        if ($request->has('category')) {
            $category = \App\Models\Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by Brand
        if ($request->has('brand')) {
            $query->whereIn('brand', (array)$request->brand);
        }

        // Filter by Price Range
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
             $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = \App\Models\Category::all();
        $brands = \App\Models\Product::select('brand')->distinct()->whereNotNull('brand')->pluck('brand');
        
        return view('shop.index', compact('products', 'categories', 'brands'));
    }

    public function category($slug)
    {
        // Redirect to index with category query param to maintain single source of truth for filtering
        return redirect()->route('shop.index', ['category' => $slug]);
    }

    public function show($slug)
    {
        $product = \App\Models\Product::where('slug', $slug)->firstOrFail();
        
        $relatedProducts = \App\Models\Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }
}
