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
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Division Pj</th>
                <th scope="col">Total Items</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if( count($categories) < 1 )
                <tr>
                    <td colspan="5" class="text-center">Category is Empty</td>
                </tr>
            @else
                <tr>
                    @foreach( $categories as $index => $category)
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->division_pj }}</td>
                        <td>{{ $category->total_items }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('category.edit', $category->id) }}" role="button">edit</a>
                        </td>
                    @endforeach
                </tr>
            @endif
        </tbody>
    </table>
@endsection