<?php

namespace App\Http\Controllers\Admin\Books;

use App\Exports\BookExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Books\StoreRequest;
use App\Http\Requests\Admin\Books\UpdateRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Image;
use App\Models\Language;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $onlineProducts = Book::with('images')->where('status', 1)->get();
        $draftProductsCount = Book::with('images')->where('status', 2)->count();
        $onlineProductsCount = Book::with('images')->where('status', 1)->count();

        // return Book::with(['images' => function ($query) {
        //     $query->select('filename', 'type', 'book_id');
        // }])
        // ->select('name', 'slug', 'pages', 'binding', 'size', 'volume', 'description', 'price', 'special_price', 'quantity', 'low_stock_min', 'sku', 'status', 'in_stock', 'meta_keywords', 'meta_description', 'id')
        // ->get();

        return view('admin.books.index', get_defined_vars());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductsExcel()
    {
        $data = Book::all();
        return Excel::download(new BookExport($data), 'activities.xlsx');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function draft()
    {
        $onlineProductsCount = Book::with('images')->where('status', 1)->count();
        $draftProductsCount = Book::with('images')->where('status', 2)->count();
        $draftProducts = Book::with('images')->where('status', 2)->get();
        return view('admin.books.draft', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::with('child')->where('parent_id', 0)->get();
        $languages = Language::all();
        return view('admin.books.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        /*Storing Image*/
        $book = Book::create($request->all());

        /*Stroing Main Image*/
        if ($request->hasFile('image')) {

            $book->images()->create([
                'filename' => compressImage($request->file('image')),
                'type' => 0
            ]);
        }

        /*Storing Different Side Images*/
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $book->images()->create([
                    'filename' => compressImage($image),
                    'type' => 1
                ]);
            }
        }

        /*Creating MultiSelect Arrays*/
        $book->categories()->attach(explode(',', $request->category_id));

        /*Creating Book SKU*/
        generateSKU($book->id);

        return response()->json(['success' => true, 'response' => 'Product Stored Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authors = Author::all();
        $categories = Category::with('child')->where('parent_id', 0)->get();
        $languages = Language::all();
        $book =  Book::with('categories', 'authors', 'languages', 'images')->where('id', $id)->first();

        return view('admin.books.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        /*Updating Image*/
        $book = Book::where('id', $id)->first();
        $book->update($request->all());


        /*Storing Main Image*/
        if ($request->hasFile('image')) {
            $book->images()->create([
                'filename' => compressImage($request->file('image')),
                'type' => 0
            ]);
        }

        /*Storing Different Side Images*/
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $book->images()->create([
                    'filename' => compressImage($image),
                    'type' => 1
                ]);
            }
        }

        /*Deleting Products*/
        if (isset($request->ImagesToRemove) && count($request->ImagesToRemove) > 0) {
            foreach ($request->ImagesToRemove as $item) {
                Image::where('id', $item)->delete();
            }
        }

        /*Creating MultiSelect Arrays*/
        $book->categories()->sync(explode(',', $request->category_id));

        return response()->json(['success' => true, 'response' => 'Product Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
