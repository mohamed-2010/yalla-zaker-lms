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
        Schema::create('coupone_code_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recorded_lesson_id')->constrained('recorded_lessons');
            $table->foreignId('coupone_code_id')->constrained('coupone_codes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupone_code_videos');
    }
};
