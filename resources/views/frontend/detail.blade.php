@extends('frontend.layouts.master')

@section('title', 'Welcome Page')

@section('content')

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
            <p class="mb-3 text-muted">{{ $post->description }}</p>

            @foreach ($post->photos as $photo)
                <img src="{{ asset('storage/' . $photo->name) }}" alt="" class="object-fit-cover" width="150"
                    height="150">
            @endforeach
        </div>
    </div>

@endsection
