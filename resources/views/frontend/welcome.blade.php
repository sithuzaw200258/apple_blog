@extends('frontend.layouts.master')

@section('title', 'Welcome Page')

@section('content')

    <div class="">
        @forelse ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="user mb-3">
                        <img src="{{ asset('mboy.jpg') }}" alt="User Photo" class="profile-image">
                        <span class="fw-bold d-inline-block ps-2">{{ $post->user->name }}</span>
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
                        <a href="{{ route('welcome.detail', $post->slug) }}" class="btn btn-link">See More...</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body">
                    <p class="">There is no posts.</p>
                </div>
            </div>
        @endforelse

        {{ $posts->onEachSide(1)->links() }}
    </div>

@endsection
