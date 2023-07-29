<?php

namespace App\Http\Controllers\Admin\Books;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::with('book')->orderBy('id', 'desc')->get();
        return view('admin.reviews.index', get_defined_vars());
    }


    public function updateReviewStatus(Request $request){
        Review::where('id', $request->id)->update(['is_verified' => $request->is_verified]);
        return redirect()->back();
    }

}
