<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q->orWhere("title","like","%$keyword%")
            ->orWhere("description","like","%$keyword%");
        })
        ->latest("id")
        ->paginate(10)
        ->withQueryString();
        return view("posts.index",compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 30, ' .....');
        $post->category_id = $request->category;
        $post->user_id = Auth::id();
        $post->title = $request->title;

        if ($request->hasFile('featured_image')) {
            $fileName = uniqid()."_featured_image.".$request->featured_image->extension();
            $request->featured_image->storeAs("public",$fileName);

            $post->featured_image = $fileName;
        }

        $post->save();
        return redirect()->route('posts.index')->with('status',$post->title." is created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("posts.show",compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("posts.edit",compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 30, ' .....');
        $post->category_id = $request->category;
        $post->user_id = Auth::id();
        $post->title = $request->title;

        if ($request->hasFile('featured_image')) {

            // Delete old photo
            Storage::delete("public/".$post->featured_image);
            
            $fileName = uniqid()."_featured_image.".$request->featured_image->extension();
            $request->featured_image->storeAs("public",$fileName);

            $post->featured_image = $fileName;
        }

        $post->update();
        return redirect()->route('posts.index')->with('status',$post->title." is updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $postTitle = $post->title;
        if(isset($post->featured_image)){
            // Delete photo
            Storage::delete("public/".$post->featured_image);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('status',$postTitle.' is deleted successfully.');
    }
}
