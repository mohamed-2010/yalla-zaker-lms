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
        Schema::create('recorded_lessons', function (Blueprint $table) {
            $table->id();
            $table->string('video_library_id')->nullable();
            $table->string('video_id')->nullable();
            $table->unsignedBigInteger('exam_id')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->string('name');
            $table->boolean('is_paid');
            $table->double('price');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->enum('type', ['revision', 'explain', 'wrokshops'])->default('explain');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('set null');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recorded_lessons');
    }
};
