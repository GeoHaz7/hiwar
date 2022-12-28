<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{
    public function vendorDataAjax(Request $request)
    {
        $data = Vendor::take('5')->get();

        if ($request->has('q')) {
            $search = $request->q;
            $data = Vendor::select("vendor_id", 'full_name')
                ->where('full_name', 'LIKE', "%$search%")->take(5)
                ->get();
        }
        return response()->json($data);
    }

    public function showVendorDataAjax(Request $request, $id)
    {
        $data = [];

        if ($id) {
            $vendor = Vendor::findorfail($id);

            $vendorArray = $vendor->pluck('vendor_id')->toarray();

            $data = Vendor::select("vendor_id", 'full_name')->whereIn("vendor_id",  $vendorArray)->get();
        }
        return response()->json($data);
    }
}
