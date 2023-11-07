<?php

namespace App\Http\Controllers\Admin\Party;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Party;

class PartyController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $parties = Party::orderBy('id', 'asc')->get();
            $data = [];
            if ($parties->count()) {
                foreach ($parties as $key => $item) {
                    $data[] = [
                        'Row_Index_ID' => ++$key,
                        'id' => $item->id,
                        'name' => $item->name,
                        'email' => $item->email,
                        'phone' => $item->phone,
                        'address' => $item->address,
                        'status' => $item->status,
                        'status_label' => '<span class="badge bg-label-' . ($item->status == 0 ? 'primary' : 'warning') . ' me-1">' . ($item->status == 0 ? 'Active' : 'Inactive') . '</span>'
                    ];
                }
            }
            return response()->json(['data' => $data]);
        }
        return view('admin.party.index', get_defined_vars());
    }

    public function create()
    {
        return view('admin.party.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Party::create($data);
        // return $data;
        return response()->json(['success' => true, 'response' => 'Party created successfully!']);
    }

    public function edit($id)
    {
        $party = Party::where('id', $id)->first();
        return view('admin.party.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {

        $party = Party::where('id', $id)->first();
        $data = $request->all();
        $party->update($data);
        return response()->json(['success' => true, 'response' => 'Party updated successfully!']);
    }

    public function destroy($id)
    {
        party::destroy($id);
        return response()->json(['success' => true, 'response' => 'Party deleted successfully!']);
    }
}
