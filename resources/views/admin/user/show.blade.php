@extends('layout.layout')

@section('back')
<div class="d-flex justify-content-end align-items-center gap-2 mb-3">
    @include('partials.admin-nav')
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3 order-1 order-md-1 mb-3">
        @include('partials.left-nav')
    </div>
    <div class="col-12 col-md-9 order-3 order-md-2">
        
        <div class="card mb-2">
            @can('admin user edit')    
                <div class="mt-3 ms-auto me-3">                     
                    <a class="btn btn-dark btn-sm" href="{{route('admin.user.edit', $user)}}">Edit</a>
                </div>
            @endcan
            <div class="px-3 pt-4 pb-2">
                <div class="d-flex flex-column align-items-center text-center">

                    <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                        src="{{$user->image ? asset($user->image?->url) : $DEFAULT_USER_IMG}}" alt="Mario Avatar">
                    <div class="mt-3">
                        <h3 class="card-title mb-0">{{$user->name}}</h3>
                        <span class="fs-6 text-muted">{{$user->email}}</span>
        
                        <div class="mt-2">
                            @forelse ($user->roles as $role)
                                <span class="badge text-bg-primary"> {{$role->name}} </span>
                            @empty
                                <span class="badge text-bg-primary">Normal User</span>
                            @endforelse
                        </div>

                        <div class="mt-1">
                            @forelse ($user->getAllPermissions() as $permission)
                                <span class="badge text-bg-secondary"> {{$permission->name}} </span>
                            @empty
                               
                            @endforelse
                        </div>
                    </div>

                    <div class="px-2 mt-4">
                        <div class="d-flex justify-content-start">
                            <span class="fw-light fs-6 me-3"> <i class="fa-solid fa-user-group"></i>
                            {{$user->followers->count()}} Followers </span>
                            <span class="fw-light fs-6 me-3"> <i class="fa-solid fa-user-group"></i>
                            {{$user->followings->count()}} Followings </span>
                            <span class="fw-light me-3">
                                <i class="fa-solid fa-thumbs-up"></i>
                                {{$likesCount}}
                                {{ Str::plural('Like', $likesCount) }}              
                            </span>
                            <span class="fw-light me-3">
                                <i class="fa-solid fa-thumbs-down"></i> 
                                {{$dislikesCount}}
                                {{ Str::plural('Dislike', $dislikesCount) }}
                            </span>

                            <span class="fw-light me-3">
                                <i class="fa-solid fa-id-card"></i>
                                {{$postCount}}
                                {{ Str::plural('Post', $postCount) }}
                            </span>
                        </div>
                   
                    </div>
                    
                </div>
                    
            </div>
        </div>
        
        <div class="row">
            @if ($user->followers->isNotEmpty())
                <div class="col-12 col-md-6">
                    <h4 class="text-center">Followers</h4>
                    @foreach ($user->followers as $follower)
                    @if ($follower->is(Auth::user()))
                        yoou
                    @else
                       <div class="card my-2" onclick="window.location.href='{{route('profile', $follower->follower_user)}}'">
                            <div class="card-header d-flex align-items-center gap-3">
                                <img width="50px" class="rounded" src="{{$follower->follower_user->image?->url ?? $DEFAULT_USER_IMG}}" alt="">
                                <div>
                                    <h6>{{$follower->follower_user->name}}</h6>
                                    <p>{{$follower->follower_user->email}}</p>
                                </div>
                            </div>
                        </div> 
                    @endif
                        
                    @endforeach
                    
                </div>
            @endif
            
            @if ($user->followings->isNotEmpty())
                <div class="col-12 col-md-6">
                    <h4 class="text-center">Followings User</h4>
                    @foreach ($user->followings as $following)
                    @if ($following->is(Auth::user()))
                    yoou
                @else
                        <div class="card my-2" onclick="window.location.href='{{route('profile', $following->following_user)}}'">
                            <div class="card-header d-flex align-items-center gap-3">
                                <img width="50px" class="rounded" src="{{$following->following_user->image?->url ?? $DEFAULT_USER_IMG}}" alt="">
                                <div>
                                    <h6>{{$following->following_user->name}}</h6>
                                    <p>{{$following->following_user->email}}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    
                </div>
            @endif
        </div>
        
        <hr>
        @can('userPosts', $user)
        <a href="{{route('user.posts', $user)}}" class="btn btn-info w-100">View {{$user->name}}'s Posts</a>    
        @endcan
    </div>
</div>

@endsection