@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3 order-1 order-md-1 mb-3">
        @include('partials.left-nav')
    </div>
    <div class="col-12 col-md-9 order-3 order-md-2">
        <x-comment.upload :$post :$comment :route="$route" :value="old('comment') ?? $comment->comment" rows="10" btn_text="Update Comment" />
    </div>
</div>
@endsection