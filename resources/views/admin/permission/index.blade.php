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
        <h2 class="text-center">Permissions ({{$permissions->count()}}) </h2>
 
        <form action="{{route('admin.permission.delete.many')}}" method="post">
            @can('permission delete'))
                <div class="d-flex justify-content-end gap-2">
                    <span class="btn btn-secondary" onclick="checkAllBox('del-permissions[]', true)">
                        Select All
                    </span>
                    <span class="btn btn-secondary" onclick="checkAllBox('del-permissions[]', false)">
                        Unselect All
                    </span>
                    <button class="btn btn-danger">Delete Selected Permissions</button>
                </div>
            @endcan
            @csrf
            @method('DELETE')
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>
                                @can('permission delete')
                                    <x-form.checkbox type="checkbox" id="{{$permission->name}}" name="del-permissions[]" :value="$permission->name" name_old="del-permissions"/> 
                                @endcan 
                            </td>
                            <td> 
                                <x-form.label name="{{$permission->name}}">{{$permission->id}} </x-form.label>
                                
                            </td>
                            <td>   <x-form.label name="{{$permission->name}}">{{$permission->name}}</x-form.label> </td>
                            <td> 
                                @can('permission edit') 
                                    <a href="{{route('admin.permission.edit', $permission)}}" class="btn btn-secondary">Edit</a>
                                @endcan
                                @can('permission delete')
                                    <form class="d-inline" action="{{route('admin.permission.delete', $permission)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </form>
    </div>
</div>
@endsection