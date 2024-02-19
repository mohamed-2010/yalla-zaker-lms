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
        Schema::table('coupone_codes', function (Blueprint $table) {
            // Check if the column does not exist before adding it
            if (!Schema::hasColumn('coupone_codes', 'teacher_id')) {
                $table->unsignedBigInteger('teacher_id')->nullable();
                $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
            }
        });
    }
    
    public function down(): void
    {
        Schema::table('coupone_codes', function (Blueprint $table) {
            if (Schema::hasColumn('coupone_codes', 'teacher_id')) {
                $table->dropForeign(['teacher_id']);
                $table->dropColumn('teacher_id');
            }
        });
    }
    
};
