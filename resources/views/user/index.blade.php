@extends('layouts.app')
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between">
        <h3>Tabel User</h3>
        <a class="btn btn-dark mb-3" href="{{ route('user.create') }}" role="button">+ add</a>
    </div>
    <table class="table">
        <thead>
            <tr class="table-active">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if( count($users) < 1 )
                <tr>
                    <td colspan="5" class="text-center">User is Empty</td>
                </tr>
            @else
                <tr>
                    @foreach( $users as $index => $user)
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('user.edit', $user->id) }}" role="button">edit</a>
                            <a class="btn btn-danger" href="{{-- route('user.delete', $user->id) --}}" role="button">delete</a>
                        </td>
                    @endforeach
                </tr>
            @endif
        </tbody>
    </table>
@endsection