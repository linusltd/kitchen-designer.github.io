<?php

namespace App\Http\Controllers\Admin\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Administration\Role\StoreRequest;
use App\Http\Requests\Admin\Administration\Role\UpdateRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax()) {
            $roles = Role::orderBy('id', 'asc')->get();
            $data = [];
            if ($roles->count()) {
                foreach ($roles as $key => $item) {
                    $data[] = [
                        'Row_Index_ID' => ++$key,
                        'id' => $item->id,
                        'name' => $item->name,
                        'status' => $item->status,
                        'status_label' => '<span class="badge bg-label-' . ($item->status == 0 ? 'primary' : 'warning') . ' me-1">' . ($item->status == 0 ? 'Active' : 'Inactive') . '</span>'
                    ];
                }
            }
            return response()->json(['data' => $data]);
        }
        return view('admin.administration.role.index', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Role::create($request->all());
        return response()->json(['success' => true, 'response' => 'role created successfully!']);
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
        $role = Role::where('id', $id)->first();
        $role->update($request->all());
        return response()->json(['success' => true, 'response' => 'role updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return response()->json(['success' => true, 'response' => 'role deleted successfully!']);
    }
}
