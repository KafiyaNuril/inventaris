@extends('layouts.app')
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between">
        <h5>Tabel item</h5>
        <a class="btn btn-dark" mb-3 href="{{ route('item.create') }}" role="button">+ add</a>
    </div>
    <table class="table">
        <thead>
            <tr class="table-active">
                <th scope="col">#</th>
                <th scoper="col">item</th>
                <th scope="col">Name</th>
                <th scope="col">total</th>
                <th scope="col">Repair</th>
                <th scope="col">Lending</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if( count($items) < 1 )
                <tr>
                    <td colspan="7" class="text-center">Item is Empty</td>
                </tr>
            @else
                <tr>
                    @foreach( $items as $index => $item)
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->total }}</td>
                        <td>{{ $item->repair }}</td>
                        <td>{{ $item->total_lendings ?? 0 }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('item.edit', $item->id) }}" role="button">edit</a>
                        </td>
                    @endforeach
                </tr>
            @endif
        </tbody>
    </table>
@endsection