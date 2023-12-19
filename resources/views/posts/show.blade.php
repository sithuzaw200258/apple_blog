@extends('layouts.app')
@section('title', 'Post Details')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Post Details</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-primary fw-bolder">Post Details</h5>
                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-outline-secondary px-3 py-1">Back</a>
            </div>
            <hr>

            <div>
                <div class="mb-3">
                    @if ($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="" class="object-fit-cover"
                            width="500" height="500">
                    @endif
                </div>
                <h3>{{ $post->title }}</h3>
                <div class="d-flex column-gap-2 mb-3">
                    <div class="">
                        <p class="mb-0 badge bg-primary fw-light px-2 py-1">
                            <span><i class="bi bi-layers"></i></span>
                            {{ $post->category->title }}
                        </p>
                    </div>

                    <div class="">
                        <p class="mb-0 fw-light badge bg-success">
                            <span><i class="bi bi-person-circle"></i></span>
                            {{ $post->user->name }}
                        </p>
                    </div>

                    <div class="">
                        <p class="mb-0 badge bg-secondary fw-light">
                            <span><i class="bi bi-clock"></i></span>
                            {{ $post->created_at->diffForHumans(); }}...
                        </p>
                    </div>
                    
                </div>
                <p class="">{{ $post->description }}</p>

                @foreach ($post->photos as $photo)
                    <img src="{{ asset('storage/'.$photo->name) }}" alt="" class="object-fit-cover" width="150" height="150">
                @endforeach
            </div>
        </div>
    </div>
@endsection
