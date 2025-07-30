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
        Schema::create('requests', function(Blueprint $table){
            $table->id('id_request');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('quota')->default(30);
            $table->boolean('state_request')->nullable()->default(null);

            $table->unsignedBigInteger('teacher_id')-> nullable();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('category_id');

            $table->foreign('teacher_id')
                  ->references('id_teacher')
                  ->on('teachers');
                  
                  $table->foreign('course_id')
                  ->references('id_course')
                  ->on('courses');

                  $table->foreign('category_id')
                  ->references('id_category')
                  ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
