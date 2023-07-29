<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderBy('id', 'desc')->get();
        return view('admin.cms.slider.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::where('status', 1)->get();
        $categories = Category::where('status', 0)->get();
        return view('admin.cms.slider.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('BannerImages', 'public');
        }
        if($request->hasFile('mobile_image')){
            $data['mobile_image'] = $request->file('mobile_image')->store('BannerImages', 'public');
        }
        Slider::create($data);

        return response()->json(['success' => true, 'response' => 'Slider Creaated Successfully!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $books = Book::where('status', 1)->get();
        $categories = Category::where('status', 0)->get();
        $slider = Slider::where('id', $id)->first();
        return view('admin.cms.slider.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::where('id', $id)->first();
        $data = $request->all();
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('BannerImages', 'public');
        }
        if($request->hasFile('mobile_image')){
            $data['mobile_image'] = $request->file('mobile_image')->store('BannerImages', 'public');
        }
        $slider->update($data);

        return response()->json(['success' => true, 'response' => 'Slider Updated Successfully!']);
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
