@extends('layouts.app')
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between">
        <h5>Tabel Category</h5>
        <a class="btn btn-dark mb-3" href="{{ route('category.create') }}" role="button">+ add</a>
    </div>
    <table class="table">
        <thead>
            <tr class="table-active">
                <th>#</th>
                <th>Name</th>
                <th>Division Pj</th>
                <th>Total Items</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if( count($categories) < 1 )
                <tr>
                    <td colspan="5" class="text-center">Category is Empty</td>
                </tr>
            @else
                @foreach( $categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->division_pj }}</td>
                        <td>{{ $category->total_items ?? 0 }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('category.edit', $category->id) }}" role="button">edit</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection