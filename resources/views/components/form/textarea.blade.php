@props(['name', 'class' => "form-control", 'value' => old($name) ?? ''])

<textarea name="{{$name}}" id="{{$name}}" class="{{$class}}" {{$attributes}}>
    {{$value}}
</textarea>