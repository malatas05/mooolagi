<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('custom_requests', function (Blueprint $table) {
            $table->dropColumn(['budget_range', 'event_date', 'occasion']);
            $table->renameColumn('reference_image', 'payment_proof');
        });
    }

    public function down(): void
    {
        Schema::table('custom_requests', function (Blueprint $table) {
            $table->string('budget_range')->nullable();
            $table->date('event_date')->nullable();
            $table->string('occasion')->nullable();
            $table->renameColumn('payment_proof', 'reference_image');
        });
    }
};