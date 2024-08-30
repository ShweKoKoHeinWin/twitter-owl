@props(['id' => $name, 'name', 'name_old' => '', 'class' => "form-check-input", 'value', 'checked_values' => []])

<input type="checkbox" name="{{$name}}" id="{{$id}}" class="{{$class}}" value="{{$value}}" {{in_array($value,old($name_old) ?? $checked_values ?? []) ? "checked" : ''}}  {{$attributes}}>