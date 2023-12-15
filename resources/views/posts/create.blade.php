@extends('layouts.app')
@section('title', 'Create Post')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Post</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h5 class="fw-bolder text-primary">Create New Post</h5>
            <hr>
            <div class="">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="postTitle" class="form-label fw-bold mb-0">Post Title</label>
                        <input type="text" name="title" id="postTitle" value="{{ old('title') }}" placeholder="The winter is coming...."
                            class="form-control @error('title')
                                is-invalid
                            @enderror">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label fw-bold mb-0">Category</label>
                        <select name="category" class="form-select @error('category')
                            is-invalid
                        @enderror" id="category">
                            @foreach (\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" {{ $category->id == old('category')? 'selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="postDescription" class="form-label fw-bold mb-0">Post Description</label>
                        <textarea name="description" id="postDescription" rows="5" placeholder="This is a latest news....."
                            class="form-control @error('description')
                                is-invalid
                            @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="featureImage" class="form-label fw-bold mb-0">Featured Image</label>
                        <input type="file" name="featured_image" id="featureImage"
                            class="form-control @error('featured_image')
                                is-invalid
                            @enderror">
                        @error('featured_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary">Create Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
