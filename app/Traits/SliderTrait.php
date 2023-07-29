<?php

namespace App\Traits;

use App\Models\Slider;

trait SliderTrait{

    public function storeSliders(){
        $sliders = $this->getSliders();
        foreach($sliders as $gen){
            Slider::create($gen);
        }
    }

    public function getSliders(){
        return [
            [
                "color" => "#BF8D70",
                "image" => "BannerImages/q6jt8LSJhM1SnCEdigomvNtfdgQIbgSGh5aR94As.jpg",
                "url" => "/shop",
                "type" => 0,
                "redirect" => 2,
                "status" => 0,
            ],
            [
                "color" => "#002954",
                "image" => "BannerImages/lnr1Ly7tJ3AAphqsJVPcTtrkiUTgqpY3SwsYw2fU.jpg",
                "url" => "/shop",
                "type" => 0,
                "redirect" => 2,
                "status" => 0,
            ],
        ];
    }
}




?>
