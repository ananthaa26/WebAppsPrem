<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variants';

    protected $fillable = [
        'product_id',
        'label',
        'duration_days',
        'price',
        'original_price',
        'stock',
        'is_active',
        'sort_order',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
