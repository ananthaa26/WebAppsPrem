<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM('unpaid', 'pending', 'paid', 'processing', 'completed', 'failed', 'refunded') NOT NULL DEFAULT 'unpaid'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting this safely is complex if 'unpaid' records exist, 
        // so we'll just leave it or convert 'unpaid' to 'pending' before reverting if strictly needed.
    }
};
