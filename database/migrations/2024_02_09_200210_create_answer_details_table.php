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
        Schema::create('answer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_answer_id')->constrained('exam_answers');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('exam_question_id')->constrained('exam_questions');
            $table->foreignId('exam_question_answer_id')->constrained('exam_question_answers');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_details');
    }
};