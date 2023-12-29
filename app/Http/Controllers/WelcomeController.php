<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Photo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function index() {
        $posts = Post::search()
        ->latest("id")
        // ->with(['category','user','photos'])
        ->paginate(5)->withQueryString();
        return view('frontend.welcome',compact('posts'));
    }

    public function detail($slug) {
        $post = Post::where("slug",$slug)
        ->with(['category','user','photos'])
        ->first();

        $recentPosts =Post::latest("id")->limit(5)->get();
        return view('frontend.detail',compact('post','recentPosts'));
    }

    public function postByCategory($slug) {
        // return $category;
        $category =Category::where("slug",$slug)->first();

        $posts = Post::where(function ($q) {
            $q->search();
        })
        ->where("category_id",$category->id)
        ->latest("id")
        // ->with(['category','user','photos'])
        ->paginate(5)->withQueryString();
        
        return view('frontend.welcome',compact('posts','category'));
    }

    public function deletePost($id) {
        
        $post = Post::findOrFail($id);

        // Authorization
        Gate::authorize('delete', $post);

        $postTitle = $post->title;
        // if(isset($post->featured_image)){
        //     // Delete photo
        //     Storage::delete("public/".$post->featured_image);
        // }

        // foreach ($post->photos as $photo) {
        //     Delete photo
        //     Storage::delete("public/".$photo->name);
        //     $photo->delete();
        // }

        // 2. Delete photos from storage
        // $photoArr = $post->photos->map(function($photo) { 
        //     return "public/".$photo->name;
        // })->toArray();
        // Storage::delete($photoArr);


        // 1. Delete Photos
        // Photo::where("post_id",$post->id)->delete();
        
        $post->delete();
        return redirect()->route('welcome')->with('status',$postTitle.' is deleted successfully.');

    }
}
