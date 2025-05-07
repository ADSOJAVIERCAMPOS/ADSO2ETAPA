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
        Schema::create('specializations', function(Blueprint $table){
            $table->id('id_specializations');
            $table->string('name_specialization');


            $table->unsignedBigInteger('teacher_id');

            $table->foreign('teacher_id')
                  ->references('id_teacher')
                  ->on('teachers');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specializations');
    }
};
