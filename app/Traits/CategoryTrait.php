<?php

namespace App\Traits;

use App\Models\Category;
trait CategoryTrait{
    public function storeCategories(){
        $categories = $this->getCategories();
        foreach($categories as $cat){
            Category::create($cat);
        }
    }
    public function getCategories(){
        return [
            [
              "name" => "Islam",
              "slug" => "islam",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "History",
              "slug" => "history",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Biography",
              "slug" => "biography",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Philosophy",
              "slug" => "philosophy",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Products Under 750PKR",
              "slug" => "books-under-750pkr",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Novel",
              "slug" => "novel",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Language Speaking",
              "slug" => "language-speaking",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Seerat un Nabi (SAW)",
              "slug" => "seerat-un-babi-(saw)",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Literature",
              "slug" => "literature",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Psychology",
              "slug" => "psychology",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Self Help",
              "slug" => "self-help",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Health",
              "slug" => "health",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Technical",
              "slug" => "technical",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Spirtuality",
              "slug" => "spirtuality",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Poetry",
              "slug" => "poetry",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Politics",
              "slug" => "politics",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Afsanay",
              "slug" => "afsanay",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Kids Corner",
              "slug" => "kids-corner",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Safarnama",
              "slug" => "safarnama",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Zinda Kitabain",
              "slug" => "zinda-kitabain",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "English",
              "slug" => "english",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Islam",
              "slug" => "english-islam",
              "show_top" => 0,
              "parent_id" => 21,
              "level" => 0
            ],
            [
              "name" => "History",
              "slug" => "english-islam",
              "show_top" => 0,
              "parent_id" => 21,
              "level" => 0
            ],
            [
              "name" => "Literature",
              "slug" => "english-literature",
              "show_top" => 0,
              "parent_id" => 21,
              "level" => 0
            ],
            [
              "name" => "Drama",
              "slug" => "english-drama",
              "show_top" => 0,
              "parent_id" => 21,
              "level" => 0
            ],
            [
              "name" => "Health",
              "slug" => "english-health",
              "show_top" => 0,
              "parent_id" => 21,
              "level" => 0
            ],
            [
              "name" => "Novel",
              "slug" => "english-novel",
              "show_top" => 0,
              "parent_id" => 21,
              "level" => 0
            ],
            [
              "name" => "Self Help",
              "slug" => "english-self-help",
              "show_top" => 0,
              "parent_id" => 21,
              "level" => 0
            ],
            [
              "name" => "Motivation",
              "slug" => "english-motivation",
              "show_top" => 0,
              "parent_id" => 21,
              "level" => 0
            ],
            [
              "name" => "Life Style",
              "slug" => "english-life-style",
              "show_top" => 0,
              "parent_id" => 21,
              "level" => 0
            ],
            [
              "name" => "Motivational",
              "slug" => "motivational",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Business",
              "slug" => "business",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Investment",
              "slug" => "investment",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ],
            [
              "name" => "Religion",
              "slug" => "religion",
              "show_top" => 0,
              "parent_id" => 0,
              "level" => 0
            ]
            ];
    }
}




?>
