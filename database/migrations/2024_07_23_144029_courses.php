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
        Schema::create('courses', function (Blueprint $table) {
            $table->id('id_course');
            $table->string('name_course');
            $table->text('description_course');
            $table->string('acronym');
            $table->string('state_course')->default('activo');
            $table->integer('quota_course')->default(30);

            $table->unsignedBigInteger('category_id');
    

            $table->foreign('category_id')
            ->references('id_category')
            ->on('categories')
            ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
