@can('admin dashboard')
    @can('admin users')
       <a href="{{route('admin.user')}}" class="btn {{request()->routeIs('admin.user') ? 'btn-primary' : 'btn-secondary'}}">Users</a> 

       <a href="{{route('admin.user.create')}}" class="btn {{request()->routeIs('admin.user.create') ? 'btn-primary' : 'btn-secondary'}}">Create Users</a>
    @endcan
    

    @can('admin roles')
        <a href="{{route('admin.role')}}" class="btn {{request()->routeIs('admin.role') ? 'btn-primary' : 'btn-secondary'}}">Roles</a>

        <a href="{{route('admin.role.create')}}" class="btn {{request()->routeIs('admin.role.create') ? 'btn-primary' : 'btn-secondary'}}">Create Roles</a>
    @endcan

    @can('admin permissions')
        <a href="{{route('admin.permission')}}" class="btn {{request()->routeIs('admin.permission') ? 'btn-primary' : 'btn-secondary'}}">Permissions</a>

        <a href="{{route('admin.permission.create')}}" class="btn {{request()->routeIs('admin.permission.create') ? 'btn-primary' : 'btn-secondary'}}">Create Permission</a>
    @endcan

    @can('admin images')
        <a href="{{route('admin.image')}}" class="btn {{request()->routeIs('admin.image') ? 'btn-primary' : 'btn-secondary'}}">Images</a>
    @endcan
@endcan