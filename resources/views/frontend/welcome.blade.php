@extends('frontend.layouts.master')

@section('title', 'Welcome Page')

@section('content')
    <div class="container">
        <div class="row py-3 justify-content-center">
            <div class="col-md-6">
                <div class="">
                    @forelse ($posts as $post)
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
                                                <button class="btn btn-white dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown">
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
                                                            <a class="dropdown-item" href="{{ route('posts.destroy', $post->id) }}"
                                                                onclick="event.preventDefault();
                                                                document.getElementById('delete-form').submit();">
                                                                <i class="bi bi-trash3 me-1"></i>Delete Post
                                                            </a>
                                                        </li>
                                                        <form id="delete-form" action="{{ route('posts.destroy', $post->id) }}"
                                                            method="POST" class="d-none">
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
                                <p class="mb-0 text-muted">{{ $post->excerpt }}</p>

                                <div class="text-end">
                                    <a href="{{ route('welcome.detail', $post->slug) }}" class="btn btn-link">See
                                        More...</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-0">There is no posts.</p>
                            </div>
                        </div>
                    @endforelse

                    {{ $posts->onEachSide(1)->links() }}
                </div>
            </div>
            <div class="col-md-3">
                @include('frontend.layouts.sidebar')
            </div>
        </div>
    </div>
@endsection
