@auth
    <div class="d-flex align-items-center gap-3">
        @php
            $like = $post->likes->where('user_id', auth()->user()->id)->where('like', 1)->first();
            $dislike = $post->dislikes->where('user_id', auth()->user()->id)->where('like', 0)->first();

            
        @endphp
        @if ($like)
            <form action="{{route('post.unlike', compact('post', 'like'))}}" method="POST">
                @csrf
                <button href="#" class="fw-light nav-link fs-6">   
                    <i class="fa-solid fa-thumbs-up"></i>
                    {{$post->likes->count()}} 
                </button>
            </form>                   
        @else
            <form action="{{route('post.like', $post)}}" method="POST">
                @csrf
                <button href="#" class="fw-light nav-link fs-6"> 
                <i class="fa-regular fa-thumbs-up"></i> 
                    {{$post->likes->count()}} 
                </button>
            </form>
        @endif
        
        @if ($dislike)
            <form action="{{route('post.undislike', ['post' => $post, 'like' => $dislike])}}" method="POST">
                @csrf
                <button href="#" class="fw-light nav-link fs-6">   
                    <i class="fa-solid fa-thumbs-down"></i> 
                    {{$post->dislikes->count()}} 
                </button>
            </form>                   
        @else
            <form action="{{route('post.dislike', $post)}}" method="POST">
                @csrf
                <button href="#" class="fw-light nav-link fs-6"> 
                    <i class="fa-regular fa-thumbs-down"></i> 
                    {{$post->dislikes->count()}} 
                </button>
            </form>
        @endif
    </div>

@else

    <div class="d-flex align-items-center gap-3">
        <form action="{{route('post.like', $post)}}" method="POST">
            @csrf
            <button href="#" class="fw-light nav-link fs-6"> 
            <i class="fa-regular fa-thumbs-up"></i> 
                {{$post->likes->count()}} 
            </button>
        </form>

                    
        <form action="{{route('post.dislike', $post)}}" method="POST">
            @csrf
            <button href="#" class="fw-light nav-link fs-6"> 
                <i class="fa-regular fa-thumbs-down"></i> 
                {{$post->dislikes->count()}} 
            </button>
        </form>
    </div>

@endauth