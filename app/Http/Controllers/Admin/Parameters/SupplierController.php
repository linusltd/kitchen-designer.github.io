<?php

namespace App\Http\Controllers\Admin\Parameters;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $suppliers = Supplier::orderBy('id', 'desc')->get();
            $data = [];
            if($suppliers->count()){
                    foreach($suppliers as $key => $item){
                        $data[] = [
                            'Row_Index_ID' => ++$key,
                            'id' => $item->id,
                            'name' => $item->name,
                            'contact_person' => $item->contact_person,
                            'mobile' => $item->mobile,
                            'city' => $item->city,
                            'opening_date' => $item->opening_date,
                            'status' => '<span class="badge bg-label-'.($item->status == 0 ? 'primary' : 'warning').' me-1">'.($item->status == 0 ? 'Active' : 'Inactive').'</span>',
                        ];
                    }

                }
                return response()->json(['data' => $data]);
        }
        return view('admin.parameters.suppliers.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('admin.parameters.suppliers.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Supplier::create($request->all());
        return response()->json(['success' => true, 'response' => 'supplier created successfully!']);
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
        $cities = City::all();
        $supplier = Supplier::where('id', $id)->first();
        return view('admin.parameters.suppliers.edit', get_defined_vars());
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
        $supplier = Supplier::where('id', $id)->first();
        $supplier->update($request->all());
        return response()->json(['success' => true, 'response' => 'supplier updated successfully!']);
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
