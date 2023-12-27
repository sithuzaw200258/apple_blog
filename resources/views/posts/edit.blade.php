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
                <button onclick="goBack()" class="btn btn-sm btn-outline-secondary px-3 py-1">Back</button>
            </div>
            <hr>
            <div class="">
                <form id="updatePostForm" action="{{ route('posts.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                </form>
                    <x-forms.input form="updatePostForm" label="Post Title" name="title" placeholder="The winter is coming..." :default="$post->title" />

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

                    <x-forms.input form="updatePostForm" label="Photos" type="file" name="photos" multiple=true />

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

                    <x-forms.textarea form="updatePostForm" label="Post Description" name="description" placeholder="This is a latest news..." :default="$post->description" />

                    <x-forms.input form="updatePostForm" label="Featured Image" type="file" name="featured_image" />
                    
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
