@extends('layouts.app')
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="container card p-4 w-50">
        <form action="{{ route('item.update', $item->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    placeholder="name item" value="{{ $item->name }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                    <option selected disabled hidden>Select Category</option>
                    @foreach( $categories as $category)
                        <option value="{{ $category->id }}" @selected($item->category_id == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">total</label>
                <input type="number" class="form-control @error('total') is-invalid @enderror" name="total"
                    placeholder="total item" value="{{ $item->total }}">
                @error('total')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <a href="{{ route('item.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-dark">Submit</button>
        </form>
    </div>
@endsection