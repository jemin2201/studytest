<?php

namespace App\Http\Controllers;

use App\Models\Secondhand;
use App\models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;


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
            'title' => 'required|unique:secondhands|max:255', // required는 반드시 입력
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
            'title' => 'required|max:255',  
            'content' => 'required',        
            'price' => 'required',         
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);



        $photoPath = $item->photo;

        if($request->hasFile('photo')) {
            // 기존 파일 삭제
            $delphoto = json_decode($item->photo, true);
            if($delphoto && is_array($delphoto)){
                foreach ($delphoto as $photo) {
                    $path = str_replace('/storage/', '', $photo);
                    Storage::disk('public')->delete($path);
                }
            }
    
            // 새 파일 저장
            $image = [];
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $image[] = '/storage/'.$path;
            $photoPath = json_encode($image);
        }

        $item->update([
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
            'photo' => $photoPath,
        ]);

        return redirect()->route('secondhand.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Secondhand::findOrFail($id);

        // photo를 json으로 바꿈
        $delphoto = json_decode($item->photo, true);

        if($delphoto && is_array($delphoto)){ // delphoto가 배열인지 확인
            foreach ($delphoto as $photo) {

                $path = str_replace('/storage/', '', $delphoto); // 파일 찾기
                Storage::disk('public')->delete($path); // 파일을 삭제
            }
        }
        
        $item->delete();

        return redirect()->route('secondhand.index');
    }
}
