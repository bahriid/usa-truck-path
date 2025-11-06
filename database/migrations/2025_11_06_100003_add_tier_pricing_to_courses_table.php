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
        Schema::table('courses', function (Blueprint $table) {
            $table->decimal('premium_price', 8, 2)
                  ->default(150.00)
                  ->after('price')
                  ->comment('Price for premium tier upgrade');

            $table->decimal('mentorship_price', 8, 2)
                  ->default(297.00)
                  ->after('premium_price')
                  ->comment('Price for mentorship tier upgrade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['premium_price', 'mentorship_price']);
        });
    }
};
