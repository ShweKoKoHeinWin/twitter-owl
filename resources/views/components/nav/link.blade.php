@props(['route' => '', 'bind' => '', 'type' => ''])

@if ($type)
    <form action="{{route($route)}}" method="post">
        @csrf
        <button class="nav-link">{{$slot}}</button>
    </form>
@else
    <a class="nav-link {{request()->is($route) ? 'active' : ''}}" aria-current="page" href="{{route($route, $bind)}}">{{$slot}}</a>
@endif


