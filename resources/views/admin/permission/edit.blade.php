@extends('layout.layout')

@section('back')
<div class="d-flex justify-content-end align-items-center gap-2 mb-3">
    @include('partials.admin-nav')
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3 mb-3">
        @include('partials.left-nav')
    </div>
    
    <div class="col-12 col-md-9">
        <form class="form mt-5 card p-3" action="{{route('admin.permission.update', $permission)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h3 class="text-center text-dark">Edit Permission ({{$permission->name}})</h3>
            <div class="form-group mt-3">
                <x-form.label name="name">Name</x-form.label>
                <x-form.input name="name" :value="$permission->name"/>
                <x-form.error name="name"/>
            </div>
        
            <div class="form-group mt-3">
                <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
            </div>
        </form>
    </div>
</div>
@endsection