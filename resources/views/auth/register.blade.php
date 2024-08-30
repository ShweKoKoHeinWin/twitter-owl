@extends('layout.layout')

@section('content')
<form class="form mt-5" action="{{route('register')}}" method="post">
    @csrf
    <h3 class="text-center text-dark">Register</h3>
    <div class="form-group mt-3">
        <x-form.label name="name">Name</x-form.label>
        <x-form.input name="name"/>
        <x-form.error name="name"/>
    </div>
    <div class="form-group mt-3">
        <x-form.label name="email">Email</x-form.label>
        <x-form.input name="email" type="email"/>
        <x-form.error name="email"></x-form.error>
    </div>
    <div class="form-group mt-3">
        <x-form.label name="password">Password</x-form.label>
        <x-form.input name="password" type="password"/>
        <x-form.error name="password"></x-form.error>
    </div>
    <div class="form-group mt-3">
        <x-form.label name="password_confirmation">Confirm Password</x-form.label>
        <x-form.input name="password_confirmation" type="password"/>
    </div>
    <div class="form-group mt-3">
        <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
    </div>
    <div class="text-right mt-2">
        <a href="{{route('login')}}" class="text-dark">Login here</a>
    </div>
</form>
@endsection