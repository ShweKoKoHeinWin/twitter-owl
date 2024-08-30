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
        <h2 class="text-center">Images ({{$images->count()}}) </h2>
 
        <form action="{{route('admin.image.delete.many')}}" method="post">
                @if ($images->count() > 0)
                <div class="d-flex justify-content-end gap-2">
                    <span class="btn btn-secondary" onclick="checkAllBox('del-images[]', true)">
                        Select All
                    </span>
                    <span class="btn btn-secondary" onclick="checkAllBox('del-images[]', false)">
                        Unselect All
                    </span>
                    <button class="btn btn-danger">Delete Selected Images</button>
                </div>
                @endif
            @csrf
            @method('DELETE')
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($images as $image)
                        <tr>
                            <td>

                                    <x-form.checkbox type="checkbox" id="{{$image->id}}" name="del-images[]" :value="$image->id" name_old="del-images"/> 

                            </td>
                            <td> 
                                <x-form.label name="{{$image->id}}">{{$image->id}} </x-form.label>
                                
                            </td>
                            <td>   
                                <x-form.label name="{{$image->id}}">
                                    <img width="50px" src="{{$image->url}}" alt="" onclick="clickToViewImg(this)">
                                </x-form.label> 
                            </td>
                            <td> 
       
                                    <form class="d-inline" action="{{route('admin.image.delete', $image)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
       
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