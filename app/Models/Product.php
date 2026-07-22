<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'image',
        'description',
        'is_active',
        'is_bestseller',
        'total_sold',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'product_id');
    }

    public function getAverageRatingAttribute()
    {
        $avg = $this->transactions()->whereNotNull('rating')->avg('rating');
        return $avg ? (float) $avg : 5.0;
    }
}
