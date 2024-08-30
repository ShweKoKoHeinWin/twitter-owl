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
        <h2 class="text-center">Roles ({{$roles->count()}})</h2>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td> {{$role->id}} </td>
                        <td> {{$role->name}} </td>
                        <td>  
                            @can('role edit')
                                <a href="{{route('admin.role.edit', $role)}}" class="btn btn-secondary">Edit</a>
                            @endcan
                            @can('role delete')
                                <form class="d-inline" action="{{route('admin.role.delete', $role)}}" method="POST">
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
    </div>
</div>
@endsection