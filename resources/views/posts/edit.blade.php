@extends('layouts.app')


@section('content')

<br>
<br>
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
            @error('title')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Content</label>
            <textarea class="form-control" id="body" rows="3" name="body">
                {{ old('body', $post->body) }}
            </textarea>
            @if($errors->has('body'))
                @foreach ($errors->get('body') as $error)
                    <p style="color: red;">{{ $error }}</p>
                @endforeach
            @endif
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>

@endsection