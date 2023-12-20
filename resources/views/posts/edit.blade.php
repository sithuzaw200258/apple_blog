@extends('layouts.app')
@section('title','Edit Post')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder text-primary">Edit Post</h5>
                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-outline-secondary px-3 py-1">Back</a>
            </div>
            <hr>
            <div class="">
                <form id="updatePostForm" action="{{ route('posts.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                </form>
                    <div class="mb-3">
                        <label for="postTitle" class="form-label fw-bold mb-0">Post Title</label>
                        <input type="text" name="title" id="postTitle" form="updatePostForm" value="{{ old('title',$post->title) }}" placeholder="The winter is coming...."
                            class="form-control @error('title')
                                is-invalid
                            @enderror">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label fw-bold mb-0">Category</label>
                        <select name="category" form="updatePostForm" class="form-select @error('category')
                            is-invalid
                        @enderror" id="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == old('category',$post->category_id)? 'selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="photos" class="form-label fw-bold mb-0">Photos</label>
                        <input type="file" name="photos[]" id="photos" form="updatePostForm" multiple
                            class="form-control @error('photos')
                                is-invalid
                            @enderror @error('photos.*')
                            is-invalid
                        @enderror">
                        @error('photos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @error('photos.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        @foreach ($post->photos as $photo)
                            <div class="position-relative d-inline-block">
                                <img src="{{ asset('storage/'.$photo->name) }}" alt="" class="object-fit-cover" width="70" height="70">
                                <form action="{{ route('photos.destroy',$photo) }}" method="POST">
                                    @csrf
                                    @method("delete")
                                    <button class="btn btn-sm btn-danger position-absolute top-0 end-0 lh-sm" style="padding: 1px 1px">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label for="postDescription" class="form-label fw-bold mb-0">Post Description</label>
                        <textarea name="description" id="postDescription"  form="updatePostForm" rows="5" placeholder="This is a latest news....."
                            class="form-control @error('description')
                                is-invalid
                            @enderror">{{ old('description',$post->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="featureImage" class="form-label fw-bold mb-0">Featured Image</label>
                        <input type="file" name="featured_image" id="featureImage" form="updatePostForm"
                            class="form-control @error('featured_image')
                                is-invalid
                            @enderror">
                        @error('featured_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        @if ($post->featured_image)
                            <img src="{{ asset('storage/'.$post->featured_image) }}" alt="" class="object-fit-cover" width="100" height="100">
                        @endif
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary" form="updatePostForm">Update Post</button>
                    </div>
            </div>
        </div>
    </div>
@endsection
