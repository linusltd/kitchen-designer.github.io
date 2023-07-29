<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class BookExport implements FromCollection, WithHeadings
{
    public $data;

    public function __construct($data){
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $books = $this->data;
        $result = [];
        foreach($books as $book){

           $result[] = array(
            'id' => $book->id,
            'title' => $book->name,
            'description' => strip_tags($book->description),
            'availability' => 'in Stock',
            'condition' => 'new',
            'price' => $book->price,
            'link' => route('website.home.book-detail-view', $book->slug),
            'image_link' => asset('storage/'. $book->images[0]->filename),
            'brand' => 'Kitchen Designer',
            'sale_price' => $book->special_price,
            'size' => $book->size
           );
        }

          return collect($result);

    }

    public function headings(): array
    {
       return [
        'id',
        'title',
        'description',
        'availability',
        'condition',
        'price',
        'link',
        'image_link',
        'brand',
        'sale_price',
        'size'
       ];
    }
}
