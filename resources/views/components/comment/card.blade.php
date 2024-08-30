@props(['post', 'comment', 'route' => 'comment.comments.store'])
<div class="d-flex align-items-start border-start border-top p-1 mt-1">
    <a href="{{route('profile', $comment->user)}}">
        <img style="width:35px" class="me-2 avatar-sm rounded-circle"
        src="{{$comment->user->image ? asset($comment->user->image?->url) : $DEFAULT_USER_IMG}}"
        alt="User Photo">
    </a>
    <div class="w-100">
        <div class="d-flex justify-content-between">
            <h6>                
                <a href="{{route('profile', $comment->user)}}">
                {{$comment->user->name}}
                </a></h6>
            <small class="fs-6 fw-light text-muted" title="Last Updated at {{$comment->updated_at}}"> 
                {{$comment->created_at->diffForHumans()}}
            </small>
        </div>
        <p class="fs-6 mt-3 fw-light">
            {!!$comment->comment!!}
        </p>

        <div class="d-flex align-items-center gap-4 mb-2">
            <a class="btn btn-success btn-sm" href="{{route('post.comments.edit', compact('post', 'comment'))}}"> edit</a>
            <form action="{{route('post.comments.delete', compact('post', 'comment'))}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
        {{-- Comment upload form --}}
        <x-comment.upload :$post :$comment :route="$route" rows="1"/>
        {{-- List related comments --}}
        @if ($comment->comments->isNotEmpty())
            @foreach ($comment->comments as $comment)
                <x-comment.card :$post :$comment/>
            @endforeach
        @endif
    </div>
</div>
