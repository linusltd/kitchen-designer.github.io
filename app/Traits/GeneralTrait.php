<?php

namespace App\Traits;

use App\Models\General;

trait GeneralTrait{
    public function storeGenerals(){
        $generals = $this->getGenerals();
        foreach($generals as $gen){
            General::create($gen);
        }
    }
    public function getGenerals(){
        return [
            [
                "logo" => "GeneralImages/Cd3tCNKNOP6JT4yDPAYXZdDGZ61fuq7ki5rBLH64.svg",
                "footer_logo" => "GeneralImages/VBbAUumlhlQ5YgEjb6I9xY9n0EigX1N5IBYbJ4Wa.svg",
                "name" => "Kitchen Designer",
                "email" => "info@kitabjahan.com.pk",
                "address" => "GT. Road Gujranwala",
                "phone" => "+923110767466",
                "facebook" => "https://www.facebook.com/kitabjahaan",
            ],
        ];
    }
}




?>
