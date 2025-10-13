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
        Schema::table('course_user', function (Blueprint $table) {
            $table->decimal('transaction_amount', 8, 2)->nullable()->after('user_id');
            // ->nullable() makes the column accept null values.  Consider if this is appropriate for your needs.
            // ->after('user_id')  This places the new column after user_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_user', function (Blueprint $table) {
            $table->dropColumn('transaction_amount');
        });
    }
};
