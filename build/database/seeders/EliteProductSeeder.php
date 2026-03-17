<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class EliteProductSeeder extends Seeder
{
    public function run()
    {
        // define Categories
        $categories = [
            ['name' => 'Whiskey', 'image' => 'categories/whiskey.jpg', 'description' => 'Aged to perfection.'],
            ['name' => 'Wine', 'image' => 'categories/wine.jpg', 'description' => 'Fine wines from around the world.'],
            ['name' => 'Vodka', 'image' => 'categories/vodka.jpg', 'description' => 'Pure and crisp spirits.'],
            ['name' => 'Rum', 'image' => 'categories/rum.jpg', 'description' => 'The spirit of the tropics.'],
            ['name' => 'Tequila', 'image' => 'categories/tequila.jpg', 'description' => 'Authentic Mexican agave.'],
            ['name' => 'Champagne', 'image' => 'categories/champagne.jpg', 'description' => 'Celebrate with bubbles.'],
            ['name' => 'Beer', 'image' => 'categories/beer.jpg', 'description' => 'Craft and premium brews.'],
            ['name' => 'Premium Collection', 'image' => 'categories/premium.jpg', 'description' => 'Exclusive top-shelf bottles.'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'image' => $cat['image'],
                    'description' => $cat['description']
                ]
            );
        }

        // define Products
        $products = [
            [
                'category' => 'Whiskey',
                'name' => 'Macallan 18 Year Old',
                'brand' => 'Macallan',
                'price' => 350.00,
                'description' => 'Iconic single malt bonded in sherry oak casks for richness and complexity.',
                'tasting_notes' => 'Dried fruits, ginger, and toffee with a hint of wood smoke.',
                'alcohol_percentage' => 43.0,
                'country' => 'Scotland',
                'image' => 'products/macallan18.jpg',
                'is_featured' => true,
                'is_staff_pick' => true,
                'stock' => 10
            ],
            [
                'category' => 'Whiskey',
                'name' => 'Yamazaki 12 Year',
                'brand' => 'Suntory',
                'price' => 180.00,
                'description' => 'Pioneer of Japanese single malt, succulent with soft fruit.',
                'tasting_notes' => 'Peach, pineapple, grapefruit, clove, candied orange, vanilla.',
                'alcohol_percentage' => 43.0,
                'country' => 'Japan',
                'image' => 'products/yamazaki12.jpg',
                'is_featured' => true,
                'stock' => 15
            ],
            [
                'category' => 'Wine',
                'name' => 'Opus One 2018',
                'brand' => 'Opus One',
                'price' => 365.00,
                'description' => 'A Bordeaux-style blend from Napa Valley, elegant and balanced.',
                'tasting_notes' => 'Blackberry, cassis, tea leaves, and floral notes.',
                'alcohol_percentage' => 14.5,
                'country' => 'USA',
                'image' => 'products/opusone.jpg',
                'is_featured' => true,
                'is_staff_pick' => true,
                'stock' => 24
            ],
            [
                'category' => 'Champagne',
                'name' => 'Dom Pérignon Vintage 2012',
                'brand' => 'Dom Pérignon',
                'price' => 250.00,
                'description' => 'A full-bodied champagne with vibrant acidity and minerals.',
                'tasting_notes' => 'White flowers, apricot, rhubarb, and white pepper.',
                'alcohol_percentage' => 12.5,
                'country' => 'France',
                'image' => 'products/domperignon.jpg',
                'is_featured' => true,
                'stock' => 30
            ],
             [
                'category' => 'Tequila',
                'name' => 'Clase Azul Reposado',
                'brand' => 'Clase Azul',
                'price' => 160.00,
                'description' => 'Ultra-premium reposado tequila in a hand-painted decanter.',
                'tasting_notes' => 'Vanilla, cooked agave, and caramel.',
                'alcohol_percentage' => 40.0,
                'country' => 'Mexico',
                'image' => 'products/claseazul.jpg',
                'is_featured' => true,
                'is_staff_pick' => false,
                'stock' => 20
            ],
            [
                'category' => 'Vodka',
                'name' => 'Grey Goose VX',
                'brand' => 'Grey Goose',
                'price' => 75.00,
                'description' => 'Masterfully crafted vodka with a hint of precious cognac.',
                'tasting_notes' => 'White fruit blossom, plum, apricot, light citrus, and wild honey.',
                'alcohol_percentage' => 40.0,
                'country' => 'France',
                'image' => 'products/greygoosevx.jpg',
                'is_featured' => false,
                'stock' => 50
            ],
             [
                'category' => 'Rum',
                'name' => 'Ron Zacapa 23',
                'brand' => 'Ron Zacapa',
                'price' => 55.00,
                'description' => 'Aged in high altitude in Guatemala, sweet and spicy.',
                'tasting_notes' => 'Honey, butterscotch, spiced oak, and dried fruit.',
                'alcohol_percentage' => 40.0,
                'country' => 'Guatemala',
                'image' => 'products/zacapa.jpg',
                'is_featured' => false,
                'stock' => 40
            ],
            [
                'category' => 'Premium Collection',
                'name' => 'Louis XIII de Rémy Martin',
                'brand' => 'Rémy Martin',
                'price' => 4500.00,
                'description' => 'The king of cognacs, aged up to 100 years.',
                'tasting_notes' => 'Myrrh, honey, dried roses, plum, honeysuckle, mushroom.',
                'alcohol_percentage' => 40.0,
                'country' => 'France',
                'image' => 'products/louisxiii.jpg',
                'is_featured' => true,
                'is_staff_pick' => true,
                'stock' => 1
            ]
        ];

        foreach ($products as $prod) {
            $category = Category::where('name', $prod['category'])->first();
            
            Product::updateOrCreate(
                ['slug' => Str::slug($prod['name'])],
                [
                    'category_id' => $category->id,
                    'name' => $prod['name'],
                    'brand' => $prod['brand'],
                    'price' => $prod['price'],
                    'description' => $prod['description'],
                    'tasting_notes' => $prod['tasting_notes'],
                    'alcohol_percentage' => $prod['alcohol_percentage'],
                    'country' => $prod['country'],
                    'image' => $prod['image'],
                    'stock' => $prod['stock'],
                    'is_featured' => $prod['is_featured'],
                    'is_staff_pick' => $prod['is_staff_pick'] ?? false,
                ]
            );
        }
    }
}
