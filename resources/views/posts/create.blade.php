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
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bolder text-primary">Create New Post</h5>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <icon class="bi bi-file-earmark-excel"></icon>
                    Import Excel
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Import Excel File</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('posts.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="input-group mb-3">
                                        <input type="file" name="excel_file" class="form-control" id="inputGroupFile02">
                                        <button type="submit" class="input-group-text btn btn-primary" for="inputGroupFile02">Import</button>
                                    </div>
                                </form>
                                {{-- <form action="{{ route('posts.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="excel_file" class="form-label">Upload Excel File</label>
                                        <input type="file" class="form-control" id="excel_file" name="excel_file"
                                            accept=".xlsx, .xls, .csv" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Import</button>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="">
                <div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
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
