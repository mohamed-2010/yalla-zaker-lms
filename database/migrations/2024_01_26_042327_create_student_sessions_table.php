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
        Schema::create('student_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('ip');
            $table->string('platform_name');
            $table->string('platform_family');
            $table->string('platform_version');
            $table->string('browser_name');
            $table->string('browser_family');
            $table->string('browser_version');
            $table->string('device_family');
            $table->string('device_model');
            $table->string('mobile_grade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_sessions');
    }
};
