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
    Schema::create('custom_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        $table->enum('status', [
            'pending',
            'reviewed',
            'quoted',
            'confirmed',
            'in_progress',
            'completed',
            'cancelled',
        ])->default('pending');

        // Field untuk produk 'simple'
        $table->string('budget_range')->nullable();
        $table->unsignedInteger('quantity')->nullable();
        $table->date('event_date')->nullable();
        $table->string('occasion')->nullable();
        $table->string('reference_image')->nullable();

        $table->text('customer_notes')->nullable();
        $table->text('admin_notes')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_requests');
    }
};
