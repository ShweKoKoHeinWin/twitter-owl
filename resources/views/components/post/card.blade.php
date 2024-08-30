<div class="card mb-2">
    <div class="px-3 pt-4 pb-2">
        <x-user.card :user="$post->user"/>
        <div class="d-flex justify-content-end gap-3 my-2">
            @can('edit', $post)
                <a href="{{route('post.edit', $post)}}" class="btn btn-secondary btn-sm">Edit</a> 
            @endcan
            @can('delete', $post)
                <form action="{{route('post.delete', $post)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            @endcan
            @can('view', $post)
                <a class="btn btn-info btn-sm" href="{{route('post.show', $post)}}">View</a>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <p class="fs-6 fw-light text-muted">
            {{$post->title}}
        </p>
        <p class="fs-6 fw-light text-muted">
            {{$post->content}}
        </p>
        @forelse ($post->images as $image)
            <img width="150px" src="{{$image->url}}" alt="">
        @empty
            
        @endforelse
        <hr>
        <div class="d-flex justify-content-between">
            <x-post.likeaction :$post/>

            <div class="ms-auto">
                @switch($post->privacy)
                    @case('only_me')
                        <i class="fa-solid fa-user-shield"></i>
                        @break
                    @case('friends')
                        <i class="fa-solid fa-users"></i>
                        @break
                    @default
                    <i class="fa-solid fa-earth-americas"></i>
                @endswitch
                    {{$post->privacy}}
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{$post->created_at}}    
                </span>
            </div>
        </div>

        @if (url()->current() === route('post.show', $post))
            <x-comment.upload :$post route="post.comments.store"/>
            <hr>

            <div style="max-height: 100vh;overflow:auto;">
                @forelse ($post->comments as $comment)
                    <x-comment.card :$post :$comment/>
                @empty

                @endforelse
            </div>
        @else
            <div class="mb-3" onclick="window.location.href='{{route('post.show', $post)}}'">
                <textarea name="" id="" class="form-control" rows="1"></textarea>
            </div>
        @endif
    </div>
</div>