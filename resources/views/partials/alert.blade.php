@session('alert-success')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {!!session('alert-success')!!}    
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsession


@session('alert-fail')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {!!session('alert-fail')!!}    
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsession

@session('alert-warning')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {!!session('alert-warning')!!}    
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsession