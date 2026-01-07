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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('status_id')
                ->constrained('task_statuses')
                ->onDelete('restrict');
            $table->timestamps();
        });

        DB::table('tasks')->insert([
            [
                'title'     => 'Первая задача',
                'status_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time() - 3600),
            ],
            [
                'title'     => 'Второе задание',
                'status_id' => 2,
                'created_at' => date('Y-m-d H:i:s', time() - 3600*33),
            ],
            [
                'title'     => 'Пройти тест',
                'status_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time() - 3600*77),
            ],
            [
                'title'     => 'Изобрести велосипед',
                'status_id' => 2,
                'created_at' => date('Y-m-d H:i:s', time() - 3600*22),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
