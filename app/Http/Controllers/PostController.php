<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->get();
        return Inertia::render('Posts/Posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Posts/Postcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ // 유효성 검사
            'title' => 'required|unique:post|max:255',
            'content' => 'required',
        ]);
        // 새로운 데이터 추가
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);
        // 리다이렉트 메소드를 사용했고 작업을 완료하면 Posts.index로 보내라
        return  redirect()->route('Posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // 데이터베이스에서 id를 찾고 존재하지 않으면 예외시킨다
        $post = Post::findOrFail($id);
        // PostShow로 데이터를 전달하고 페이지로 넘어간다
        return Inertia::render('Posts/PostShow', compact('post'));// compact는 'post' => $post
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // 데이터베이스에서 id를 찾고 존재하지 않으면 예외
        $post = Post::findOrFail($id);
        // PostEdit으로 데이터를 전달하고 페이지로 넘어간다
        return Inertia::render('Posts/PostEdit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 데이터베이스에서 id를 찾고 존재하지 않으면 예외한다
        $post = Post::findOrFail($id);
        $request->validate([ // 유효성 검사
            'title' => 'required|unique:post|max:255',
            'content' => 'required|unique:post|string',
        ]);

        $post->update([  // 데이터베이스에 기존 정보를 수정하는 코드
            'title' => $request->title,
            'content' => $request->content,
        ]);
        // 리다이렉트 메소드를 사용했고 작업을 완료하면 PostShow/id로 넘어간다
        return Inertia::render(route('Posts/PostShow', compact('post')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
