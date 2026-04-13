@extends('layouts.app')
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="container card p-4 w-50">
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    placeholder="name" value="{{ $user->name }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    placeholder="email" value="{{ $user->email }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    placeholder="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-dark">Submit</button>
        </form>
    </div>
@endsection
