<?php

namespace App\Http\Controllers\Admin\Parameters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $categories = Category::with('child')->orderBy('show_top', 'desc')->get();

            $data = [];
            if ($categories->count()) {
                foreach ($categories as $key => $item) {
                    $data[] = [
                        'Row_Index_ID' => ++$key,
                        'id' => $item->id,
                        'name' => $item->name,
                        'slug' => $item->slug,
                        'image' => asset('storage/'.$item->image),
                        'color' => $item->color,
                        'parent_id' => $item->parent_id,
                        'show_top' => $item->show_top,
                        'status' => $item->status,
                        'level' => $item->level,
                        'status_label' => '<span class="badge bg-label-' . ($item->status == 0 ? 'primary' : 'warning') . ' me-1">' . ($item->status == 0 ? 'Active' : 'Inactive') . '</span>',
                        'show_top_label' => '<span class="badge bg-label-' . ($item->show_top == 0 ? 'warning' : 'primary') . ' me-1">' . ($item->show_top == 0 ? 'No' : 'Yes') . '</span>',
                    ];
                }
            }
            return response()->json(['data' => $data]);
        }
        $categories = Category::with('child')->get();
        return view('admin.parameters.categories.index', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('CategoryImages', 'public');
        }
        Category::create($data);
        return response()->json(['success' => true, 'response' => 'category created successfully!']);
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
        $category = Category::where('id', $id)->first();
        $data = $request->all();
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('CategoryImages', 'public');
        }
        $category->update($data);
        return response()->json(['success' => true, 'response' => 'category updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json(['success' => true, 'response' => 'category deleted successfully!']);
    }
}
