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
        Schema::create('peoples', function (Blueprint $table) {
            $table->id('id_person');
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('document_number')->nullable();
            $table->string('permission')->nullable();       
            $table->date('date_birth');
            $table->string('address');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('document_type_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id_country')
                ->on('countries');
            $table->foreign('document_type_id')
                ->references('id_document_type')
                ->on('documents_type');

            $table->foreign('course_id')
            ->references('id_course')
            ->on('courses');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peoples');
    }
};
