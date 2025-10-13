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
        Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->decimal('price', 8, 2)->default(0);
        $table->string('duration')->nullable(); // e.g., "3 months"
        $table->string('category')->nullable(); // e.g., "Programming, Design"
        $table->unsignedBigInteger('instructor_id')->nullable();
        $table->string('status')->default('draft'); // active, inactive, draft
        $table->boolean('is_active')->default(true); // Show in menu or not
        $table->integer('max_students')->nullable(); // Limit students
        $table->string('image')->nullable(); // Course thumbnail
        $table->timestamps();
        
        $table->foreign('instructor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
