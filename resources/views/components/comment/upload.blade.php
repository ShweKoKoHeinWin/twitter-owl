@props(['route', 'post', 'comment', 'rows' => 2, 'value' => '', 'btn_text' => "Create Comment"])
@php
    if(isset($comment)) {
        $route = route($route, ['post' => $post, 'comment' => $comment]);
    } else {
        $route = route($route, ['post' => $post]);
    }
@endphp
<div>
    <form action="{{$route}}" method="POST">
        @csrf
        <div class="mb-3">
            @if (!$value)
            <x-form.textarea name="comment" rows="{{$rows}}"/>
            @else
            <x-form.textarea name="comment" :$value rows="{{$rows}}"/>
            @endif
            <x-form.error name="comment"/>
        </div>
        <div>
            <button class="btn btn-primary btn-sm"> {{$btn_text}} </button>
        </div>
    </form>
</div>