@extends('layouts.app')
@section('title', 'User Lists')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Lists</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h5 class="text-primary fw-bolder">User Lists</h5>

            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-4">
                    @if (request('keyword'))
                        <p style="font-size: 12px">
                            Search by : <span class="fw-bold"> "{{ request('keyword') }}"</span>
                            <a href="{{ route('users.index') }}" class=""><i class="bi bi-x"
                                    style="color: #df0000;font-size :16px;"></i></a>
                        </p>
                    @endif
                </div>
                <div class="col-md-6">
                    <form action="{{ route('users.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" value="{{ old('keyword') }}"
                                placeholder="Search by user name & email...">
                            <button class="input-group-text btn btn-primary">Search Users</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Date & Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td class="text-nowrap">
                            <div class="">
                                <i class="bi bi-calendar3" style="color: rgb(51, 112, 226);"></i>
                                {{ $user->created_at->format('Y M d') }}
                            </div>
                            <div class="">
                                <i class="bi bi-clock" style="color: rgb(51, 112, 226);"></i>
                                {{ $user->created_at->format('h : m A') }}
                            </div>
                        </td>
                        <td class="text-nowrap">
                            
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">There is no users .....</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $users->onEachSide(1)->links() }}
    </div>
    </div>
@endsection
