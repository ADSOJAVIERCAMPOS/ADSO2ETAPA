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
        Schema::create('coordinations', function(Blueprint $table){
            $table->id('id_coordination');
            $table->string('area'); 


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
        Schema::dropIfExists('coordinations');
    }
};
