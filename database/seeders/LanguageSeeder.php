<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Traits\LanguageTrait;
class LanguageSeeder extends Seeder
{
    use LanguageTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return $this->storeLanguages();
    }
}
