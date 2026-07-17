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
    Schema::create('request_slot_values', function (Blueprint $table) {
        $table->id();
        $table->foreignId('custom_request_id')->constrained()->cascadeOnDelete();
        $table->foreignId('template_slot_id')->constrained()->cascadeOnDelete();
        $table->unsignedInteger('instance_index')->default(0);
        $table->text('value_text')->nullable();
        $table->string('value_file_path')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_slot_values');
    }
};
