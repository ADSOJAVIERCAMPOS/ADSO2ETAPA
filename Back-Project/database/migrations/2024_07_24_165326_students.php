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
        Schema:: create('students', function(Blueprint $table){
            $table->id('id_student');
            $table->boolean('state_student');
           

            $table->unsignedBigInteger('person_id');


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
        Schema::dropIfExists('students');
    }
};
