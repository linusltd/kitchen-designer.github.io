<?php

namespace App\Traits;

use App\Models\Language;

trait LanguageTrait{
    public function storeLanguages(){
        $languages = $this->getLanguages();
        foreach($languages as $lang){
            Language::create($lang);
        }
    }
    public function getLanguages(){
        return [
            ['name' => 'Urdu'],
            ['name' => 'English'],
            ['name' => 'Arabic'],
        ];
    }
}




?>
