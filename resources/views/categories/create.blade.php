@extends('layouts.app')
@section('title','Create Category')
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
            <li class="breadcrumb-item active" aria-current="page">Create Category</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h5 class="fw-bolder text-primary">Create New Category</h5>
            <hr>
            <div class="">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="title"
                            class="form-control @error('title') is-invalid
                        @enderror"
                            value="{{ old('title') }}" placeholder="Enter your category title">
                        <button class="input-group-text btn btn-primary">Create category</button>
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
