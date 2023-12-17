@extends('layouts.app')


@section('content')
<main>
    {{-- <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">Album example</h1>
          <p class="lead text-body-secondary">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
          <p>
            <a href="#" class="btn btn-primary my-2">Main call to action</a>
            <a href="#" class="btn btn-secondary my-2">Secondary action</a>
          </p>
        </div>
      </div>
    </section> --}}
  
    <div class="album py-5 bg-body-tertiary">
      <div class="container">
        {{ __('app_name') }}
        @auth
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
        @endauth  
        
        <br>
        <br>
        @if (session('post_deleted'))
          <div class="alert alert-danger">
            <p style="font-weight: bold;">{{ session('post_deleted') }}</p>
          </div>
        @endif

        @if (session('post_created'))
          <div class="alert alert-success">
            <p style="font-weight: bold;">{{ session('post_created') }}</p>
          </div>
        @endif

        <br>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          @forelse ($posts as $post)
            <div class="col">
                <div class="card shadow-sm">
                @if ($post->image)
                  <img src="{{ asset('images/'. $post->image) }}" alt="{{ $post->title }}">
                @else
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                @endif
                <div class="card-body">
                    <h2>
                      {{ $post->title }}
                    </h2>
                    <p class="card-text">
                        {{ $post->body }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                        
                        {{-- هل يستطيع المستخدم --}}
                        @can('edit', $post)
                          <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>  
                          <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                          </form>
                        @endcan
                        
                        
                      
                        
                    </div>
                    <small class="text-body-secondary">{{ $post->user->name }}</small>
                    </div>
                </div>
                </div>
            </div>
          @empty
            <div>
            No Posts
            </div>
          @endforelse
        </div>
      </div>
    </div>
  
  </main>
@endsection
