<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\AreaManager;
use Illuminate\Http\Request;

class AreaManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $area_managers = areaManager::all();
        $areas = Area::all();
        return view('admin_res.area_manager',compact('area_managers','areas'));
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

        $this->validate($request,areaManager::rules($request->method()));
        areaManager::create($request->all());
        $request->session()->flash('alert-success', 'Data added successfully!');

        return redirect(route('area-manager.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\area_manager  $area_manager
     * @return \Illuminate\Http\Response
     */
    public function show(areaManager $area_manager)
    {
        return $this->index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\area_manager  $area_manager
     * @return \Illuminate\Http\Response
     */
    public function edit(areaManager $area_manager)
    {     
        $areas = Area::all();
        $area_managers= areaManager::all();
        return view('admin_res.area_manager', compact(['area_manager','area_managers','areas']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\area_manager  $area_manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, areaManager $area_manager)
    {
        $this->validate($request,areaManager::rules($request->method()));


        $area_manager->update($request->all());
        $request->session()->flash('alert-success', 'Data Updated successfully!');
        return redirect(route('area-manager.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\area_manager  $area_manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(areaManager $area_manager)
    {
        // dont delete if area_manager has area_manager
        $area_manager->delete();
        return redirect()->route('area-manager.index')->with('alert-success', 'Data Deleted!');
    }
}
