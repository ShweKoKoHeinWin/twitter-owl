@extends('layout.layout')

@section('back')
    <a href="{{route('home')}}" class="btn btn-primary">Back To Posts</a>
       
    @include('partials.admin-nav')
@endsection

@section('content')

<form class="form mt-5 card p-3" action="{{route('admin.permission.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h3 class="text-center text-dark">New Permission</h3>
    <div class="form-group repeatable-container mt-3">
        <x-form.label name="name">Name</x-form.label>
        @foreach (old('names', []) as $name)
            <div class="input-group mb-3 removeable-element">
                <x-form.input name="names[]" class="form-control mb-2" :value="$name"/>   
                <span class="input-group-text remove-btn" id="basic-addon2">
                    <i class="fa-solid fa-trash"></i>
                </span>
            </div>        
        @endforeach
        <div class="d-none">
            <div class="input-group mb-3 removeable-element repeatable-element">
                <x-form.input class="form-control mb-2" name="names[]"/>
                <span class="input-group-text remove-btn bg-danger text-white" id="basic-addon2">
                    <i class="fa-solid fa-trash"></i>
                </span>
            </div>
        </div>
        <div class="input-group mb-3 removeable-element repeatable-element">
            <x-form.input class="form-control mb-2" name="names[]"/>
            <span class="input-group-text remove-btn bg-danger text-white" id="basic-addon2">
                <i class="fa-solid fa-trash"></i>
            </span>
        </div>
    </div>        
    <x-form.error name="names"/>
    @if ($errors->get('names.*'))
            @foreach ($errors->get('names.*') as $errorNames)
                <p>
                    @foreach ($errorNames as $error)
                        {{ $error }}
                    @endforeach
                </p>
            @endforeach
        @endif

    <div class="d-flex justify-content-center mt-3">
        <i class="btn btn-secondary fa-regular fa-square-plus" onclick="createRepeatable()"></i>
    </div>
    <div class="form-group mt-3">
        <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
    </div>
</form>
@endsection