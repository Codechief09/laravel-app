@php
	$title = __('テストデータ一覧');
@endphp
{{-- layout.blade.phpの継承 --}}
@extends('usermodel/layout')
{{-- @endsectionまでの部分が@yield('content')に代入される。--}}
@section('content')
	<div class="container ops-main">
		<h3 class="ops=title text-center">{{ $title }}</h3>
		<div class="row">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>{{ __('ID')}}</th>
						<th>{{ __('UserName')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($usermodels as $usermodel)
						<tr>
							<td>{{ $usermodel->id }}</td>
							<td><a href="/usermodel/{{ $usermodel->id }}/edit">{{ $usermodel->user_name }}</a></td>
							<!-- <td>
								<form action="/usermodel/{{ $usermodel->id }}" method="post">
								<input type="hidden" name="_method" value="DELETE">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button type="submit" class="btn btn-xs btn-danger" aria-label="left Align"><span class="glyphicon glyphicon-trash"></span></button>
								</form>
							</td> -->
						</tr>
						@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection