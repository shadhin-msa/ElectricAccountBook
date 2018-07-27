<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = area::all();
        return view('admin_res.area',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return $this->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


            $this->validate($request,area::rules($request->method()));
        area::create($request->all());
        $request->session()->flash('alert-success', 'Data added successfully!');

        return redirect(route('area.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(area $area)
    {
        return $this->index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(area $area)
    {

        $categories= area::all();
        return view('admin_res.area', compact(['area','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, area $area)
    {
        $this->validate($request,area::rules($request->method()));


        $area->update($request->all());

        $request->session()->flash('alert-success', 'Data Updated successfully!');
        return redirect(route('area.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(area $area)
    {
        // dont delete if area has product
        $area->delete();
        return redirect()->route('area.index')->with('alert-success', 'Data Deleted!');
    }
}
