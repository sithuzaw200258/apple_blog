<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Photo;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        $posts = Post::search()
        ->when(Auth::user()->isUser(),function($q){
            $q->where("user_id",Auth::id());
        })
        // ->with(['category','user','photos'])
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

        // Store posts to the database
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

        $photoArr = [];

        foreach ($request->photos as $key=>$photo) {
            $fileName = uniqid()."_post_photo.".$photo->extension();

            // Store photos to the storage folder
            $photo->storeAs("public",$fileName);

            // 1.Store photos to the dateabase
            $photoArr[$key]=[
                "post_id" => $post->id,
                "name" => $fileName,
            ];

            // 2.Store photos to the database
            // $photo = new Photo();
            // $photo->post_id = $post->id;
            // $photo->name = $fileName;
            // $photo->save();
        }

        Photo::insert($photoArr);
        
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
         // Authorization
        Gate::authorize("view",$post);
        
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
        // Authorization
        Gate::authorize('update', $post);

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
        // Authorization
        Gate::authorize('update', $post);

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


        if ($request->photos) {
            $photoArr=[];
            foreach ($request->photos as $key=>$photo) {
                $fileName = uniqid()."_post_photo.".$photo->extension();
    
                // Store photos to the storage folder
                $photo->storeAs("public",$fileName);

                // 1.Store photos to the dateabase
                $photoArr[$key]=[
                    "post_id" => $post->id,
                    "name" => $fileName,
                ];

                // 2.Store photos to the database
                // $photo = new Photo();
                // $photo->post_id = $post->id;
                // $photo->name = $fileName;
                // $photo->save();
            }

            Photo::insert($photoArr);
        }

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
        // Authorization
        Gate::authorize('delete', $post);

        $postTitle = $post->title;
        $post->delete();
        return redirect()->route('posts.index')->with('status',$postTitle.' is deleted successfully.');
    }

    public function deletedPosts() {
        $posts = Post::search()
        ->when(Auth::user()->isUser(),function($q){
            $q->where("user_id",Auth::id());
        })
        ->onlyTrashed()
        // ->with(['category','user','photos'])
        ->latest("id")
        ->paginate(10)
        ->withQueryString();

        return view("posts.trashed",compact('posts'));
    }

    public function forceDeletePost($id)
    {
        // return $id;

        $post= Post::withTrashed()->findOrFail($id);
        // dd($post);

        // Authorization
        Gate::authorize('delete', $post);

        $postTitle = $post->title;
        if(isset($post->featured_image)){
            // Delete photo
            Storage::delete("public/".$post->featured_image);
        }

        // 1. Delete photos from storage
        // foreach ($post->photos as $photo) {
            // Delete photo
            // Storage::delete("public/".$photo->name);
            // $photo->delete();

        // }

        // 2. Delete photos from storage
        $photoArr = $post->photos->map(function($photo) { 
            return "public/".$photo->name;
        })->toArray();
        Storage::delete($photoArr);

        // 1. Delete Photos
        Photo::where("post_id",$post->id)->delete();

         // 2. Delete Photos
        // $photoIdArr = $post->photos->pluck("id")->toArray();
        // Photo::destroy($photoIdArr);
        
        $post->forceDelete(); 
        return redirect()->route('posts.trashed')->with('status',$postTitle.' is deleted successfully.');
    }

    public function restorePost($id) {
        $post = Post::withTrashed()->findOrFail($id);

         // Authorization
        Gate::authorize('delete', $post);

        $postTitle = $post->title;

        $post->restore();
        return redirect()->route('posts.trashed')->with('status',$postTitle.' is restored successfully.');
    }
}
