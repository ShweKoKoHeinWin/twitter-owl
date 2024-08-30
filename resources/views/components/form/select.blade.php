@props(['name', 'class' => "form-select", 'value' => old($name) ?? '', 'options' => []])

<select name="{{$name}}" id="{{$name}}" class="{{$class}}" value="{{$value}}" {{$attributes}}>
    @forelse ($options as $option)
        <option value="{{$option['value']}}" {{$option['value'] === $value ? "selected" : ''}}>{{$option['label']}}</option>
    @empty
        <option value="">No Options</option>
    @endforelse
</select>