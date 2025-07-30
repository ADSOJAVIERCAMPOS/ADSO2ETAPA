<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
           
            [
                'name_country' => 'Colombia', 
                'city' => 'Bogotá',
                'departament' => 'Bogotá D.C.',
                'location_geography' => 'América del Sur'
            ],
    
            [
                'name_country' => 'Venezuela',
                'city' => 'Caracas',
                'departament' => '',
                'location_geography' => 'América del Sur'
            ], 
           
        ]);
    }
}
