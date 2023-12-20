@extends('layouts.app')
@section('title','Edit User')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder text-primary">Edit User</h5>
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary px-3 py-1">Back</a>
            </div>
            <hr>
            <div class="">
                <form action="{{ route('users.update',$user->id) }}" method="POST">
                    @csrf
                    @method("put")
                
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold mb-0">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name',$user->name) }}" placeholder="Jhone Doe"
                            class="form-control @error('name')
                                is-invalid
                            @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold mb-0">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email',$user->email) }}" placeholder="jhonedoe@gmail.com"
                            class="form-control @error('email')
                                is-invalid
                            @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label fw-bold mb-0">Role</label>
                        <select class="form-select @error('role')
                            is-invalid
                        @enderror" name="role" id="role">
                            <option value="{{ $user->role }}" {{ old('role',$user->role) === 'user' ? 'selected':''; }}>User</option>
                            <option value="{{ $user->role }}" {{ old('role',$user->role) === 'editor' ? 'selected':''; }}>Editor</option>
                            <option value="{{ $user->role }}" {{ old('role',$user->role) === 'admin' ? 'selected':''; }}>Admin</option>
                        </select>                     
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
