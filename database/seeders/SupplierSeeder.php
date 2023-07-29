<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Traits\SupplierTrait;
class SupplierSeeder extends Seeder
{
    use SupplierTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return $this->storeSuppliers();
    }
}
