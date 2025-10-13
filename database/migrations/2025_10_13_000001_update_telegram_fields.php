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
            // Add telegram_chat_id if it doesn't exist
            if (!Schema::hasColumn('courses', 'telegram_chat_id')) {
                $table->string('telegram_chat_id')->nullable()->after('menu_name')->comment('Telegram group/channel ID (e.g., -1001234567890)');
            }

            // Drop old telegram_group_link column if it exists
            if (Schema::hasColumn('courses', 'telegram_group_link')) {
                $table->dropColumn('telegram_group_link');
            }
        });

        Schema::table('course_user', function (Blueprint $table) {
            // Add new telegram invite link fields if they don't exist
            if (!Schema::hasColumn('course_user', 'telegram_invite_link')) {
                $table->string('telegram_invite_link')->nullable()->after('transaction_id')->comment('Generated Telegram invite link');
            }

            if (!Schema::hasColumn('course_user', 'telegram_invite_generated_at')) {
                $table->timestamp('telegram_invite_generated_at')->nullable()->after('telegram_invite_link');
            }

            // Drop old telegram token fields if they exist
            if (Schema::hasColumn('course_user', 'telegram_invite_token')) {
                $table->dropColumn('telegram_invite_token');
            }

            if (Schema::hasColumn('course_user', 'telegram_invite_used')) {
                $table->dropColumn('telegram_invite_used');
            }

            if (Schema::hasColumn('course_user', 'telegram_invite_used_at')) {
                $table->dropColumn('telegram_invite_used_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'telegram_chat_id')) {
                $table->dropColumn('telegram_chat_id');
            }
        });

        Schema::table('course_user', function (Blueprint $table) {
            if (Schema::hasColumn('course_user', 'telegram_invite_link')) {
                $table->dropColumn('telegram_invite_link');
            }

            if (Schema::hasColumn('course_user', 'telegram_invite_generated_at')) {
                $table->dropColumn('telegram_invite_generated_at');
            }
        });
    }
};
