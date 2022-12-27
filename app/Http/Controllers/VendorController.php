<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vendors = Vendor::select('vendor_id', 'phone', 'full_name', 'address', 'status', 'filename')
            ->leftjoin('users', 'users.user_id', '=', 'vendors.user_id')
            ->leftjoin('images', 'images.images_id', '=', 'vendors.profile_image');


        return DataTables::eloquent($vendors)
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.vendors.createVendor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $id = null;

        if ($request->hasFile('file')) {
            $id = app('App\Http\Controllers\ImagesController')->store($request)['images_id'];
            // return $id;
        }


        $user = User::create([
            'username' => $request->vendorUsername,
            'email' => $request->vendorEmail,
            'password' => bcrypt($request->vendorPassword),
            'type' => 2
        ]);


        Vendor::create([
            'full_name' => $request->vendorFullName,
            'bio' => $request->vendorBio,
            'status' => 1,
            'address' => $request->vendorAddress,
            'phone' => $request->vendorPhone,
            'user_id' => $user->user_id,
            'profile_image' => $id,
        ]);

        return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return view('pages.vendors.listVendors');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor, $id)
    {
        $vendor = Vendor::where('vendor_id', $id)->first();
        $user = $vendor->user()->first();


        return view('pages.vendors.editVendor', ['user' => $user, 'vendor' => $vendor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor, $id)
    {
        $vendor = Vendor::where('vendor_id', $id)->first();
        $user = User::where('user_id', $vendor->user_id)->first();
        $image = Images::where('images_id', $vendor->profile_image)->first();



        $idd = null;
        if ($image) {
            Images::where('filename', $image->filename)->delete();
            $path = public_path('uploads/gallery/') . $image->filename;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        if ($request->hasFile('file')) {
            $idd = app('App\Http\Controllers\ImagesController')->store($request)['images_id'];
            // return $id;
        }


        $user->update([
            'username' => $request->vendorUsername,
            'email' => $request->vendorEmail,
            'password' => $request->vendorPassword ? bcrypt($request->vendorPassword) : $user->password,
            'type' => 2
        ]);


        $vendor->update([
            'full_name' => $request->vendorFullName,
            'bio' => $request->vendorBio,
            'status' => 1,
            'address' => $request->vendorAddress,
            'phone' => $request->vendorPhone,
            'user_id' => $user->user_id,
            'profile_image' => $idd,
        ]);

        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor, $id)
    {
        Vendor::where('vendor_id', $id)->first()->delete();


        return response()->json('success');
    }
}
