@extends('layouts.app')
@section('content')
    <div class="container p-2">
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between my-3">
            <h3 class="fw-bold">Table Lendings</h3>
            <div>
                <a href="{{ route('lending.create') }}" type="button" class="btn btn-dark me-5">+ add</a>
            </div>
        </div>

        <table class="table mt-3">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Item</th>
                    <th>Total</th>
                    <th>Name</th>
                    <th>Ket</th>
                    <th>Date</th>
                    <th>Returned</th>
                    <th>Edited By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($lendings) < 1)
                    <tr>
                        <td colspan='9' class="text-center">Data Lendings is empty</td>
                    </tr>
                @else
                    @foreach ($lendings as $index => $lending)
                        <tr class="text-center">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $lending->detailLendings->pluck('item.name')->implode(', ') ?? '-' }}
                            </td>
                            <td>{{ $lending->total_qty ?? 0 }}</td>
                            <td>{{ $lending->name }}</td>
                            <td>{{ $lending->notes }}</td>
                            <td>{{ $lending->borrow_date->format('j F Y') }}</td>
                            <td>
                                @if ($lending->return_date == null)
                                    <p class="text-warning border border-warning border-2 p-1 text-center">Not Returned</p>
                                @else
                                    <p class="text-success border border-success border-2 p-1 text-center">{{ $lending->return_date->format('j F Y') }}</p>
                                @endif
                            </td>
                            <td class="fw-bolder">
                                {{ $lending->user->name }}
                            </td>
                            <td class="d-flex justify-content-center p-3 gap-3">
                                @if ($lending->return_date == null)
                                    <form action="{{ route('lending.return', $lending->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-warning">Returned</button>
                                    </form>
                                @endif

                                <form action="{{ route('lending.destroy', $lending->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
