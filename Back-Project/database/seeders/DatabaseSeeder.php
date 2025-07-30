<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {        
        $this->call(CategoriesSeeder::class);
        $this->call(CoursesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(DocumentsTypeTableSeeder::class);
        $this->call(UsersSeeder::class);
        
    }
}
