<?php

use App\Models\Course;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
         // Disable events temporarily, and put the dispatcher back afterwards so later
         // code on this connection (other migrations, RefreshDatabase in tests) still has one.
         $dispatcher = DB::connection()->getEventDispatcher();
         DB::connection()->unsetEventDispatcher();

         // Method 1:  Using DB::table (more direct)
         $enrollments = DB::table('course_user')->whereNull('transaction_amount')->get();
         foreach ($enrollments as $enrollment) {
             $course = Course::find($enrollment->course_id); // Assumes you have a Course model.
             if ($course) {
                 DB::table('course_user')
                     ->where('user_id', $enrollment->user_id)
                     ->where('course_id', $enrollment->course_id)
                     ->update(['transaction_amount' => 47]);
             }
         }

         if ($dispatcher) {
             DB::connection()->setEventDispatcher($dispatcher);
         }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
