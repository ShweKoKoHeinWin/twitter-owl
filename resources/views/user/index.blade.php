@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3 order-1 order-md-1 mb-3">
        @include('partials.left-nav')
    </div>
    <div class="col-12 col-md-6 order-3 order-md-2">
        @forelse ($users as $user)
            <x-user.card type="profile" :$user likesCount="{{$totalLikesPerUser[$user->id]}}" dislikesCount="{{$totalDislikesPerUser[$user->id]}}" />
        @empty
        <div class="card text-center py-5">
            <p class="fs-6 fw-light text-muted">
                No Users Found <a class="btn btn-light" href="{{route('users')}}">Go Back To All Users?</a>
            </p>
        </div>
        @endforelse
        

    </div>
    <div class="col-12 col-sm-6 col-md-3 order-2 order-md-3 mb-3">
        @include('partials.right-nav')
    </div>
</div>

@endsection