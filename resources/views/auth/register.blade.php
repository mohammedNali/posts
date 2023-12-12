@extends('layouts.app')

@section('content')

<div class="container mt-4 mb-4">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('registerUser') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        </div>
        <div class="form-group mb-3">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
        </div>
        <div class="form-group mb-3">
            <label for="password_confirmation">Password</label>
            <input type="password" class="form-control" id="password_confirmation" placeholder="Password" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Sign up</button>
    </form>

</div>

@endsection