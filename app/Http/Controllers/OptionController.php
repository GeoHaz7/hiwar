<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Option;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::select('*');

        return DataTables::eloquent($options)
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        return view('pages.options.listoptions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {

        if ($request->websiteName)
            Option::where('name', 'website_name')->update(['value' => $request->websiteName]);

        if ($request->websiteDescription)
            Option::where('name', 'website_description')->update(['value' => $request->websiteDescription]);

        if ($request->websiteLang)
            Option::where('name', 'website_lang')->update(['value' => $request->websiteLang]);

        if ($request->hasFile('file')) {
            $id = app('App\Http\Controllers\ImagesController')->store($request)['filename'];
            Option::where('name', 'website_photo')->update(['value' => $id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        //
    }
}
