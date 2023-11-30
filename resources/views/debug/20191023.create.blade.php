@php
    $title = __('Create User');
@endphp
@extends('usermodel.layout')
@section('content')
<div class="container">
	<h1>{{ $title }}</h1>
	<form action="{{ url('usermodel' )}}" method="post">
		@csrf{{-- csrf保護 --}}
		@method('POST'){{-- 疑似フォームメソッド --}}
		<div class="form-group">
			<label for="user_name">{{ __('UserName') }}</label>
			<input id="user_name" type="text" class="form-control" name="user_name" required autofocus>
		</div>

		<div class="form-group">
			<label for="email">{{ __('Email')}}</label>
			<input id="email" type="email" class="form-control" name="email" required>
		</div>

		<div class="form-group">
			<label for="password">{{ __('Password')}}</label>
			<input id="password" type="password" class="form-control" name="password" required>
		</div>

		<div class="form-group">
			<label for="password_confirmed">{{ __('Confirm Password')}}</label>
			<input id="password_confirmed" type="password" class="form-control" name="password_confirmed" required>
		</div>
		<button type="submit" name="submit" class="btn btn-primary">{{ __('submit') }}</button>
	</form>
</div>
@endsection