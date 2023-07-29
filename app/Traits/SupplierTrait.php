<?php

namespace App\Traits;

use App\Models\Supplier;
trait SupplierTrait{
    public function storeSuppliers(){
        $suppliers = $this->getSuppliers();
        foreach($suppliers as $supplier){
            Supplier::create($supplier);
        }
    }
    public function getSuppliers(){
        return [
            [
              "name" => "Book Shop Shahid Sabu",
              "contact_person" => "Muhammad Shahid Sabhu",
              "address" => "Manzoor manzil 42 Urdu Bazar 00p Muslim model high School, Lahore",
              "city" => "Lahore",
              "mobile" => "+923009424254",
              "phone" => "+923339424254",
              "opening_balance" => 0,
              "opening_date" => "2022-11-25",
              "status" => 0,
            ],
            [
              "name" => "Ilm-O-Irfan Publishers",
              "contact_person" => "Gulfraz Ahmad",
              "address" => "Al-Hamd Market 40-Urdu Bazar Lahore",
              "city" => "Lahore",
              "mobile" => "+923009450911",
              "phone" => "+9242372336",
              "opening_balance" => 0,
              "opening_date" => "2022-11-25",
              "status" => 0,
            ],
            [
              "name" => "Umer Sons",
              "contact_person" => "Sh. M. Umer",
              "address" => "Qadaffi Market, Urdu Bazar Lahore",
              "city" => "Lahore",
              "mobile" => "+923004237411",
              "phone" => "+923004237411",
              "opening_balance" => 0,
              "opening_date" => "2022-11-04",
              "status" => 0,
            ],
            [
              "name" => "Rehbar Publishers",
              "contact_person" => "Amir ghouri",
              "address" => "4-Main Market, Urdu Bazar, Lahore",
              "city" => "Lahore",
              "mobile" => "+923234441357",
              "phone" => "+923234441357",
              "opening_balance" => 0,
              "opening_date" => "2022-11-04",
              "status" => 0,
            ]
        ];
    }
}




?>
