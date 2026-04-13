@extends('layouts.app')
@section('content')
    <h2>Welcome to Dashboard {{ Auth::user()->name }}</h2>
@endsection