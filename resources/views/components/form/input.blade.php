@props(['name', 'class' => "form-control", 'value' => old($name) ?? ''])

<input name="{{$name}}" id="{{$name}}" class="{{$class}}" value="{{$value}}" {{$attributes}}>