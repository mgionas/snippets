<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\User;
use App\Models\vendors;
use App\Models\snippets;
use App\Models\Instructions;


class instructionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructions = Instructions::with('snippets')
        ->get()
        ->map(function ($instruction) {
            $instruction->authorId = User::find($instruction->authorId);
            // Collect unique vendor IDs from the instruction's snippets
            $vendorIds = $instruction->snippets->pluck('vendorId')->unique();
            
            // Assign the vendor titles to the instruction
            $instruction->vendorsList = Vendors::whereIn('id', $vendorIds)->pluck('img');
            
            return $instruction;
        });

        return Inertia::render('Admin/instructions/index',[
            'instructions' => $instructions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/instructions/create',[
            'vendors' => vendors::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $instructionId = instructions::create([
            'title' => $request->instruction['title'],
            'description' => $request->instruction['description'],
            'authorId' => $request->user()->id,
            'statusId' => 1
        ]);

        foreach ($request->snippets as $snippet){
            snippets::create([
                'title' => $snippet['title'],
                'description' => $snippet['description'],
                'instructionsId' => $instructionId->id,
                'vendorId' => $snippet['vendorId'],
                'authorId' => $request->user()->id,
                'statusId' => 1,
                'listPosition' => 1

            ]);
        }

        return redirect()->route('instructions.index')->with('success','Done');
        
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
        $instructions = Instructions::where('id','=',$id)->with('snippets')->first();

        //return(dd($id));

        return Inertia::render('Admin/instructions/edit',[
            'vendors' => vendors::all(),
            'instructions' => $instructions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //return dd($request->instruction);

        Instructions::where('id','=', $id)->update([
            'title' => $request->instruction['title'],
            'description' => $request->instruction['description']
        ]);

        foreach($request->snippets as $snippet){
            snippets::where('id','=', $snippet['id'])->update([
                'title' => $snippet['title'],
                'description' => $snippet['description'],
                'vendorId' => $snippet['vendorId'],
            ]);
        }
        
        return redirect()->route('instructions.index')->with('success','Done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
