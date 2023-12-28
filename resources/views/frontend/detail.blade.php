@extends('frontend.layouts.master')

@section('title', 'Welcome Page')

@section('content')
    <div class="container">
        <div class="row py-3 justify-content-center">
            <div class="col-md-6">

                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post Details</li>
                    </ol>
                </nav>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="user mb-3 d-flex justify-content-between align-items-center">
                            <div class="">
                                <img src="{{ asset('mboy.jpg') }}" alt="User Photo" class="profile-image">
                                <span class="fw-bold d-inline-block ps-2">{{ $post->user->name }}</span>
                            </div>
                            @can('update', $post)
                                <div class="">
                                    <div class="dropdown">
                                        <button class="btn btn-white dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-gear"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @can('update', $post)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">
                                                        <i class="bi bi-pencil-square me-1"></i>Edit Post
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('delete', $post)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('welcome.posts.delete', $post->id) }}" onclick="event.preventDefault();
                                                    document.getElementById('delete-form').submit();">
                                                        <i class="bi bi-trash3 me-1"></i>Delete Post
                                                    </a>
                                                </li>
                                                <form id="delete-form" action="{{ route('welcome.posts.delete', $post->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('delete')
                                                    
                                                </form>
                                            @endcan
                                        </ul>
                                    </div>
                                </div>
                            @endcan
                        </div>
                        <div class="d-flex column-gap-2 mb-3">
                            <div class="">
                                <p class="mb-0 badge bg-primary fw-light px-2 py-1">
                                    <span><i class="bi bi-layers"></i></span>
                                    {{ $post->category->title }}
                                </p>
                            </div>

                            <div class="">
                                <p class="mb-0 badge bg-secondary fw-light">
                                    <span><i class="bi bi-clock"></i></span>
                                    {{ $post->created_at->diffForHumans() }}...
                                </p>
                            </div>

                        </div>

                        <h3>{{ $post->title }}</h3>
                        <p class="mb-3 text-muted" style="white-space: pre-wrap">{{ $post->description }}</p>

                        @foreach ($post->photos as $photo)
                            <img src="{{ asset('storage/' . $photo->name) }}" alt="" class="object-fit-cover"
                                width="150" height="150">
                        @endforeach
                    </div>
                </div>

                <div class="text-end">
                    <button onclick="goBack()" class="btn btn-sm btn-outline-secondary px-3 py-1">Back</button>
                </div>
            </div>
            <div class="col-md-3">
                @include('frontend.layouts.sidebar')

                <h6 class="text-uppercase text-muted fw-bolder">
                    <i class="bi bi-postcard-fill me-1"></i> Recent Posts
                </h6>
                @forelse ($recentPosts as $recentPost)
                    <div class="list-group">
                        <a href="{{ route('welcome.detail', $recentPost->slug) }}" class="list-group-item list-group-item-action {{ request()->url() === route('welcome.detail', $recentPost->slug) ? 'active' : ''; }}">{{ $recentPost->title }}</a>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection
