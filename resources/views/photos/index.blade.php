@extends('layouts.app')
@section('title', 'Gallary')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gallary</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">Gallary</div>

        <div class="card-body">
            <div class="gallary">
                @forelse (Auth::user()->photos as $photo)
                    <img src="{{ asset('storage/' . $photo->name) }}" alt="" class="w-100 mb-3 object-fit-cover" width="100%">
                @empty
                    <p class="">There is no photos.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
