@extends('layouts.app')


@section('content')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1>{{ $post->title }}</h1>
        </div>
        <div class="card-body">
            <p class="card-text">
                {{ $post->body }}
            </p>
        </div>
    </div>
</div>

@endsection