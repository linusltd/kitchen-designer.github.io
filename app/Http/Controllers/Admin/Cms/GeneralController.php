<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use App\Models\General;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $general = General::limit(1)->first();
        return view('admin.cms.general.index', get_defined_vars());
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
        $data = $request->except('id', '_token', '_method', 'image', 'footer_image');
        if($request->hasFile('image')){
            $data['logo'] = $request->file('image')->store('GeneralImages', 'public');
        }
        if($request->hasFile('footer_image')){
            $data['footer_logo'] = $request->file('footer_image')->store('GeneralImages', 'public');
        }
        General::where('id', $id)->update($data);
        return response()->json(['success' => true, 'response' => 'General Info Updated Successfully!']);
    }

}
