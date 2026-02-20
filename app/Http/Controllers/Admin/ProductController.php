<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $productId = DB::table('products')->insertGetId([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . Str::random(5),
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $imagePath,
            'is_featured' => $request->has('is_featured'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->hasFile('gallery_images')) {
            foreach($request->file('gallery_images') as $file) {
                $path = $file->store('products/gallery', 'public');
                DB::table('product_images')->insert([
                    'product_id' => $productId,
                    'image' => $path,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $users = \App\Models\User::all();
        \Illuminate\Support\Facades\Notification::send($users, new \App\Notifications\NewProductNotification(
            $validated['name'],
            $validated['description'],
            $productId
        ));

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $categories = DB::table('categories')->get();
        $gallery_images = DB::table('product_images')->where('product_id', $id)->get();
        
        if (!$product) {
            abort(404);
        }

        return view('admin.products.edit', compact('product', 'categories', 'gallery_images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
        ]);

        $product = DB::table('products')->where('id', $id)->first();

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        DB::table('products')->where('id', $id)->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $imagePath,
            'is_featured' => $request->has('is_featured'),
            'updated_at' => now(),
        ]);

        if ($request->has('delete_gallery')) {
            $deleteIds = $request->input('delete_gallery');
            $imagesToDelete = DB::table('product_images')->whereIn('id', $deleteIds)->get();
            foreach ($imagesToDelete as $gImg) {
                if ($gImg->image) {
                    Storage::disk('public')->delete($gImg->image);
                }
            }
            DB::table('product_images')->whereIn('id', $deleteIds)->delete();
        }

        if ($request->hasFile('gallery_images')) {
            foreach($request->file('gallery_images') as $file) {
                $path = $file->store('products/gallery', 'public');
                DB::table('product_images')->insert([
                    'product_id' => $id,
                    'image' => $path,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        
        if ($product) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $gallery_images = DB::table('product_images')->where('product_id', $id)->get();
            foreach($gallery_images as $gImg) {
                if ($gImg->image) {
                    Storage::disk('public')->delete($gImg->image);
                }
            }
            
            DB::table('products')->where('id', $id)->delete();
        }

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
