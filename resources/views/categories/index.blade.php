@extends('layouts.app')
@section('title', 'Category Lists')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category Lists</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h5 class="text-primary fw-bolder">Category Lists</h5>

            <table class="table table-striped table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Title</th>
                        <th>Created User</th>
                        <th scope="col">Date & Time</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                <p class="mb-0">{{ $category->title }}</p>
                                <p class="badge text-bg-primary mb-0">{{ $category->slug }}</p>
                            </td>
                            <td>{{  \App\Models\User::find($category->user_id)->name }}</td>
                            <td class="text-nowrap">
                                <div class="">
                                    <i class="bi bi-calendar3" style="color: rgb(51, 112, 226);"></i>
                                    {{ $category->created_at->format('Y M d') }}
                                </div>
                                <div class="">
                                    <i class="bi bi-clock" style="color: rgb(51, 112, 226);"></i>
                                    {{ $category->created_at->format('h : m A') }}
                                </div>
                            </td>
                            <td class="text-nowrap">
                                <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('categories.destroy',$category->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method("delete")
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
