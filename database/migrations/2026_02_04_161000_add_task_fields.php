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
        Schema::table('tasks', function (Blueprint $table) {
            if (! Schema::hasColumn('tasks', 'priority')) {
                $table->string('priority')->default('medium')->after('position');
            }

            if (! Schema::hasColumn('tasks', 'due_date')) {
                $table->timestamp('due_date')->nullable()->after('priority');
            }

            if (! Schema::hasColumn('tasks', 'image_url')) {
                $table->string('image_url')->nullable()->after('due_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            if (Schema::hasColumn('tasks', 'image_url')) {
                $table->dropColumn('image_url');
            }

            if (Schema::hasColumn('tasks', 'due_date')) {
                $table->dropColumn('due_date');
            }

            if (Schema::hasColumn('tasks', 'priority')) {
                $table->dropColumn('priority');
            }
        });
    }
};
