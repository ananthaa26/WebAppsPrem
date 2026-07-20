<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'user_id',
        'product_id',
        'variant_id',
        'customer_contact',
        'quantity',
        'price_per_item',
        'total_price',
        'status',
        'payment_method',
        'payment_proof',
        'description_detail',
        'telegram_message_id',
        'paid_at',
        'completed_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
