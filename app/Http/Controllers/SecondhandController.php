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
            'title' => 'required|unique:secondhands|max:255',
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

        $request->validate([ // 유효성 검사
            'title' => 'required|max:255',
            'content' => 'required',
            'price' => 'required',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fileName = $item->photo;
        $filepath = public_path('images/' . $fileName);

        if ($request->hasFile('photo')) {
            // 기존 파일 경로 가져오기
            $oldFilePath = public_path(json_decode($item->photo));
            
            // 기존 파일이 존재하면 삭제
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        
            // 새로운 파일 처리
            $file = $request->file('photo');
            $file_ext = $file->getClientOriginalExtension();
            $fileName = rand(123456, 999999) . '.' . $file_ext;
            $filePath = public_path('images/');
            $file->move($filePath, $fileName);
        
            // 새로운 파일 경로를 JSON 형식으로 저장
            $filephoto = ['/storage/images/' . $fileName];
            $item->photo = json_encode($filephoto);
        }



        // $image = [];
        // // 원래 파일이름 앞에 시간을 합친다
        // $fileName = time().$request->file('photo')->getClientOriginalName();
        // // 파일을 images라는 폴더에 저장
        // $path = $request->file('photo')->storeAs('images', $fileName, 'public');
        // // 저장된 파일을 비어있는 image에 넣는다
        // $image[] = '/storage/'.$path;
        // // photo에 json형식으로 저장
        // $item['phpto'] = json_encode($image);

        $item->update([
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
            'photo' => $item->photo,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('secondhand.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Secondhand::findOrFail($id);

        $item->delete();

        return redirect()->route('secondhand.index');
    }
}
