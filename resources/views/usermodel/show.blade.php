@php
    $title = __('テストデータ').': '.$usermodel->user_name;
@endphp
@extends('usermodel.layout')
@section('content')

<div class="container">
	<h1>{{ $title }}</h1>
	
	 {{-- 編集・削除ボタン --}}
	<div>
		<a href="{{ url('usermodel/'.$usermodel->id.'/edit') }}" class="btn btn-primary">
			{{ __('Edit') }}
		</a>
		@deletebutton
			@slot('table', 'usermodel')
			@slot('id', $usermodel->id)
		@enddeletebutton
	</div>

	 {{-- ユーザー1件の情報 --}}

	 <dl class="row">
	 	<dt class="col-md-2">{{ __('ID') }}</dt>
		<dd class="col-md-10">{{ $usermodel->id }}</dd>
		<dt class="col-md-2">{{ __('UserName') }}</dt>
		<dd class="col-md-10">{{ $usermodel->user_name }}</dd>
		<dt class="col-md-2">{{ __('Password') }}</dt>
		<dd class="col-md-10">{{ $usermodel->password }}</dd>
		<dt class="col-md-2">{{ __('Email') }}</dt>
		<dd class="col-md-10">{{ $usermodel->email }}</dd>
		<dt class="col-md-2">{{ __('isEmailConfirmed') }}</dt>
		<dd class="col-md-10">{{ $usermodel->isEmailConfirmed }}</dd>
		<dt class="col-md-2">{{ __('Token') }}</dt>
		<dd class="col-md-10">{{ $usermodel->token }}</dd>
		<dt class="col-md-2">{{ __('TokenExpire') }}</dt>
		<dd class="col-md-10">{{ $usermodel->tokenExpire }}</dd>
		<dt class="col-md-2">{{ __('LoginFailureCount') }}</dt>
		<dd class="col-md-10">{{ $usermodel->loginFailureCount }}</dd>
		<dt class="col-md-2">{{ __('LoginFailureDateTime') }}</dt>
		<dd class="col-md-10">{{ $usermodel->loginFailureDatetime }}</dd>
		<dt class="col-md-2">{{ __('DeleteFlag') }}</dt>
		<dd class="col-md-10">{{ $usermodel->deleteFlag }}</dd>
	 </dl>
</div>
@endsection