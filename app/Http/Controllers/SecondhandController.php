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
        
        $request->validate([ // 유효성 검사
            'title' => 'required|unique:post|max:255',
            'content' => 'required',
            'price' => 'required',
            'photo' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = [];
        // 원래 파일이름 앞에 시간을 합친다
        $fileName = time().$request->file('photo')->getClientOriginalName();
        // 파일을 images라는 폴더에 저장
        $path = $request->file('photo')->storeAs('images', $fileName, 'public');
        // 저장된 파일을 비어있는 image에 넣는다
        $image[] = '/storage/'.$path;
        // photo에 json형식으로 저장
        $item['photo'] = json_encode($image);

        Secondhand::create([
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
            'photo' => $item['photo'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('secondhand.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Secondhand::findOrFail($id);
        $user = auth()->id();

        return Inertia::render('secondhands/Itemshow', compact('item','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Secondhand::findOrfail($id);

        return Inertia::render('secondhands/ItemEdit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Secondhand::findOrfail($id);
        $request->validate([
            'title' => 'required|unique:post|max255',
            'content' => 'required',
            'price' => 'required',
            'photo' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Secondhand $secondhand)
    {
        //
    }
}
