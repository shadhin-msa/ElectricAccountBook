<?php

namespace App\Http\Controllers;

use App\Models\Delar;
use Illuminate\Http\Request;

class DelarController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = delar::all();
        return view('admin_res.delar',compact('categories'));
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


            $this->validate($request,delar::rules($request->method()));
        delar::create($request->all());
        $request->session()->flash('alert-success', 'Data added successfully!');

        return redirect(route('delar.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\delar  $delar
     * @return \Illuminate\Http\Response
     */
    public function show(delar $delar)
    {
        return $this->index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\delar  $delar
     * @return \Illuminate\Http\Response
     */
    public function edit(delar $delar)
    {

        $categories= delar::all();
        return view('admin_res.delar', compact(['delar','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\delar  $delar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, delar $delar)
    {
        $this->validate($request,delar::rules($request->method()));


        $delar->update($request->all());

        $request->session()->flash('alert-success', 'Data Updated successfully!');
        return redirect(route('delar.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\delar  $delar
     * @return \Illuminate\Http\Response
     */
    public function destroy(delar $delar)
    {
        // dont delete if delar has product
        $delar->delete();
        return redirect()->route('delar.index')->with('alert-success', 'Data Deleted!');
    }
}
