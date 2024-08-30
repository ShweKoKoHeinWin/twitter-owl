@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3 order-1 order-md-1 mb-3">
        @include('partials.left-nav')
    </div>
    <div class="col-12 col-md-9 order-3 order-md-2">
        
        <x-user.card type="profile" :$user :$likesCount :$dislikesCount/>
        <hr>

        @can('userPosts', $user)
        <a href="{{route('user.posts', $user)}}" class="btn btn-info w-100">View {{$user->name}}'s Posts</a>    
        @endcan

    </div>
</div>

@endsection