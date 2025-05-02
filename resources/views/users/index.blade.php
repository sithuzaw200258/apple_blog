@extends('layouts.app')
@section('title', 'User Lists')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Lists</li>
        </ol>
    </nav>

    <h5 class="text-primary fw-bold text-uppercase">User Lists</h5>
    <div class="card">
        <div class="card-body px-2 py-3">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection

@push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
