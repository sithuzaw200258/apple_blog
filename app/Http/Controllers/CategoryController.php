<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::when(Auth::user()->isUser(),function($q){
            $q->where("user_id",Auth::id());
        })
        ->latest("id")->get();
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        $category->user_id = Auth::id();
        $category->save();

        return redirect()->route('categories.index')->with('status',$category->title.' is added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return redirect()->route('categories.index');
        // return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // Authorization
        Gate::authorize('update', $category);
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Authorization
        Gate::authorize('update', $category);

        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        $category->user_id = Auth::id();
        $category->update();

        return redirect()->route('categories.index')->with('status',$category->title.' is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
         // Authorization
        Gate::authorize('delete', $category);

        $categoryTitle = $category->title;
        $category->delete();
        return redirect()->route('categories.index')->with('status',$categoryTitle.' is deleted successfully.');
    }
}
