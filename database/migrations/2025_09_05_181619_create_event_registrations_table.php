<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('ticket_type');    // student/general/vip
            $table->unsignedInteger('amount'); // in BDT (৳)
            $table->string('payment_method'); // bkash/nagad/rocket/bank
            $table->string('transaction_id')->unique();
            $table->boolean('consent')->default(false);
            $table->string('status')->default('pending'); // pending/verified/cancelled
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('event_registrations');
    }
};
