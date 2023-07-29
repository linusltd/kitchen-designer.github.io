<?php

namespace App\Http\Controllers\Admin\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Administration\Staff\StoreRequest;
use App\Http\Requests\Admin\Administration\Staff\UpdateRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $roles = Admin::orderBy('id', 'asc')->get();
            $data = [];
            if ($roles->count()) {
                foreach ($roles as $key => $item) {
                    $data[] = [
                        'Row_Index_ID' => ++$key,
                        'id' => $item->id,
                        'name' => $item->name,
                        'email' => $item->email,
                        'phone' => $item->phone,
                        'address' => $item->address,
                        'role' => $item->role_id,
                        'status' => $item->status,
                        'status_label' => '<span class="badge bg-label-' . ($item->status == 0 ? 'primary' : 'warning') . ' me-1">' . ($item->status == 0 ? 'Active' : 'Inactive') . '</span>'
                    ];
                }
            }
            return response()->json(['data' => $data]);
        }
        return view('admin.administration.staff.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('status', 0)->get();
        return view('admin.administration.staff.create', get_defined_vars());
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
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('StaffImages', 'public') : '';
        Admin::create($data);
        return response()->json(['success' => true, 'response' => 'staff created successfully!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Admin::where('id', $id)->first();
        $roles = Role::where('status', 0)->get();
        return view('admin.administration.staff.edit', get_defined_vars());
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
        $staff = Admin::where('id', $id)->first();
        $data = $request->all();
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('StaffImages', 'public');
        }
        $staff->update($data);
        return response()->json(['success' => true, 'response' => 'staff updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::destroy($id);
        return response()->json(['success' => true, 'response' => 'staff deleted successfully!']);
    }
}
