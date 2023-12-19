@extends('layouts.app')
@section('title','Edit Category')
@section('css')
    <style>
        .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            border-top-right-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
        }
    </style>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder text-primary">Edit Category</h5>
                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary px-3 py-1">Back</a>
            </div>
            <hr>
            <div class="">
                <form action="{{ route('categories.update',$category->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="input-group mb-3">
                        <input type="text" name="title"
                            class="form-control @error('title') is-invalid
                        @enderror"
                            value="{{ old('title',$category->title) }}" placeholder="Enter your category title">
                        <button class="input-group-text btn btn-primary">Update Category</button>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
