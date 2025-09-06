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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            // Applicant info
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('profession')->nullable();
            $table->string('address')->nullable();

            // Membership
            $table->string('membership_type'); // 'yearly'|'lifetime'
            $table->unsignedInteger('fee')->default(0);
            $table->boolean('is_paid')->default(false);
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();

            // File
            $table->string('photo_path')->nullable(); // storage path

            // Status
            $table->string('status')->default('pending'); // 'pending'|'approved'|'rejected'
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();

            // Membership window
            $table->string('membership_no')->nullable()->unique(); // e.g., RAK-2025-0001
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable(); // yearly only

            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
