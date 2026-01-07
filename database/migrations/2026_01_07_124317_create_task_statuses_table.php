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
        Schema::create('task_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });
        DB::table('task_statuses')->insert([
            [
                'id'        => 1,
                'name'      => 'Новая',
            ],
            [
                'id'        => 2,
                'name'      => 'В работе',
            ],
            [
                'id'        => 3,
                'name'      => 'Выполнена',
            ],
            [
                'id'        => 4,
                'name'      => 'Отменена',
            ],
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
