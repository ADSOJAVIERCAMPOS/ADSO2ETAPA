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
        Schema:: create('teachers', function(Blueprint $table){
            $table->id('id_teacher');
            $table->string('specialization');
            $table->string('years_experience');

            $table->unsignedBigInteger('person_id'); // Clave foránea

            $table->foreign('person_id')
                  ->references('id_person')
                  ->on('peoples');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
