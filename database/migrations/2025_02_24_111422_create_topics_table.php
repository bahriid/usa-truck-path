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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['video', 'reading']);
            $table->string('title');
            // Video fields
            $table->string('duration')->nullable();
            $table->enum('source_from', ['youtube', 'vimeo', 'local', 'other'])->nullable();
            $table->string('video_url')->nullable(); // for remote sources
            $table->string('local_video')->nullable(); // for file upload when local
            // Reading fields
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
