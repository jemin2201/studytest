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
        $post = Post::all();
        return Inertia::render('Posts/Posts', [
            'posts' => $post
        ]);
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
        Post::table('posts')->insert([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return back()->with('post_created', '글이 성공적으로 등록되었습니다.');
        // $requestData = $request->all();
        // Post::create($requestData);
        // return redirect('posts')->with('flash_message', 'Post Addedd!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return Inertia::render('Posts/PostsShow', [
            'posts' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
