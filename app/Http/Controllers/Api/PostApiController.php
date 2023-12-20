<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostApiController extends Controller
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
        
        return response()->json($posts);
    }

    public function detail($slug){
        $post = Post::where("slug",$slug)
        ->with(['category','user','photos'])
        ->first();

        return response()->json($post);
    }
}
