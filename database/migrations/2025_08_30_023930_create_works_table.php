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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_category_id')->nullable()
                  ->constrained('work_categories')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('author_name')->nullable();
            $table->string('image')->nullable();                 // storage path
            $table->string('excerpt', 300)->nullable();          // short summary
            $table->longText('body')->nullable();                // full content
            $table->dateTime('published_at')->nullable()->index();
            $table->unsignedInteger('priority')->default(0);     // for ordering
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
