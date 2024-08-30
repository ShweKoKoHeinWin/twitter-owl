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
        <form class="form mt-5 card p-3" action="{{route('admin.role.update', $role)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h3 class="text-center text-dark">Edit role ({{$role->name}})</h3>
            <div class="form-group mt-3">
                <x-form.label name="name">Name</x-form.label>
                <x-form.input name="name" :value="$role->name"/>
                <x-form.error name="name"/>
            </div>
            <div class="mt-3">
                <span class="btn btn-secondary" onclick="checkAllBox('permissions[]')">
                    All Permissions
                </span>
                <span class="btn btn-secondary" onclick="checkAllBox('permissions[]', false)">
                    No Permissions
                </span>
            </div>
            <div class="form-group d-flex align-items-center flex-wrap gap-3 mt-3">
                @forelse ($permissions as $permission)
                    <div class="form-check">
                        <x-form.checkbox type="checkbox" id="{{$permission->name}}" name="permissions[]" :value="$permission->name" name_old="permissions" :checked_values="$role->permissions->pluck('name')->toArray()"/>  
                        <label class="form-check-label" for="{{$permission->name}}">                 {{$permission->name}} </label>
                      </div>
                @empty
                    
                @endforelse
            </div>
        
            <div class="form-group mt-3">
                <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
            </div>
        </form>
    </div>
</div>
@endsection