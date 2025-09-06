<?php

// database/migrations/2025_09_06_000000_create_donation_causes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('donation_causes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();     // e.g., Zakat, Education Support, Medical Fund...
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('priority')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('donation_causes');
    }
};
