@extends('layouts.app')
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="container card p-4 w-50">
        <form action="{{ route('category.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    placeholder="name category">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="division_pj" class="form-label">Division PJ</label>
                <select class="form-select @error('division_pj') is-invalid @enderror" name="division_pj">
                    <option selected disabled hidden>Select Division PJ</option>
                    <option value="Sarpras">Sarpras</option>
                    <option value="Tata Usaha">Tata Usaha</option>
                    <option value="Tefa">Tefa</option>
                </select>
                @error('division_pj')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-dark">Submit</button>
        </form>
    </div>
@endsection
