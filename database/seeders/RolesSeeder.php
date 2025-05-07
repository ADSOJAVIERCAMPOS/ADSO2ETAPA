<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name_rol' => 'APRENDIZ', 'description_rol' => 'Aprendiz sena'],
            ['name_rol' => 'INSTRUCTOR', 'description_rol' => 'Instructor sena'],
            ['name_rol' => 'COORDINADOR', 'description_rol' => 'Coordinador sena'],
            ['name_rol' => 'ADMIN', 'description_rol' => 'Administrador sena'],
            ['name_rol' => 'SUPER_ADMIN', 'description_rol' => 'Super Administrador sena'],
        ]);
    }
}
