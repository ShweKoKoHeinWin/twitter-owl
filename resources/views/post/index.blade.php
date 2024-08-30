@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3 order-1 order-md-1 mb-3">
            @include('partials.left-nav')
        </div>
        <div class="col-12 col-md-9 order-3 order-md-2">
            
            @forelse ($posts as $post)
                <x-post.card :$post/>
            @empty
            <div class="card text-center py-5">
                <p class="fs-6 fw-light text-muted">
                    No Posts Found <a class="btn btn-light" href="{{route('home')}}">Go Back To Home?</a>
                </p>
            </div>
            @endforelse
            {{$posts->links()}}
        </div>
  
    </div>
@endsection