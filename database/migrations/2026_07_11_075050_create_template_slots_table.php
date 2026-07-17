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
    Schema::create('template_slots', function (Blueprint $table) {
        $table->id();
        $table->foreignId('template_section_id')->constrained()->cascadeOnDelete();
        $table->string('label');
        $table->enum('type', ['photo', 'text', 'qr_code']);
        $table->unsignedInteger('quantity')->default(1);
        $table->string('size_spec')->nullable();
        $table->unsignedInteger('char_limit')->nullable();
        $table->text('instructions')->nullable();
        $table->unsignedInteger('sort_order')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_slots');
    }
};
