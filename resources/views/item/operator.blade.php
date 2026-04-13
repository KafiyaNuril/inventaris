@extends('layouts.app')
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between">
        <h5>Tabel item</h5>
    </div>
    <table class="table">
        <thead>
            <tr class="table-active">
                <th scope="col">#</th>
                <th scoper="col">Item</th>
                <th scope="col">Name</th>
                <th scope="col">total</th>
                <th scope="col">Available</th>
                <th scope="col">Lending</th>
            </tr>
        </thead>
        <tbody>
            @if( count($items) < 1 )
                <tr>
                    <td colspan="7" class="text-center">Item is Empty</td>
                </tr>
            @else
                @foreach( $items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->total }}</td>
                        <td>{{ $item->available }}</td>
                        <td>{{ $item->total_lending ?? 0 }}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection