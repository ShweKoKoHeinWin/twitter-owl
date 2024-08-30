@extends('layout.layout')

@section('content')
<form class="form mt-5" action="{{route('login')}}" method="post">
    @csrf
    <h3 class="text-center text-dark">Login</h3>

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
        <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
    </div>
    <div class="text-right mt-2">
        Don't have an account? <a href="{{route('register')}}" class="text-dark">Register Here!</a>
    </div>
</form>
@endsection