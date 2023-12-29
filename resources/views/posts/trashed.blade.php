@extends('layouts.app')
@section('title', 'Deleted Posts')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Deleted Posts</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h5 class="text-primary fw-bolder">Deleted Posts</h5>

            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-4">
                    @if (request('keyword'))
                        <p style="font-size: 12px">
                            Search by : <span class="fw-bold"> "{{ request('keyword') }}"</span>
                            <a href="{{ route('posts.trashed') }}" class=""><i class="bi bi-x"
                                    style="color: #df0000;font-size :16px;"></i></a>
                        </p>
                    @endif
                </div>
                <div class="col-md-6">
                    <form method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" value="{{ old('keyword') }}"
                                placeholder="Search by post title & description...">
                            <button class="input-group-text btn btn-primary">Search Posts</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Post Title</th>
                    <th>Category</th>

                    @notuser
                        <th>Created User</th>
                    @endnotuser

                    <th>Date & Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            <p class="mb-0">{{ $post->title }}</p>
                        </td>
                        <td class="text-nowrap">{{ $post->category->title }}</td>

                        @notuser
                            <td>{{ $post->user->name }}</td>
                        @endnotuser
                        
                        <td class="text-nowrap">
                            <div class="">
                                <i class="bi bi-calendar3" style="color: rgb(51, 112, 226);"></i>
                                {{ $post->created_at->format('Y M d') }}
                            </div>
                            <div class="">
                                <i class="bi bi-clock" style="color: rgb(51, 112, 226);"></i>
                                {{ $post->created_at->format('h : m A') }}
                            </div>
                        </td>
                        <td class="text-nowrap">
                            @can('delete', $post)
                                <form action="{{ route('posts.restore', $post->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-recycle"></i>
                                    </button>
                                </form> 

                                <form action="{{ route('posts.delete', $post->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            @endcan

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">There is no post .....</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $posts->onEachSide(1)->links() }}
    </div>
    </div>
@endsection
