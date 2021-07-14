<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::orderby('name', 'ASC')->get();

        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::orderby('name', 'ASC')->get();

        return view('suppliers.form', compact('cities'));
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
            'name' => 'required|min:3|max:50|string|unique:suppliers',
            'address' => 'required|min:3|max:50|string',
            'phone' => 'required|min:8|max:50|string',
            'email' => 'required|min:3|max:50|email',
            'city' => 'required|integer',
        ]);

        $supplier = Supplier::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'city_id' => $request->city
        ]);

        flash("Le fournisseur {$supplier->name} a bien été ajouté.")->success();

        return redirect()->route('suppliers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $cities = City::orderby('name', 'ASC')->get();

        return view('suppliers.form', compact('supplier', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|min:3|max:50|string|unique:suppliers,name,' . $supplier->id,
            'address' => 'required|min:3|max:50|string',
            'phone' => 'required|min:8|max:50|string',
            'email' => 'required|min:3|max:50|email',
            'city' => 'required|integer',
        ]);

        $supplier->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'city_id' => $request->city
        ]);

        flash("Le fournisseur {$supplier->name} a bien été modifié.")->success();

        return redirect()->route('suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $name = $supplier->name;

        $supplier->delete();

        flash("Le fournisseur {$supplier->name} a bien été supprimé.")->success();

        return back();
    }
}
