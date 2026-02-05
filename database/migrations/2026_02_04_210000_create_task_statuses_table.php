<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('label');
            $table->integer('position')->default(0);
            $table->timestamps();
        });

        // Seed default statuses if table empty
        DB::table('task_statuses')->insertOrIgnore([
            ['key' => 'todo', 'label' => 'To Do', 'position' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'in_progress', 'label' => 'In Progress', 'position' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'completed', 'label' => 'Completed', 'position' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_statuses');
    }
};
