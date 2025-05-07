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
        Schema::create('users_role', function(Blueprint $table){
            $table->id('id_user_role');

            $table->unsignedBigInteger('id_rol');
            $table->unsignedBigInteger('id_user');

            $table->foreign('id_rol')
            ->references('id_rol')
            ->on('roles');

            $table->foreign('id_user')
            ->references('id_user')
            ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};