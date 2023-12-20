<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $posts = Post::when(request("keyword"),function($q){
            $keyword = request("keyword");
            $q->orWhere("title","like","%$keyword%")
            ->orWhere("description","like","%$keyword%");
        })
        ->latest("id")
        ->with(['category','user'])
        ->paginate(5)->withQueryString();
        return view('frontend.welcome',compact('posts'));
    }

    public function detail($slug) {
        $post = Post::where("slug",$slug)
        ->with(['category','user','photos'])
        ->first();
        return view('frontend.detail',compact('post'));
    }

    public function postByCategory($slug) {
        // return $category;
        $category =Category::where("slug",$slug)->first();

        $posts = Post::where(function ($q) {
            $q->when(request("keyword"),function($q){
                $keyword = request("keyword");
                $q->orWhere("title","like","%$keyword%")
                ->orWhere("description","like","%$keyword%");
            });
        })
        ->where("category_id",$category->id)
        ->latest("id")
        ->with(['category','user'])
        ->paginate(5)->withQueryString();
        
        return view('frontend.welcome',compact('posts','category'));
    }
}
