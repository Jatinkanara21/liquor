<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DB::table('categories')
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->select('categories.*', DB::raw('COUNT(products.id) as products_count'))
            ->groupBy(
                'categories.id',
                'categories.name',
                'categories.slug',
                'categories.description',
                'categories.image',
                'categories.created_at',
                'categories.updated_at'
            )
            ->orderBy('name', 'asc')
            ->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        DB::table('categories')->insert([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
            'image' => $imagePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
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
        $category = DB::table('categories')->where('id', $id)->first();
        
        if (!$category) {
            abort(404);
        }

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $category = DB::table('categories')->where('id', $id)->first();

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        DB::table('categories')->where('id', $id)->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']), // Ideally slug shouldn't change often but here we update it
            'description' => $validated['description'],
            'image' => $imagePath,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        
        if ($category) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            // Check constraints? Products might be orphaned or cascade delete if set up in migration
            DB::table('categories')->where('id', $id)->delete();
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
