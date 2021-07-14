<?php

namespace App\Http\Controllers;

use App\Models\Ray;
use Illuminate\Http\Request;

class RayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rays = Ray::orderby('created_at', 'DESC')->get();

        return view('rays.index', compact('rays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rays.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:50|unique:rays'
        ]);

        $ray = Ray::Create([
            'name' => $request->name
        ]);

        flash("Le rayon {$ray->name} a bien été créé")->success();

        return redirect()->route('rays.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ray  $ray
     * @return \Illuminate\Http\Response
     */
    public function show(Ray $ray)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ray  $ray
     * @return \Illuminate\Http\Response
     */
    public function edit(Ray $ray)
    {
        return view('rays.form', compact('ray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ray  $ray
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ray $ray)
    {
        $request->validate([
            'name' => 'required|min:1|max:50|unique:rays,name,' . $ray->id
        ]);

        $ray->update([
            'name' => $request->name
        ]);

        flash("Le rayon {$ray->name} a bien été modifiée")->success();

        return redirect()->route('rays.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ray  $ray
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ray $ray)
    {
        $name = $ray->name;

        $ray->delete();

        flash("Le rayon $name a bien été supprimé")->error();

        return back();
    }
}
