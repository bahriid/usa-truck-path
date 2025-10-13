<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('course_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable();
            // Type could be: image, pdf, text, video, external_link, etc.
            $table->string('type');
            // For file uploads (images, pdfs, videos, text files)
            $table->string('file_path')->nullable();
            // For external links if type is external_link
            $table->string('external_link')->nullable();
            // For text content
            $table->text('content_text')->nullable();
            // Additional metadata in JSON format (if needed)
            $table->json('meta')->nullable();
            // Order to sort contents if needed
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_contents');
    }
};
