<?php

namespace App\Http\Controllers;

use App\Models\Secondhand;
use App\models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SecondhandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Secondhand::with('user')->get();
        return Inertia::render('secondhands/Itemindex', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('secondhands/itemcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = $request->all();
        
        $request->validate([
            'title' => 'required|unique:post|max:255',
            'content' => 'required',
            'price' => 'required',
            'photo' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

         $file = $request->file('photo');
        $fileContent = file_get_contents($file->getRealPath());
        


        Secondhand::create([
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
            'photo' => $fileContent,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('secondhand.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Secondhand $secondhand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Secondhand $secondhand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Secondhand $secondhand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Secondhand $secondhand)
    {
        //
    }
}
