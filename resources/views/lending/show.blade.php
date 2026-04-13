@extends('layouts.app')
@section('content')
    <div class="container p-2">
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between my-3">
            <h3 class="fw-bold">Lending Table</h3>
            <a href="{{ route('item.index')}}" type="button" class="btn btn-secondary me-5 px-4">Back</a>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($lendings as $index => $lending)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @foreach ($lending->detailLendings->where('item_id', $item->id) as $detail)
                                {{ $detail->item->name ?? '-'}}
                            @endforeach
                        </td>
                        <td>
                            @foreach($lending->detailLendings->where('item_id', $item->id) as $total)
                                {{ $total->qty}}
                            @endforeach
                        </td>
                        <td>{{ $lending->name }}</td>
                        <td>{{ $lending->notes }}</td>
                        <td>{{ $lending->borrow_date }}</td>
                        <td>
                            @if ($lending->return_date == null)
                                <p class="text-warning border border-warning border-2 p-1 text-center">Not Returned</p>
                            @else
                                {{ $lending->return_date }}
                            @endif
                        </td>
                        <td class="fw-bolder">
                            {{ $lending->user->name}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
