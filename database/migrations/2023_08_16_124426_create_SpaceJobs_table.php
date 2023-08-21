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
        Schema::create('SpaceJobs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название
            $table->text('desctiption')->nullable(); //Описание
            $table->enum('status', ['Выполнена', 'Не выполнена', 'Черновик']); //Статус
            $table->dateTime('date_create'); //Дата создания
            $table->dateTime('date_finist'); //Дата выполнения
            $table->string('file')->nullable(); //Файлы


            $table->unsignedBigInteger('space_id')->nullable();
            $table->index('space_id', 'job_space_idx');
            $table->foreign('space_id', 'job_space_fk')->on('spaces')->references('id')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SpaceJobs');
    }
};
