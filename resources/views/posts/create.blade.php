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
                    <x-forms.input label="Post Title" name="title" placeholder="The winter is coming..." />

                    <div class="mb-3">
                        <label for="category" class="form-label fw-bold mb-0">Category</label>
                        <select name="category"
                            class="form-select @error('category')
                            is-invalid
                        @enderror"
                            id="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == old('category') ? 'selected' : '' }}>
                                    {{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-forms.input label="Photos" type="file" name="photos" multiple=true />

                    <x-forms.textarea label="Post Description" name="description" placeholder="This is a latest news..." />    

                    <x-forms.input label="Featured Image" type="file" name="featured_image" />

                    <div class="text-end">
                        <button class="btn btn-primary">Create Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
