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
        Schema::table('users', function (Blueprint $table) {
            //add phone, parent_phone, area_id, city_id, attend_type => center, online
            $table->string('phone');
            $table->string('parent_phone');
            $table->foreignId('area_id')->constrained('areas');
            $table->foreignId('government_id')->constrained('governments');
            $table->enum('attend_type', ['center', 'online'])->default('center');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('parent_phone');
            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
            $table->dropColumn('attend_type');
        });
    }
};
