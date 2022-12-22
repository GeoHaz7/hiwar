<?php

namespace App\Http\Controllers;

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
        $users = Vendor::select('*');

        return DataTables::eloquent($users)
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
    public function edit(Vendor $vendor)
    {
        //
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
        $user = User::where('user_id', $id)->get()[0];
        $vendor = Vendor::where('user_id', $id)->get()[0];

        return view('pages.vendors.editVendor', ['user' => $user, 'vendor' => $vendor]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
