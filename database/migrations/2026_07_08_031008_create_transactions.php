<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();
            $table->foreignId('variant_id')
                ->nullable()
                ->constrained('product_variants')
                ->nullOnDelete();
            $table->string('customer_contact');
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedBigInteger('price_per_item');
            $table->unsignedBigInteger('total_price');
            $table->enum('status', ['pending', 'paid', 'processing', 'completed', 'failed', 'refunded'])->default('pending');
            $table->enum('payment_method', ['qris', 'saldo'])->nullable();
            $table->string('payment_proof')->nullable();
            $table->text('description_detail')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
