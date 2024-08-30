@props(['type' => 'post', 'user', 'dislikesCount' => 0, 'likesCount' => 0])
@if ($type === 'profile')
<div class="card mb-2">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <a href="{{route('profile', $user)}}">
                    <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                    src="{{$user->image ? asset($user->image?->url) : $DEFAULT_USER_IMG}}" alt="Mario Avatar">
                </a>
                <div>
                    <h3 class="card-title mb-0"><a href="{{route('profile', $user)}}">{{$user->name}}</a></h3>
                    <span class="fs-6 text-muted">{{$user->email}}</span>
                   @can('edit', $user)
                    <div class="mt-3">                     
                        <a class="btn btn-dark btn-sm" href="{{route('profile.edit', $user)}}">Edit</a>
                    </div>
                   @endcan
                </div>
            </div>

            
        </div>
            <div class="px-2 mt-4">
                <div class="d-flex justify-content-start">
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <i class="fa-solid fa-user-group"></i>
                    {{$user->followers->count()}} Followers </a>
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <i class="fa-solid fa-user-group"></i>
                    {{$user->followings->count()}} Followings </a>
                    <span class="me-3">
                        <i class="fa-solid fa-thumbs-up"></i>
                        {{$likesCount}}
                    </span>
                    <span class="me-3">
                        <i class="fa-solid fa-thumbs-down"></i> 
                        {{$dislikesCount}}
                    </span>
                    @auth
                    <form action="{{route('user.follow', $user)}}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-sm"> 
                            @if ($user->followers->contains(function($follow) use($user) {return $follow->user_id == $user->id && $follow->follower_id == auth()->user()->id;}))
                                Following
                            @else
                                Follow
                            @endif
                        </button>
                    </form>
                    @endauth
                </div>
           
            </div>
    </div>
</div>   

@else
    
<div class="d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
        <a href="{{route('profile', $user)}}">
            <img style="width:50px" class="me-2 avatar-sm rounded-circle"
            src="{{$user->image ? asset($user->image?->url) : $DEFAULT_USER_IMG}}"
            alt="User Photo">
        </a>
        <div>
            <h5 class="card-title mb-0">                
                <a href="{{route('profile', $user)}}">
                {{$user->name}}
                </a></h5>
        </div>
    </div>
</div>   
@endif