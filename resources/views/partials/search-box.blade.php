<div class="card">
    <div class="card-header pb-0 border-0">
        <h5 class="">Search</h5>
    </div>
    <div class="card-body">
        <form action="">
            <input placeholder="...
            " class="form-control w-100" type="text"
                name="search" value="{{request()->get('search')}}">
            <button class="btn btn-dark mt-2"> Search</button>
            @if (request()->query())
                <a href="{{request()->url()}}" class="btn btn-dark mt-2"> Remove Search</a> 
            @endif
        </form>
    </div>
</div>