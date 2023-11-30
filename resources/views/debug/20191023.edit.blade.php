@php
    $title = __('Edit').': '.$usermodel->user_name;
@endphp
@extends('usermodel.layout')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <form action="{{ url('usermodel/'. $usermodel->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_name">{{ __('UserName') }}</label>
            <input id="user_name" type="text" class="form-control" name="user_name" value="{{ $usermodel->user_name }}" required autofocus>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>
@endsection