<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('note');
            $table->enum('status', ['pending', 'paid', 'processing', 'completed', 'cancelled'])->default('pending')->after('payment_proof');
        });
    }
    
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['payment_proof', 'status']);
        });
    }
};    
