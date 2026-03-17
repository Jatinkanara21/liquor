<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'tasting_notes',
        'brand',
        'country',
        'alcohol_percentage',
        'price',
        'image',
        'stock',
        'is_featured',
        'is_staff_pick',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
