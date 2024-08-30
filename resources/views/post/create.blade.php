@extends('layout.layout')

@section('back')
    <a href="{{route('home')}}" class="btn btn-primary">Back To Posts</a>
@endsection

@section('content')

<form class="form mt-5 card p-3" action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h3 class="text-center text-dark">New Post</h3>
    <div class="form-group mt-3">
        <x-form.label name="title">Title</x-form.label>
        <x-form.input name="title"/>
        <x-form.error name="title"/>
    </div>
    <div class="form-group mt-3">
        <x-form.label name="content">Content</x-form.label>
        <x-form.textarea name="content" type="email"/>
        <x-form.error name="content"></x-form.error>
    </div>
    <div class="form-group mt-3">
        <x-form.label name="privacy">Privacy</x-form.label>
        <x-form.select name="privacy" :options="[
            ['label' => 'Public', 'value' => 'public'],
            ['label' => 'Friends', 'value' => 'friends'],
            ['label' => 'Onlyme', 'value' => 'only_me'],
        ]"/>
        <x-form.error name="privacy"></x-form.error>
    </div>
    <div class="form-group mt-3">
        <x-form.label  name="upload">Upload Images (You can upload many images but choose one image at a time. It will show as preview and all showing images will upload.)</x-form.label>
        <x-form.input name="upload" type="file" onclick="createImage(event)"/>
        <x-form.error name="images"></x-form.error>
        @if ($errors->get('images.*'))
            @foreach ($errors->get('images.*') as $errorImages)
                <p>
                    @foreach ($errorImages as $error)
                        {{ $error }}
                    @endforeach
                </p>
            @endforeach
        @endif
        <div class="img-input-field d-flex"></div>
    </div>
    <div class="form-group mt-3">
        <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
    </div>
</form>
@endsection