@props(['name', 'class' => ''])

@error($name)
    <p {{ $attributes->merge(['class' => 'text-danger ' . $class]) }}">
        {{$message}}
    </p>
@enderror
