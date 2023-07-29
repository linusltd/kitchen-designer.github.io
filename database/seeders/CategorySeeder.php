<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Traits\CategoryTrait;
class CategorySeeder extends Seeder
{
    use CategoryTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return $this->storeCategories();
    }
}
