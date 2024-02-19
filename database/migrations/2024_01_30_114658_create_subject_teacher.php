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
        Schema::create('subject_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Assuming 'subject_teacher' table has a foreign key referencing 'subjects'
        Schema::table('subject_teacher', function (Blueprint $table) {
            $table->dropForeign(['subject_id']); // Adjust the foreign key name accordingly
        });
    
        Schema::dropIfExists('subjects');
    }
    
};
