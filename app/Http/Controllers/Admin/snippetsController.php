<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;


use App\Models\vendors;
use App\Models\snippets;
use App\Models\users;
use App\Models\publishStatus;

class snippetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Snippets/index',[
            'snippets' => snippets::with('author','vendor','instruction')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Snippets/create',[
            'vendors' => vendors::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return dd($request);

        snippets::insert([
            'title' => $request->title,
            'description' => $request->description,
            'vendorId' => $request->vendor,
            'authorId' => $request->user()->id,
            'statusId' => 1,
            'listPosition' => 1
        ]);

        return redirect()->route('snippets.index')->with('success','Done');
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
        return Inertia::render('Admin/Snippets/edit',[
            'snippet' => snippets::where('snippets.id', '=', $id)
                ->join('users', 'users.id', '=', 'snippets.authorId')
                ->select('snippets.*', 'users.name', 'users.id as authorId')
                ->first(),
            'vendors' => vendors::all()
        ]);

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        snippets::where('id','=', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'vendorId' => $request->vendor,
            'statusId' => 1
        ]);

        return redirect()->route('snippets.index')->with('message','Done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $snippet = Snippets::findOrFail($id)->delete();

        return redirect()->route('snippets.index')->with('success','Done');
    }
}
