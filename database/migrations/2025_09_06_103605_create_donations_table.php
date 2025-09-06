<?php

// database/migrations/2025_09_06_000001_create_donations_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_cause_id')->nullable()->constrained('donation_causes')->nullOnDelete();

            $table->decimal('amount', 12, 2);
            $table->enum('payment_method', ['bkash','nagad','card','bank'])->nullable();

            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->text('note')->nullable();

            $table->enum('status', ['pending','approved','rejected'])->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();

            // Optional: gateway refs
            $table->string('transaction_id')->nullable();
            $table->json('meta')->nullable();

            $table->timestamps();
            $table->index(['status', 'donation_cause_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('donations');
    }
};
