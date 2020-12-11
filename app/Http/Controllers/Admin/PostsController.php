<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $posts = Post::sortable(['published_at' => 'desc'])->paginate();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $post = new Post();

        return view('admin.posts.create', [
            'post' => $post,
            'showUrl' => false,
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CreatePostRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('flash', 'Registro creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post,
            'showUrl' => true,
            'categories' => Category::all(),
            'tags'      => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Post $post
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();

        $post->update($data);

        return redirect()->route('admin.posts.edit', $post)->with('flash', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('flash', 'Registro eliminado correctamente');
    }
}
