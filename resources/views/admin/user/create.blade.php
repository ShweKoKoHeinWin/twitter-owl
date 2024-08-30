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
        <form class="card py-3" action="{{route('admin.user')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3 class="text-center">Create User</h3>
            <div class="px-3 pt-4 pb-2">
                <div class="d-flex align-items-center">
                    <img style="width:200px" class="preview_img me-3 avatar-sm rounded-circle"
                    src="{{$DEFAULT_USER_IMG}}" alt="Mario Avatar">
                    <div>
                        <x-form.input name="image" type="file"/>  
                        <x-form.error name="image"/>
                    </div>
                </div>

                <div class="form-group d-flex align-items-center gap-3 mt-3">
                    <x-form.label name="name">Name</x-form.label>
                    <x-form.input name="name"/>      
                </div>
                <x-form.error class="text-center" name="name"/>   

                <div class="form-group d-flex align-items-center gap-3 mt-3">
                    <x-form.label name="email">Email</x-form.label>
                    <x-form.input name="email"/>
                </div>
                <x-form.error class="text-center" name="email"/>   

                <div class="form-group d-flex align-items-center gap-3 mt-3">
                    <x-form.label name="password">Password</x-form.label>
                    <x-form.input name="password" placeholder="Please Enter Password If you want to change email."/>
                </div>
                <x-form.error class="text-center" name="password"/>   
               
                <div class="form-group d-flex align-items-center gap-3 mt-3">
                    <x-form.label name="roles">Roles</x-form.label>
                    <select class="form-select" name="roles[]" id="" multiple>
                        @foreach ($roles as $role)
                            <option value="{{$role->name}}" {{in_array($role->name, old('roles') ?? []) ? 'selected' : ''}}>{{$role->name}}</option>
                        @endforeach
                    </select>
                    <x-form.error name="roles"></x-form.error>
                </div>
                <div class="form-group d-flex align-items-center gap-3 mt-3">
                    <x-form.label name="admin-password">Admin Password</x-form.label>
                    <x-form.input name="admin-password" placeholder="Please Enter Admin password to verify that you are admin."/>
                </div>
                <x-form.error class="text-center" name="admin-password"/>  
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