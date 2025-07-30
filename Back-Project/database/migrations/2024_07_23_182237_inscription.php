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
        Schema::create('inscriptions', function(Blueprint $table){
            $table->id('id_register');
            $table->string('state_register');
            $table->date('date_register');
            

            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('request_id'); 
            $table->unsignedBigInteger('person_id');
            

            $table->foreign('course_id')
              ->references('id_course')
              ->on('courses');

            $table->foreign('request_id')
              ->references('id_request')
              ->on('requests');


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
        Schema::dropIfExists('inscriptions');
    }
};
