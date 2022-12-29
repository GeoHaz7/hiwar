<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        $vendor = Vendor::select('full_name', 'vendor_id')->where('vendor_id', $id)->get();

        return response()->json($vendor);
    }
}
