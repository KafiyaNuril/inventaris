@extends('layouts.app')
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between">
        <h3>Tabel User {{ ucfirst(request('role') ?? 'All ') }}</h3>
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
                @foreach( $users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role == 'admin')
                                <a class="btn btn-success" href="{{ route('user.edit', $user->id) }}" role="button">edit</a>
                            @else
                                <form action="{{ route('user.reset', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-warning">Reset Password</button>
                                </form>
                            @endif
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
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

@endsection