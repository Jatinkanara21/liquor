<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Jack Daniel\'s Old No. 7', 'price' => 24.99, 'category' => 'Whiskey'],
            ['name' => 'Jameson Irish Whiskey', 'price' => 29.99, 'category' => 'Whiskey'],
            ['name' => 'Cabernet Sauvignon', 'price' => 19.99, 'category' => 'Wine'],
            ['name' => 'Chardonnay', 'price' => 15.99, 'category' => 'Wine'],
            ['name' => 'Bud Light 6-Pack', 'price' => 8.99, 'category' => 'Beer'],
            ['name' => 'Corona Extra 12-Pack', 'price' => 17.99, 'category' => 'Beer'],
            ['name' => 'Tito\'s Handmade Vodka', 'price' => 21.99, 'category' => 'Vodka'],
            ['name' => 'Grey Goose Vodka', 'price' => 34.99, 'category' => 'Vodka'],
            ['name' => 'Patron Silver', 'price' => 45.99, 'category' => 'Tequila'],
            ['name' => 'Don Julio 1942', 'price' => 149.99, 'category' => 'Tequila', 'is_featured' => true],
            ['name' => 'Bacardi Superior', 'price' => 16.99, 'category' => 'Rum'],
            ['name' => 'Hendrick\'s Gin', 'price' => 32.99, 'category' => 'Gin'],
        ];

        foreach ($products as $product) {
            $categoryId = DB::table('categories')->where('name', $product['category'])->value('id');

            DB::table('products')->insert([
                'category_id' => $categoryId,
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => 'A fine selection of ' . $product['name'] . '.',
                'price' => $product['price'],
                'stock' => 50,
                'is_featured' => $product['is_featured'] ?? false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
