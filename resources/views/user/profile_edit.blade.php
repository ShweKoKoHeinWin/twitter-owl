@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3 mb-3">
        @include('partials.left-nav')
    </div>
    
    <div class="col-12 col-md-9">
        <form class="card" action="{{route('profile.update', $user)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h3 class="text-center">Edit Profile</h3>
            <div class="px-3 pt-4 pb-2">
                <div class="d-flex align-items-center">
                    <img style="width:200px" class="preview_img me-3 avatar-sm rounded-circle"
                    src="{{$user->image ? asset($user->image?->url) : 'https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario'}}" alt="Mario Avatar">
                    <div>
                        <x-form.input name="image" type="file"/>  
                        <x-form.error name="image"/>
                    </div>
                </div>

                <div class="form-group d-flex align-items-center gap-3 mt-3">
                    <x-form.label name="name">Name</x-form.label>
                    <x-form.input name="name" :value="old('name') ?? $user->name"/>      
                </div>
                <x-form.error class="text-center" name="name"/>   

                <div class="form-group d-flex align-items-center gap-3 mt-3">
                    <x-form.label name="email">Email</x-form.label>
                    <x-form.input name="email" :value="old('email') ?? $user->email"/>
                </div>
                <x-form.error class="text-center" name="email"/>   

                <div class="form-group d-flex align-items-center gap-3 mt-3">
                    <x-form.label name="password">Password</x-form.label>
                    <x-form.input name="password" placeholder="Please Enter Password If you want to change email."/>
                </div>

                <div class="form-group mt-3">
                    <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        previewImg();
    });
</script>
@endsection