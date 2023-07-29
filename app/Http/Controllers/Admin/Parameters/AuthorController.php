<?php

namespace App\Http\Controllers\Admin\Parameters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Author\StoreRequest;
use App\Http\Requests\Admin\Author\UpdateRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $authors = Author::orderBy('id', 'desc')->get();
            $data = [];
            if($authors->count()){
                    foreach($authors as $key => $item){
                        $data[] = [
                            'Row_Index_ID' => ++$key,
                            'id' => $item->id,
                            'name' => $item->name,
                            'status' => $item->status,
                            'status_label' => '<span class="badge bg-label-'.($item->status == 0 ? 'primary' : 'warning').' me-1">'.($item->status == 0 ? 'Active' : 'Inactive').'</span>',
                        ];
                    }
                }
                return response()->json(['data' => $data]);
        }
        return view('admin.parameters.authors.index', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Author::create($request->all());
        return response()->json(['success' => true, 'response' => 'author created successfully!']);
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
        $author = Author::where('id', $id)->first();
        $author->update($request->all());
        return response()->json(['success' => true, 'response' => 'author updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Author::destroy($id);
        return response()->json(['success' => true, 'response' => 'author deleted successfully!']);
    }
}
