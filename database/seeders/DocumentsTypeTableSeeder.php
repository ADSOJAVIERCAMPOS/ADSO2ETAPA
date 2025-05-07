<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentsTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('documents_type')->insert([
                [
                    'name_type' => 'Cédula de Ciudadanía',
                    'acronym' => 'CC',
                    'description' => 'Documento de identidad para ciudadanos colombianos mayores de edad.'
                ],
                [
                    'name_type' => 'Tarjeta de Identidad',
                    'acronym' => 'TI',
                    'description' => 'Documento de identidad para menores de edad en Colombia.'
                ], 
                [
                    'name_type' => 'Pasaporte',
                    'acronym' => 'PAS',
                    'description' => 'Documento de viaje para ciudadanos colombianos y extranjeros para ingresar y salir del país.'
                ],
            
        ]);
    }
}
