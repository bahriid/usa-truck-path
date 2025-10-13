<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('legal_pages', function (Blueprint $table) {
            $table->id();
            $table->text('privacy_policy')->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->timestamps();
        });

        // Optionally, insert an initial record
        \DB::table('legal_pages')->insert([
            'privacy_policy' => 'Enter your privacy policy here...',
            'terms_and_conditions' => 'Enter your terms & conditions here...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('legal_pages');
    }
};
