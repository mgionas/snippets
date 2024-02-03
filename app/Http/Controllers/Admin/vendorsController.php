<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\vendors;

class vendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Vendors/index',[
            'vendors' => vendors::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Vendors/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return dd($request->file('icon')->filename);


        $imagePath = $request->file('icon')->store('vendorIcons', 'public');

        vendors::insert([
            'title' => $request->data['name'],
            'description' => $request->data['description'],
            'img' => $imagePath,
            'authorId' => $request->user()->id,
            'statusId' => 1
        ]);

        return redirect()->route('vendors.index')->with('message','Done');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Inertia::render('Admin/Vendors/edit',[
            'vendor' => vendors::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->file('icon')){
            $imagePath = $request->file('icon')->store('vendorIcons', 'public');
            vendors::where('id',$id)->update([
                'img' => $imagePath,
            ]);
        }

        vendors::where('id',$id)->update([
            'title' => $request->data['name'],
            'description' => $request->data['description'],
            'authorId' => $request->user()->id,
            'statusId' => 1
        ]);

        return redirect()->route('vendors.index')->with('message','Done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
