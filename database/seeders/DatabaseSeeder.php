<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            // CategorySeeder::class,
            // LanguageSeeder::class,
            // AuthorSeeder::class,
            // CitySeeder::class,
            // SupplierSeeder::class,
            GeneralSeeder::class,
            SliderSeeder::class,
            // BookSeeder::class
        ]);
    }
}
