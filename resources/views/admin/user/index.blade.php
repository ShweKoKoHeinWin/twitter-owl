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
        <h2 class="text-center">Users</h2>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td> {{$user->id}} </td>
                        <td><img width="50" src="{{$user->image?->url ?? $DEFAULT_USER_IMG}}" alt=""></td>
                        <td> {{$user->name}} </td>
                        <td> {{$user->email}} </td>
                        <td>  
                            @can('admin user show')
                                <a href="{{route('admin.user.show', $user)}}" class="btn btn-sm btn-info">View</a>
                            @endcan
                            @can('admin user edit')
                                <a href="{{route('admin.user.edit', $user)}}" class="btn btn-sm btn-secondary">Edit</a>
                            @endcan
                            @can('admin user delete')
                                <form class="d-inline" action="{{route('admin.user.delete', $user)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
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