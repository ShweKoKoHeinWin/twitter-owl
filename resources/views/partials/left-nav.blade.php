<div class="card mb-4">
    <div class="card-body pt-3">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <div class="dropdown">
                    <button class="nav-link text-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Posts
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('home')}}">All Posts</a></li>
                        <li><a class="dropdown-item" href="{{route('post.create')}}">Create Post</a></li>
                        <li><a class="dropdown-item" href="{{route('post.create')}}">My Posts</a></li>
                    </ul>
                </div>
                    
            </li>
            <li class="nav-item">
                <div class="dropdown">
                    <button class="nav-link text-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Users
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('home')}}">Followers</a></li>
                        <li><a class="dropdown-item" href="{{route('post.create')}}">Followings</a></li>
                        <li><a class="dropdown-item" href="{{route('users')}}">Explore Users</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span>Settings</span></a>
            </li>
        </ul>
    </div>
    {{-- <div class="card-footer text-center py-2">
        <a class="btn btn-link btn-sm" href="#">View Profile </a>
    </div> --}}
</div>
@include('partials.search-box')

